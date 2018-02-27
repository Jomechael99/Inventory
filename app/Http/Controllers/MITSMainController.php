<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\department;
use App\product;
use App\department_list;
use App\mits_transaction;
use Validator;
use DB;
use Session;
use Carbon\Carbon;
use Auth;

class MITSMainController extends Controller
{
    public function getMITSFormMain(){

        if(auth::guard('admins')->check() == true){
        
        $dept = department::all();
        $dept_list = db::table('department_list')->get();
        
        $depttype = db::table('department')->select('Department_Type')->distinct()->where('Department_Type', '=', '')->get();
               
        return view('Inventory.MITSInventory.MITSMain')->with('dept', $dept)->with('deptlist', $dept_list)->with('depttype', $depttype);
        }
        else if(auth::guard('admins')->check() == false){
            return redirect()->route('Login');
        }
    }

    
  
    
    public function NewMITS(Request $request){
        
         $validation = db::table('department')->where('MITS', '=', $request->mits)->get();
            
         $newreq = "";
        
         if ($validation != null){
         
             $newreq = "1";
             Session::put('newreq', $newreq);
             return redirect()->route('MITSFormMain');
             
         }
        else{
            
            $newreq = "2";
            Session::put('newreq', $newreq);
            
            $datenow = Carbon::now()->toDateString();
            
        
            
            
            
            $dept = new department;
            
            $dept -> MITS = $request -> mits;
            $dept -> Emp_Fname = $request -> firstname;
            $dept -> Emp_Lname = $request -> lastname;
            $dept -> Department = $request -> department;
            $dept -> Date_Of_Received  = $request -> datereq;
            $dept -> MRS = $request -> mrs;
            $dept -> Date_Inserted = $datenow;
            $dept -> Department_Type = $request->departmenttype;            
            $dept->save();
            
            
            
            return redirect()->route('MITSTransaction', ['id' => $request->mits]);
            
            
        }
        
        
        
    }
    
    public function deleteMITS($id){
        
        
        
        $DeleteItems = department::findorFail($id);
        $DeleteQuantity = mits_transaction::where('MITS' ,$id)->get();
        

        
            
        if($DeleteQuantity == null){
        
            
        $DeleteItems->Delete();
        
        $DelMITS = "";
        
        if($DeleteItems == true){
            
            $DelMITS = "1";
            Session::put('DelMITS', $DelMITS);
            return redirect()->route('MITSFormMain');
            
        }
        else{
            
            $DelMITS = "2";
            Session::put('DelMITS', $DelMITS);
            return redirect()->route('MITSFormMain');
            
        }
            
        }
        else{
          
            
            
            foreach($DeleteQuantity as $DeleteQua=>$value){
            
                db::table('product')->where('ProductNo', $value->ProductNo)->decrement('Total_Quantity', $value->QTY);                
                        
                
            }
            
            
        $DeleteItems->Delete();
        
        $DelMITS = "";
        
        if($DeleteItems == true){
            
            $DelMITS = "1";
            Session::put('DelMITS', $DelMITS);
            return redirect()->route('MITSFormMain');
            
        }
        else{
            
            $DelMITS = "2";
            Session::put('DelMITS', $DelMITS);
            return redirect()->route('MITSFormMain');
            
        }
            
            
            
            
        }
      
        
        
        
        
    }
    
    public function getMITSTransaction($id, Request $request){
        
        if(Auth::guard('admins')->check() == true){

        $mitsid = $request -> id;
        
        $trans = db::table('mits_transaction')->join('product','mits_transaction.ProductNo', '=', 'product.ProductNo')->where('MITS', '=', $mitsid)->select('Transno','MITS','OUM','QTY','product.Product_Code','ProductName','Remarks','mits_transaction.ProductNo','mits_transaction.Product_Code as ProductCode')->get();
        
      //dd($trans);
     
        return view('Inventory.MITSInventory.MITSMainTransaction')->with('mitsid', $mitsid)->with('trans', $trans);
        }
        else if(Auth::guard('admins')->check() == false){
            return redirect()->route('Login');
        }
    }
    
    public function AddMITSTransaction(Request $request, $id){
        
        
        $count = count($request->uom);
        $success = "";    
        
        for($idx = 0 ; $idx < $count ; $idx++){
        
            $mits = new mits_transaction();
            
            $mits -> MITS = $id;
            $mits -> OUM = $request->uom[$idx];
            $mits -> QTY = $request->quantity[$idx];
            $mits -> Product_Code = $request->productcode[$idx];
            $mits -> Remarks = $request->remarks[$idx];
            $mits -> ProductNo = $request->product[$idx];
            $mits -> save();
            
            DB::table('product')->where('ProductNo', $request->product[$idx])->increment('Total_Quantity', $request->quantity[$idx]);
            
        }
        
        if($mits->save() == true){
            
            $success = "1";
            Session::put('success', $success);
               return redirect()->route('MITSTransaction', ['id' => $id]);
         
        }
        else if($mits->save() == false){
         
            $success = "2";
            Session::put('success', $success);
            return redirect()->route('MITSTransaction', ['id' => $id]);
         
            
        }
            
        
            
        
      
        
    }
    
    public function deleteProduct($id, $id2){
        
        $DeleteProduct = mits_transaction::findorFail($id);
        $Qty = $DeleteProduct -> QTY ;
        $ProdNo = $DeleteProduct -> ProductNo ;
        
        $DeleteProduct->Delete();
        
        Db::table('product')->where('ProductNo', $ProdNo)->decrement('Total_Quantity', $Qty);
        
        
        $DelProd = "";
        
        if($DeleteProduct == true){
            
            $DelProd = "1";
            Session::put('DelProd', $DelProd);
            return redirect()->route('MITSTransaction', ['id2' => $id2]);
            
            
        }else{
            $DelProd = "2";
            Session::put('DelProd', $DelProd);
            return redirect()->route('MITSTransaction', ['id2' => $id2]);
            
        }
        
        
    }
    
    public function getAddingItem($id){
        
        $product = product::all();
        $uom = db::table('mits_transaction')->select('OUM')->distinct()->get();
        
        
        
        return view('Inventory.MITSInventory.MITSMainItemAdding')
        ->with('id', $id)
        ->with('product', $product)
        ->with('uom', $uom);
        
        
    }
    
    
    
    
    
}
