<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\product;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;
use Auth;
use File;

class MITSInventory extends Controller
{
    	public function getInventoryItems(){

			if(Auth::guard('admins')->check() == true){

			

        	$product =  product::orderBy('Total_Quantity','Desc')->get();
				


    		Return view('Inventory.MITSInventory.ProductInventory')->with('product', $product);

			}
			else if(auth::guard('admins')->check() == false){

				return redirect()->route('Login');

			};

    	}


    	public function DeleteItems(Request $request, $id){

    		$DeleteItems = product::findorFail($id);

    	 	$DeleteItems->delete();

    	 	$deletion = "1";

    	 	if($DeleteItems == true){
    	 		Session::put('deletion', $deletion);
    	 		Return redirect()->route('InventoryItems');
    	 	}
    	 	else{
    	 		$deletion = "2";
    	 		Session::put('deletion', $deletion);
    	 		Return redirect()->route('InventoryItems');
    	 	}



    	}


    	public function AddItems(Request $request){

    		$ProductName = $request->input('ItemName');

    		$ExistingItem = product::where('ProductName', '=', $ProductName)->First();

    		$validator = "1";


    		if ($ExistingItem != null) {
    			Session::put('validator', $validator);
    			return redirect('MITS/Inventory Items');

    		}
    		else{

    			 $validator = "2";
    			 Session::put('validator', $validator);
                 $prodid = mt_rand(1, 1000000);
       
                 $Add = new product;

    			 $Add->ProductName = $request->input('ItemName');
    			 $Add->Particular = $request->input('ItemPart');
                 $Add->ProductID = $prodid;
                 $Add->Product_code = $request->input('prodcode');


    			 $Add->save();

    			 Return redirect()->route('InventoryItems');

    		}


    	}
    
        public function AddExcel(Request $request){
            
              if($request->hasFile('excelfile')){
				
				   $extension = File::extension($request->excelfile->getClientOriginalName());

				   if($extension == "xlsx" || $extension == "xls" || $extension == "csv" ){

					$path = $request->file('excelfile')->getRealPath();
					$data = \Excel::load($path)->get();
				   
					 if($data->count()){
						 foreach ($data as $key => $value) {
							 $arr[] = ['ProductName' => $value->productname, 'Particular' => $value->particulars, 'ProductID' => $value->productid, 'Product_Code' => $value->product_code];
						 }
						 
						 $excelvalidator = "";
						 
						
						 
						 if(!empty($arr)){
							 $insert = DB::table('product')->insert($arr);
							 
							 if($insert == true){
								 
								 $excelvalidator = "2";
								 Session::put('excelvalidator', $excelvalidator);
								 return redirect('MITS/Inventory Items');
								 
							 }
							 else if($insert == false){
								 
								 $excelvalidator = "1";
								 Session::put('excelvalidator', $excelvalidator);
								 return redirect('MITS/Inventory Items');
								 
							 }
							 
							 
							 
						 }
					 }
				   }
				   else{
					$excelvalidator = "1";
					Session::put('excelvalidator', $excelvalidator);
					return redirect('MITS/Inventory Items');
				   }

                   
                  
              }
           

        }






}
