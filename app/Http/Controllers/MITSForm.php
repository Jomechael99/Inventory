<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\product;
use App\department;
use App\mits_transaction;
use Illuminate\Support\Facades\DB;
use Session;


class MITSForm extends Controller
{
    public function getMITSForm(){

      $uom = db::table('mits_transaction')->select('OUM')->distinct()->get();


      return view('Inventory.MITSInventory.MITSForm')->with('uom', $uom);


    }

    public function ProductList(Request $request){

        //Item Product

        $term = $request->term;

        $result = product::where('ProductName', 'LIKE', '%'. $term . '%')->get();

        $searchResults = array();

        if (count($result) == 0){

            $searchResult[] = 'No Product are Found';

        }
        else{

            foreach($result as $res){

                $searchResult[] = ['id' => $res->ProductNo, 'value' => $res->ProductName, 'particular' => $res->Particular];

            }

        }

        return $searchResult;


	   }

    public function DepartmentList(Request $request){



        }


    public function AddMITSForm(Request $request){

       //dd($request->all());
        
        $mits = db::table('mits_transaction')->where('MITS', '=', $request->mits)->first();
        
        
        
        $validator = "1";
        
        
        if($mits != null){
           Session::put('validator', $validator);
           return redirect()->route('MITSForm');
        }
        else{
        
         $validator = "2";
         Session::put('validator', $validator);

       // Department Saving 
        
        $fname = $request -> firstname;
        $lname = $request -> lastname;
        $deptname = $request -> deptname;
        $datereq = $request -> datereq;
        $mits = $request -> mits;
        
        // MITS Transaction
        
        $mrs = $request -> mrs;
        $prodid = $request -> prodid;
        $uom = $request -> uom;
        $quantity = $request -> quantity;
        $prodcode = $request -> prodcode;
        $remarks = $request -> remarks;
        
        $department = new department;
        
        $department->Department = $deptname;
        
        $department->Emp_Fname = $fname;
        $department->Emp_Lname = $lname;
        $department->Date_Of_Received = $datereq;
       
        
        $department->save();
            
        $deptno = $department->DeptNo;    
            
        $mits_transaction = new mits_transaction;
        
        $mits_transaction->MITS = $mits;
        $mits_transaction->MRS = $mrs;
        $mits_transaction->OUM = $uom;
        $mits_transaction->QTY = $quantity;
        $mits_transaction->Product_Code = $prodcode;
        $mits_transaction->Remarks = $remarks;
        $mits_transaction->ProductNo = $prodid;
        $mits_transaction->DeptNo = $deptno;
        
        
        $mits_transaction->save();
        
      
            
        return redirect()->route('AddMITS', ['id'=> $mits, 'id2' => $deptno]);

            
        
        }
        
    
       
    }
    
    public function getAddMITS($id,$id2){
        
        $dept = department::where('Deptno', '=', $id2)->get();
        
        $mits = db::table('mits_transaction')->join('product' ,'mits_transaction.ProductNo', '=', 'product.ProductNo')->where('mits_transaction.MITS', '=', $id)->get();
        
        
        
        
       //return $mits;
        
       return view('Inventory.MITSInventory.MITSFormAdd')->with('dept', $dept)->with('mits', $mits);
        
    }


    }//End of MITSForm

