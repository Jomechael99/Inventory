<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function() {

	Route::get('MITS/Dashboard', ['uses' => 'PagesController@getInventoryDashboard', 'as' => 'InventoryDashboard']); // InventoryDashboard

	//Inventory Items

	Route::get('MITS/Inventory Items', ['uses' => 'MITSInventory@getInventoryItems', 'as' => 'InventoryItems']);

	Route::get('MITS/DeleteItems/{id}', ['uses' => 'MITSInventory@DeleteItems', 'as' => 'DeleteItems']);


	Route::post('MITS/Add Inventory Items', ['uses' => 'MITSInventory@AddItems', 'as' => 'AddItem']);
    
    Route::post('MITS/Add Excel Files', ['uses' => 'MITSInventory@AddExcel', 'as' => 'AddExcel']);

	//MITS form

	Route::get('MITS/MITSForm', ['uses' => 'MITSForm@getMITSForm', 'as' => 'MITSForm']);

	Route::get('MITS/MITSSearch', ['uses' => 'MITSForm@ProductList', 'as' => 'MITSSearch']);

	Route::get('MITS/MITSDeptlist', ['uses' => 'MITSForm@DeptList', 'as' => 'MITSDeptlist']);

	Route::post('MITS/AddMITSForm', ['uses' => 'MITSForm@AddMITSForm', 'as' => 'AddMITSForm']);
    
    Route::get('MITS/MITSAddForm/{id}/{id2}', ['uses' => 'MITSForm@getAddMITS', 'as' => 'AddMITS']);
    
    
    
    //MITS Main
    
    Route::get('MITS/MITSMain', ['uses' => 'MITSMainController@getMITSFormMain', 'as' => 'MITSFormMain']);
    
    Route::get('MITS/MITSTransaction/{id}', ['uses' => 'MITSMainController@getMITSTransaction', 'as' => 'MITSTransaction']);
    
    Route::post('MITS/New MITS', ['uses' => 'MITSMainController@NewMITS', 'as' => 'NewMITS']);
    
    Route::get('MITS/Delete MITS/{id}', ['uses' => 'MITSMainController@deleteMITS', 'as' => 'deleteMITS']);
    
    Route::post('MITS/MITSAddProduct/{id}', ['uses' => 'MITSMainController@AddMITSTransaction', 'as' => 'MITSAddProduct']);
    
    Route::get('MITS/Delete Product/{id}/{id2}', ['uses' => 'MITSMainController@deleteProduct', 'as' => 'deleteProduct']);
    
    Route::get('MITS/MITSAdding Item/{id}', ['uses' => 'MITSMainController@getAddingItem', 'as' => 'getAddingItem']);
    
    Route::get('MITS/ExportForm/{id}', ['uses' => 'PagesController@getExportForm', 'as' => 'ExportForm']);

    Route::post('MITS/ViewExport', ['uses' => 'PagesController@ViewExport', 'as' => 'ViewExport']);
    
    Route::get('MITS/ExportExcelView', ['uses' => 'PagesController@ExportExcelView', 'as' => 'ExportExcelView']);
    
    
    Route::post('MITS/ExportExcelViewDateRange', ['uses' => 'PagesController@viewDateRangeExcel', 'as' => 'ExportExcelViewDateRange']);
    
    Route::get('MITS/ViewDepartmentType', ['uses' => 'PagesController@viewDepartmentExcel', 'as' => 'ViewDepartmentType']);

    Route::post('MITS/ExcelDepartmentType', ['uses' => 'PagesController@excelDepartmentType', 'as' => 'ExcelDepartmentType']);
    
    Route::get('MITS/Login', ['uses' => 'PagesController@getLoginForm', 'as' => 'Login']);

    Route::post('MITS/Login', ['uses' => 'PagesController@LoginAccount', 'as' => 'LoginAccount']);
 
    Route::get('MITS/Logout', ['uses' => 'PagesController@getLogout', 'as' => 'Logout']);

    Route::get('MITS/Accounts', ['uses' => 'PagesController@getAccounts', 'as' => 'getAccounts']);

    Route::post('MITS/RegisterAccounts', ['uses' => 'PagesController@postAccounts', 'as' => 'postAccounts']);

    Route::get('MITS/DeleteAccounts/{id}', ['uses' => 'PagesController@deleteAccounts', 'as' => 'deleteAccounts']);

    Route::get('MITS/Department', ['uses' => 'PagesController@DepartmentList', 'as' => 'Department']);

    Route::post('MITS/AddDepartment', ['uses' => 'PagesController@AddDepartment', 'as' => 'AddDepartment']);

    Route::get('MITS/DeleteDepartment/{id}  ', ['uses' => 'PagesController@DeleteDepartment', 'as' => 'DeleteDepartment']);


});
