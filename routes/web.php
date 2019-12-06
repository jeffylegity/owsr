<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MyCustomAuthController@authChecker');
Route::get('download_attached-files/{filename}', 'DownloadController@downloadAttachedFiles')->name('download-attached-files');

Auth::routes([
   'register' => false,
   'verify'   => false,
   'reset'    => false,
]);

//role == 1
//route for admin
Route::group(['middleware' => ['is_admin']], function () {
   Route::get('admin/home', 'HomeController@adminHome')->name('admin.home');
   Route::get('admin/pending_requests', 'AdminController@adminPendingRequests')->name('admin.pending_requests');
});

//role == 2
//route for dept. head
Route::group(['middleware' => ['is_approver']], function () {
   Route::get('approver/home', 'HomeController@approverHome')->name('approver.home');
   Route::get('approver/pending_for_approval','ApproverController@approverPendingForApproval')->name('approver.pending_for_approval');
   Route::get('approver/approved_requests', 'ApproverController@approverApproved')->name('approver.approved');
   Route::get('approver/pending_request', 'ApproverController@approverPendingRequest')->name('approver.pending_request');
   Route::get('approver/completed_request', 'ApproverController@approverCompletedRequest')->name('approver.completed_request');
   Route::get('approver/ee_request_form', 'ApproverController@approverEEreqForm')->name('approver.ee_req_form');
   Route::get('approver/pm_request_form', 'ApproverController@approverPMreqForm')->name('approver.pm_req_form');
   Route::get('approver/pe_request_form', 'ApproverController@approverPEreqForm')->name('approver.pe_req_form');
   Route::get('approver/approve_request/{req_id}','ApproverController@approveRequest')->name('approver.approve_request');
   Route::get('approver/view_request_details/{req_id}','ApproverController@approverReqDetails')->name('approver.req_details');
   Route::post('approver/submit_request_form', 'ApproverFormController@approverSubmitReqForm')->name('approver.submit_request_form');
});

//role == 3
//route for manager
Route::group(['middleware' => ['is_manager']], function () {
   Route::get('manager/home', 'HomeController@managerHome')->name('manager.home');
   Route::get('manager/pending_for_approval','ManagerController@managerPendingForApproval')->name('manager.pending_for_approval');
   Route::get('manager/approved_requests', 'ManagerController@managerApproved')->name('manager.approved');
   Route::get('manager/pending_requests', 'ManagerController@managerPending')->name('manager.pending');
   Route::get('manager/completed_requests', 'ManagerController@managerCompleted')->name('manager.completed');
   Route::get('manager/approve_request/{req_id}','ManagerController@approveRequest')->name('manager.approve_request');
   Route::get('manager/request_details/{req_id}', 'ManagerController@managerReqDetails')->name('manager.req_details');
});

//role == null
//route for requestor
Route::group(['middleware' => ['is_user']], function () {

   Route::get('user/home', 'HomeController@userHome')->name('user.home');
   Route::get('user/pending', 'UserController@userPendingReq')->name('user.pending');
   Route::get('user/completed', 'UserController@userCompletedReq')->name('user.completed');
   Route::get('user/ee_request_form', 'UserController@userEEreqForm')->name('user.ee_req_form');
   Route::get('user/pm_request_form', 'UserController@userPMreqForm')->name('user.pm_req_form');
   Route::get('user/pe_request_form', 'UserController@userPEreqForm')->name('user.pe_req_form');
   Route::get('user/request_details/{req_id}', 'UserController@userReqDetails')->name('user.req_details');
   Route::post('user/submit_request_form', 'UserFormController@userSubmitReqForm')->name('user.submit_request_form');

});




