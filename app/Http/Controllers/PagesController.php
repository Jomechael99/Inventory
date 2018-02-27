<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Excel;
use Auth;
use App\admins;
use Session;


class PagesController extends Controller
{
    
    public function getLoginform(){
        
        if(Auth::guard('admins')->check() == true){
            return redirect('MITS/Dashboard');
            
            
        }
        else if(Auth::guard('admins')->check() == false){
            
        return view('Inventory.login');
        dd("hello");
        
        }

        
    }
    
    public function LoginAccount(Request $request){
        
        $username = $request->username;
        $password = $request->password;
        $swal = "";

        $data = admins::where('username', '=', $username)->first();


       if(Auth::guard('admins')->loginUsingId($data -> id)){
            $swal = 1 ;
            Session::put('swal', $swal);
            return redirect('MITS/Dashboard');
        }
        else{
                $swal = 2;
                Session::put('swal', $swal);
                return redirect('MITS/Login');
        }
        

    }

    public function getLogout(){

        Auth::guard('admins')->logout();
        return redirect()->route('Login');

    }

    public function getAccounts(){

        $user = admins::where('Type', 2)->get();

        return view('Inventory.MITSInventory.AdminAccount')->with('user', $user);

    }

    public function postAccounts(Request $request){

        
        $username = $request->username;
        $password = $request->password;
       
        $user = new admins();

        $user -> username = $username ;
        $user -> password = bcrypt($password);
        $user -> type = 2;

        dd($user);

        //$user -> save();

        return redirect() -> route('getAccounts');



    }

    public function deleteAccounts($id){

            $accounts = User::find($id);

            $accounts->delete();

            return redirect()->route('getAccounts');


    }
    
    
    
    public function getInventoryDashboard(){

        if(Auth::guard('admins')->check() == true){
        
        $Data1 = db::table('department')->Select('Date_Inserted')->Distinct()->get();
        
        $Data2 = db::table('department_list')->get();
        
        $Data3 = db::table('product')->select('ProductName','Total_Quantity')->orderBy('Total_Quantity', 'desc')->take(5)->get();
        
        return view('Inventory.Dashboard')->with('data', $Data1)->with('data1', $Data2)->with('data2', $Data3);
        
        }
        else if(Auth::guard('admins')->check() == false){
            return redirect()->route('Login');

        };

    }
    
    public function viewDateRangeExcel(Request $request){
        
        
        $startdate = date('Y-m-d', strtotime($request->startdate));
        $enddate = date('Y-m-d', strtotime($request->enddate));
        
        $data1[] = db::table('department')->select('department.MITS','Emp_Fname','Emp_Lname','Department','Date_Of_Received','MRS','OUM','QTY','mits_transaction.Product_Code','Remarks','ProductName','Particular','Department_Type')->join('mits_transaction', 'department.MITS', '=', 'mits_transaction.MITS')->join('product', 'product.ProductNo','=','mits_transaction.ProductNo')->whereBetween('Department.Date_Inserted', [$startdate, $enddate])->get();
        
        
        
       Excel::create($startdate.' - '.$enddate, function($excel) use ($data1) {
            $excel->sheet('Sheet1', function($sheet) use ($data1) {
                $sheet->loadView('Inventory.MITSInventory.ExportExcel') ->with('data2', $data1);
            });
        })->download('xls');
        
        
        
        
    }
    
    public function getExportForm($id){
        
        $datavalue = db::table('department')->where('Date_Inserted', $id)->get();
        
        return view('Inventory.MITSInventory.ExportForm')->with('datavalue', $datavalue);
        
        
    }
    
    public function ViewExport(Request $request){
        
        $count = count($request->mits);
        
        
        for($i = 0 ; $i < $count ; $i++){
            
              $data1[] = db::table('department')->select('department.MITS','Emp_Fname','Emp_Lname','Department','Date_Of_Received','MRS','OUM','QTY','mits_transaction.Product_Code','Remarks','ProductName','Particular','Department_Type')->join('mits_transaction', 'department.MITS', '=', 'mits_transaction.MITS')->join('product', 'product.ProductNo','=','mits_transaction.ProductNo')->where('mits_transaction.MITS', $request->mits[$i])->get();
            
            
            
        }
     
        
        Excel::create('DateExcel', function($excel) use ($data1) {
            $excel->sheet('Sheet1', function($sheet) use ($data1) {
                $sheet->loadView('Inventory.MITSInventory.ExportExcel') ->with('data2', $data1);
            });
        })->download('xls');
     
     
    }
    
    public function viewDepartmentExcel(Request $request){
        
        $data1 = db::table('department')->select('Department_Type', 'department.Department')->distinct()->join('department_list', 'department_list.Dept_Code', '=', 'department.Department')->where('department.Department', '=', $request->id)->get();
        
        
        return view('Inventory.MITSInventory.ExcelDepartmentType')->with('datavalue', $data1);
        
    }
    
    public function excelDepartmentType(Request $request){
        
        $deptid = $request->deptid;
        
        $count = count($request->depttype);
        
            for($i = 0 ; $i < $count ; $i++){
            
              $data1[] = db::table('department')->select('department.MITS','Emp_Fname','Emp_Lname','Department','Date_Of_Received','MRS','OUM','QTY','mits_transaction.Product_Code','Remarks','ProductName','Particular','Department_Type')->join('mits_transaction', 'department.MITS', '=', 'mits_transaction.MITS')->join('product', 'product.ProductNo','=','mits_transaction.ProductNo')->where('department.Department_Type', $request->depttype[$i])->where('department.Department', $deptid)->get();
            
            
            
        }
        
       Excel::create('DateExcel', function($excel) use ($data1) {
            $excel->sheet('Sheet1', function($sheet) use ($data1) {
                $sheet->loadView('Inventory.MITSInventory.ExportExcel') ->with('data2', $data1);
            });
        })->download('xls');
     
        
        
    }
    
    
}
