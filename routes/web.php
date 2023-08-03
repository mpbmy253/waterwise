<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeMarketingWebsiteController;
use App\Http\Controllers\LoginLogoutController;
use App\Http\Controllers\PlatformAdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SystemAdminController;

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

// INDEX PAGE 
Route::get('/', [HomeMarketingWebsiteController::class, 'GoToHomePage']);

// MARKEING WEBSITE
Route::get('/web_package', [HomeMarketingWebsiteController::class, 'GoToWebPackagePage']);
Route::get('/full_package', [HomeMarketingWebsiteController::class, 'GoToFullPackagePage']);
Route::get('aboutus', [HomeMarketingWebsiteController::class, 'GoToAboutUsPage']);
Route::get('contactus', [HomeMarketingWebsiteController::class, 'GoToContactUsPage']);

// REGISTERATION & PAYMENT
Route::get('register', [HomeMarketingWebsiteController::class, 'GoToRegistrationPage']);
Route::post('register', [RegisterController::class, 'registerAccount']);

Route::get('payment', [RegisterController::class, 'payment']);
Route::post('payment', [RegisterController::class, 'paymentSuccessful']);

// LOGIN & LOGOUT
Route::get('login', [LoginLogoutController::class, 'login']);
Route::post('login', [LoginLogoutController::class, 'AuthLogin']);
Route::get('logout', [LoginLogoutController::class, 'logout']);

// PLATFORM ADMIN [23]
Route::group(['middleware' => 'platform_admin'], function (){
    // DASHBOARD
    Route::get('platformadmin/dashboard', [DashboardController::class, 'dashboard']);

    // SETTINGS
    Route::get('platformadmin/settings/my_account', [AccountController::class, 'platformAdminAccount']);
    Route::post('platformadmin/settings/my_account', [AccountController::class, 'updatePlatformAdminAccount']);
    Route::get('platformadmin/settings/change_password', [AccountController::class, 'platformAdminChangePassword']);
    Route::post('platformadmin/settings/change_password', [AccountController::class, 'updatePlatformAdminPassword']);

    // COMPANY
    Route::get('platformadmin/company/view_all_company', [PlatformAdminController::class, 'btnViewAllCompany']);
    Route::get('autoSearchCompany', [PlatformAdminController::class, 'autoSearchCompany']);
    Route::get('platformadmin/company/view_pending_company', [PlatformAdminController::class, 'btnViewPendingCompany']);
    Route::get('platformadmin/company/approve/{company_id}', [PlatformAdminController::class, 'approvedCompany']);
    Route::get('platformadmin/company/view_suspend_company', [PlatformAdminController::class, 'btnViewSuspendCompany']);
    Route::get('platformadmin/company/suspend_company/{company_id}', [PlatformAdminController::class, 'suspendCompany']);

    // SYSTEM ADMIN ACCOUNT FOR COMAPNY
    Route::get('platformadmin/account/create_new_sys_admin_account_for_company', [PlatformAdminController::class, 'btnCreateNewSystemAdminForCompany']);
    Route::post('platformadmin/account/create_new_sys_admin_account_for_company', [PlatformAdminController::class, 'createNewSystemAdminForCompany']);
    Route::get('autoFillUserDetailsBasedOnCompanySelection', [PlatformAdminController::class, 'findUserDetailsBaasedOnCompanySelection']);
    Route::get('platformadmin/company/send_email', [PlatformAdminController::class, 'btnToSendEmailToCompany']);

    // SELLER
    Route::get('platformadmin/seller/view_all_seller', [PlatformAdminController::class, 'btnViewAllSeller']);
    Route::get('autoSearchSeller', [PlatformAdminController::class, 'autoSearchSeller']);
    Route::get('platformadmin/seller/view_pending_seller', [PlatformAdminController::class, 'btnViewPendingSeller']);
    Route::get('platformadmin/seller/approve/{company_id}', [PlatformAdminController::class, 'approvedSeller']);

    // SYSTEM ADMIN ACCOUNT FOR SELLER
    Route::get('platformadmin/account/create_new_sys_admin_account_for_seller', [PlatformAdminController::class, 'btnCreateNewSystemAdminForSeller']);
    Route::post('platformadmin/account/create_new_sys_admin_account_for_seller', [PlatformAdminController::class, 'createNewSystemAdminForSeller']);
    Route::get('autoFillUserDetailsBasedOnSellerSelection', [PlatformAdminController::class, 'findUserDetailsBaasedOnSellerSelection']);
    Route::get('platformadmin/seller/send_email', [PlatformAdminController::class, 'btnToSendEmailToSeller']);
});

// SELER [14]
Route::group(['middleware' => 'seller'], function (){
    // DASHBOARD
    Route::get('seller/dashboard', [DashboardController::class, 'dashboard']);

    // SETTINGS
    Route::get('seller/settings/my_account', [AccountController::class, 'sellerAccount']);
    Route::post('seller/settings/my_account', [AccountController::class, 'updateSellerAccount']);
    Route::get('seller/settings/change_password', [AccountController::class, 'sellerChangePassword']);
    Route::post('seller/settings/change_password', [AccountController::class, 'updateSellerPassword']);

    // PRODUCTS
    Route::get('seller/product/add_new_product', [SellerController::class, 'btnAddNewProduct']);
    Route::get('seller/product/view_all_products', [SellerController::class, 'btnViewAllProduct']);
    Route::get('seller/product/view_individual_product/{product_id}', [SellerController::class, 'btnViewIndivialProduct']);
    Route::get('seller/product/edit_product/{product_id}', [SellerController::class, 'btnEditProduct']);
    Route::get('seller/product/view_delete_product', [SellerController::class, 'btnViewDeleteProduct']);
    Route::get('seller/product/delete_product/{product_id}', [SellerController::class, 'deleteProduct']);
    Route::get('autoSearchProducts', [SellerController::class, 'autoSearchProducts']);
    Route::post('seller/product/add_new_product', [SellerController::class, 'addNewProduct']);
    Route::post('seller/product/edit_product/{product_id}', [SellerController::class, 'editProduct']);
});


// SYSTEM ADMIN [33]
Route::group(['middleware' => 'system_admin'], function (){
    // DASHBOARD
    Route::get('/systemadmin/dashboard', [DashboardController::class, 'dashboard']);

    // SETTINGS
    Route::get('systemadmin/settings/my_account', [AccountController::class, 'systemAdminAccount']);
    Route::post('systemadmin/settings/my_account', [AccountController::class, 'updateSystemAdminAccount']);
    Route::get('systemadmin/settings/change_password', [AccountController::class, 'systemAdminChangePassword']);
    Route::post('systemadmin/settings/change_password', [AccountController::class, 'updateSystemAdminPassword']);

    // USER PROFILES
    Route::get('systemadmin/roles/create_new_roles', [SystemAdminController::class, 'btnCreateNewUserProfile']);
    Route::get('systemadmin/roles/view_all_roles', [SystemAdminController::class, 'btnViewAllUserProfile']);
    Route::get('systemadmin/roles/view_individual_role/{id}', [SystemAdminController::class, 'btnViewIndividialRole']);
    Route::get('autoSearchUserProfile', [SystemAdminController::class, 'autoSearchUserProfile']);
    Route::get('systemadmin/roles/view_deleted_roles', [SystemAdminController::class, 'btnViewDeletedUserProfile']);
    Route::get('systemadmin/roles/view_suspend_roles', [SystemAdminController::class, 'btnViewSuspendUserProfile']);
    Route::get('systemadmin/roles/edit_roles/{role_id}', [SystemAdminController::class, 'btnEditUserProfile']);
    Route::get('systemadmin/roles/delete_roles/{role_id}', [SystemAdminController::class, 'deleteUserProfile']);
    Route::get('systemadmin/roles/suspend_roles/{role_id}', [SystemAdminController::class, 'suspendUserProfile']);
    Route::get('systemadmin/roles/restore_roles/{role_id}', [SystemAdminController::class, 'restoreUserProfile']);
    Route::get('systemadmin/roles/activate_roles/{role_id}', [SystemAdminController::class, 'activateUserProfile']);
    Route::post('systemadmin/roles/create_new_roles', [SystemAdminController::class, 'createUserProfile']);
    Route::post('systemadmin/roles/edit_roles/{role_id}', [SystemAdminController::class, 'editUserProfile']);

    // USER ACCOUNT
    Route::get('systemadmin/account/create_new_account', [SystemAdminController::class, 'btnCreateNewAccount']);
    Route::get('systemadmin/account/view_all_account', [SystemAdminController::class, 'btnViewAllAccount']);
    Route::get('systemadmin/account/view_individual_account/{id}', [SystemAdminController::class, 'btnViewIndividialAccount']);
    Route::get('autoSearchAccount', [SystemAdminController::class, 'autoSearchAccount']);
    Route::get('systemadmin/account/view_deleted_account', [SystemAdminController::class, 'btnViewDeletedAccount']);
    Route::get('systemadmin/account/view_suspend_account', [SystemAdminController::class, 'btnViewSuspendAccount']);
    Route::get('systemadmin/account/edit_account/{id}', [SystemAdminController::class, 'btnEditAccount']);
    Route::get('systemadmin/account/delete_account/{id}', [SystemAdminController::class, 'deleteUserAccount']);
    Route::get('systemadmin/account/suspend_account/{id}', [SystemAdminController::class, 'suspendUserAccount']);
    Route::get('systemadmin/account/restore_account/{id}', [SystemAdminController::class, 'restoreUserAccount']);
    Route::get('systemadmin/account/activate_account/{id}', [SystemAdminController::class, 'activateUserAccount']);
    Route::post('/systemadmin/account/create_new_account', [SystemAdminController::class, 'createUserAccount']);
    Route::post('systemadmin/account/edit_account/{id}', [SystemAdminController::class, 'editUserAccount']);

    // PAYMENT
    Route::get('systemadmin/payment/make_payment', [SystemAdminController::class, 'btnMakePayment']);
    Route::post('systemadmin/payment/make_payment', [SystemAdminController::class, 'makePayment']);
});


// HR & CUSTOMER SERVICE [20]
Route::group(['middleware' => 'hr_customer_service'], function (){
    // DASHBOARD
    Route::get('hr_customer_service/dashboard', [DashboardController::class, 'dashboard']);

    // SETTINGS
    Route::get('hr_customer_service/settings/my_account', [AccountController::class, 'HrCustomerServiceAccount']);
    Route::post('hr_customer_service/settings/my_account', [AccountController::class, 'updateHrCustomerServiceAccount']);
    Route::get('hr_customer_service/settings/change_password', [AccountController::class, 'HrCustomerServiceChangePassword']);
    Route::post('hr_customer_service/settings/change_password', [AccountController::class, 'updateHrCustomerServicePassword']);

    // CUSTOMER BILLING
    Route::get('hr_customer_service/customerbilling/view_all_customer_pending_bills', [EmployeeController::class, 'btnViewAllCustomerBillings']);
    Route::get('autoSearchCustomerPendingBill', [EmployeeController::class, 'autoSearchCustomerPendingBill']);
    Route::get('hr_customer_service/customerbilling/send_bill_alert/{customer_id}', [EmployeeController::class, 'btnToSendBillAlert']);
    Route::get('hr_customer_service/customerbilling/view_void_bills', [EmployeeController::class, 'btnViewVoidBills']);
    Route::get('hr_customer_service/customerbilling/void_bills/{customer_id}', [EmployeeController::class, 'voidBills']);

    // CUSTOMER PAYMENT
    Route::get('hr_customer_service/customerpayment/view_all_customer_payment', [EmployeeController::class, 'btnViewAllCustomerPayment']);
    Route::get('autoSearchCustomerPaidBill', [EmployeeController::class, 'autoSearchCustomerPaidBill']);
    Route::get('hr_customer_service/customerpayment/view_individual_customer_payment_history/{customer_id}', [EmployeeController::class, 'btnViewIndividualCustomerPayment']);

    // CUSTOMER INTERACTION
    Route::get('hr_customer_service/customerinteraction/view_feedback',  [EmployeeController::class, 'btnViewFeedbacks']);
    Route::get('hr_customer_service/customerinteraction/view_feedback/{feedback_id}', [EmployeeController::class, 'btnViewIndividialFeedback']);
    Route::get('hr_customer_service/customerinteraction/delete_feedback/{feedback_id}', [EmployeeController::class, 'btnDeleteFeedback']);
    Route::post('hr_customer_service/customerinteraction/reply_feedback', [EmployeeController::class, 'replyFeedback']);
    Route::get('hr_customer_service/customerinteraction/view_service_request',  [EmployeeController::class, 'btnViewServiceRequest']);
    Route::get('hr_customer_service/customerinteraction/view_service_request/{service_id}', [EmployeeController::class, 'btnViewIndividialServiceRequest']);
    Route::get('hr_customer_service/customerinteraction/sent_technician_over/{service_id}', [EmployeeController::class, 'btnSendTechnicianOverToService']);
});


// SUPERVISOR [71]
Route::group(['middleware' => 'supervisor'], function (){
    // DASHBOARD
    Route::get('supervisor/dashboard', [DashboardController::class, 'dashboard']);

    // SETTINGS
    Route::get('supervisor/settings/my_account', [AccountController::class, 'supervisorAccount']);
    Route::post('supervisor/settings/my_account', [AccountController::class, 'updateSupervisorAccount']);
    Route::get('supervisor/settings/change_password', [AccountController::class, 'supervisorChangePassword']);
    Route::post('supervisor/settings/change_password', [AccountController::class, 'updateSupervisorPassword']);

    // EQUIPMENT
    Route::get('supervisor/equipment/create_new_equipment', [EmployeeController::class, 'btnAddNewEquipment']);
    Route::get('supervisor/equipment/view_all_equipment', [EmployeeController::class, 'btnViewAllEquipment']);
    Route::get('supervisor/equipment/view_individual_equipment/{equipment_id}', [EmployeeController::class, 'btnViewIndividialEquipment']);
    Route::get('autoSearchEquipments', [EmployeeController::class, 'autoSearchEquipments']);
    Route::get('supervisor/equipment/edit_equipment/{equipment_id}', [EmployeeController::class, 'btnEditEquipment']);
    Route::get('supervisor/equipment/view_deleted_equipment', [EmployeeController::class, 'btnViewDeletedEquipment']);
    Route::get('supervisor/equipment/view_suspend_equipment', [EmployeeController::class, 'btnViewSuspendEquipment']);
    Route::get('supervisor/equipment/delete_equipment/{equipment_id}', [EmployeeController::class, 'deleteEquipment']);
    Route::get('supervisor/equipment/suspend_equipment/{equipment_id}', [EmployeeController::class, 'suspendEquipment']);
    Route::get('supervisor/equipment/restore_equipment/{equipment_id}', [EmployeeController::class, 'restoreEquipment']);
    Route::get('supervisor/equipment/activate_equipment/{equipment_id}', [EmployeeController::class, 'activateEquipment']);
    Route::post('supervisor/equipment/create_new_equipment', [EmployeeController::class, 'addNewEquipment']);
    Route::post('supervisor/equipment/edit_equipment/{equipment_id}', [EmployeeController::class, 'editEquipment']);

    // CHEMICAL
    Route::get('supervisor/chemical/create_new_chemical', [EmployeeController::class, 'btnAddNewChemical']);
    Route::get('supervisor/chemical/view_all_chemical', [EmployeeController::class, 'btnViewAllChemical']);
    Route::get('supervisor/chemical/view_individual_chemical/{chemical_id}', [EmployeeController::class, 'btnViewIndividialChemical']);
    Route::get('autoSearchChemicals', [EmployeeController::class, 'autoSearchChemicals']);
    Route::get('supervisor/chemical/edit_chemical/{chemical_id}', [EmployeeController::class, 'btnEditChemical']);
    Route::get('supervisor/chemical/view_deleted_chemical', [EmployeeController::class, 'btnViewDeletedChemical']);
    Route::get('supervisor/chemical/view_suspend_chemical', [EmployeeController::class, 'btnViewSuspendChemical']);
    Route::get('supervisor/chemical/delete_chemical/{chemical_id}', [EmployeeController::class, 'deleteChemical']);
    Route::get('supervisor/chemical/suspend_chemical/{chemical_id}', [EmployeeController::class, 'suspendChemical']);
    Route::get('supervisor/chemical/restore_chemical/{chemical_id}', [EmployeeController::class, 'restoreChemical']);
    Route::get('supervisor/chemical/activate_chemical/{chemical_id}', [EmployeeController::class, 'activateChemical']);
    Route::post('supervisor/chemical/create_new_chemical', [EmployeeController::class, 'addNewChemical']);
    Route::post('supervisor/chemical/edit_chemical/{chemical_id}', [EmployeeController::class, 'editChemical']);

    // WATER SUPPLY EQUIPMENT
    Route::get('supervisor/water_supply_equipment/create_new_water_supply_equipment', [EmployeeController::class, 'btnAddNewWaterSupplyEquipment']);
    Route::get('supervisor/water_supply_equipment/view_all_water_supply_equipment', [EmployeeController::class, 'btnViewAllWaterSupplyEquipment']);
    Route::get('supervisor/water_supply_equipment/view_individual_water_supply_equipment/{water_supply_equipment_id}', [EmployeeController::class, 'btnViewIndividialWaterSupplyEquipment']);
    Route::get('autoSearchWaterSupplyEquipment', [EmployeeController::class, 'autoSearchWaterSupplyEquipment']);
    Route::get('supervisor/water_supply_equipment/edit_water_supply_equipment/{water_supply_equipment_id}', [EmployeeController::class, 'btnEditWaterSupplyEquipment']);
    Route::get('supervisor/water_supply_equipment/view_deleted_water_supply_equipment', [EmployeeController::class, 'btnViewDeletedWaterSupplyEquipment']);
    Route::get('supervisor/water_supply_equipment/view_suspend_water_supply_equipment', [EmployeeController::class, 'btnViewSuspendWaterSupplyEquipment']);
    Route::get('supervisor/water_supply_equipment/delete_water_supply_equipment/{water_supply_equipment_id}', [EmployeeController::class, 'deleteWaterSupplyEquipment']);
    Route::get('supervisor/water_supply_equipment/suspend_water_supply_equipment/{water_supply_equipment_id}', [EmployeeController::class, 'suspendWaterSupplyEquipment']);
    Route::get('supervisor/water_supply_equipment/restore_water_supply_equipment/{water_supply_equipment_id}', [EmployeeController::class, 'restoreWaterSupplyEquipment']);
    Route::get('supervisor/water_supply_equipment/activate_water_supply_equipment/{water_supply_equipment_id}', [EmployeeController::class, 'activateWaterSupplyEquipment']);
    Route::post('supervisor/water_supply_equipment/create_new_water_supply_equipment', [EmployeeController::class, 'addNewWaterSupplyEquipment']);
    Route::post('supervisor/water_supply_equipment/edit_water_supply_equipment/{water_supply_equipment_id}', [EmployeeController::class, 'editWaterSupplyEquipment']);

    // REPORT & ANALYSIS
    Route::get('supervisor/report_analysis/view_all_customer_meter_reading', [EmployeeController::class, 'btnViewAllCustomerMeterReadingSupervisor']);
    Route::get('supervisor/report_analysis/view_individual_customer_meter_reading/{customer_id}', [EmployeeController::class, 'btnViewIndividualCustomerMeterReadingSupervisor']);
    Route::get('autoSearchCustomerMeterSupervisor', [EmployeeController::class, 'autoSearchCustomerMeterSupervisor']);
    Route::get('supervisor/report_analysis/view_customer_by_region', [EmployeeController::class, 'btnViewAllCustomerRegionSupervisor']);
    Route::get('autoSearchCustomerRegionSupervisor', [EmployeeController::class, 'autoSearchCustomerRegionSupervisor']);
    Route::get('supervisor/report_analysis/view_customer_north_region', [EmployeeController::class, 'btnViewAllCustomerNorthRegionSupervisor']);
    Route::get('autoSearchCustomerNorthRegionSupervisor', [EmployeeController::class, 'autoSearchCustomerNorthRegionSupervisor']);
    Route::get('supervisor/report_analysis/view_customer_south_region', [EmployeeController::class, 'btnViewAllCustomerSouthRegionSupervisor']);
    Route::get('autoSearchCustomerSouthRegionSupervisor', [EmployeeController::class, 'autoSearchCustomerSouthRegionSupervisor']);
    Route::get('supervisor/report_analysis/view_customer_east_region', [EmployeeController::class, 'btnViewAllCustomerEastRegionSupervisor']);
    Route::get('autoSearchCustomerEastRegionSupervisor', [EmployeeController::class, 'autoSearchCustomerEastRegionSupervisor']);
    Route::get('supervisor/report_analysis/view_customer_west_region', [EmployeeController::class, 'btnViewAllCustomerWestRegionSupervisor']);
    Route::get('autoSearchCustomerWestRegionSupervisor', [EmployeeController::class, 'autoSearchCustomerWestRegionSupervisor']);

    // JOB
    Route::get('supervisor/job/create_new_job', [EmployeeController::class, 'btnCreateNewJob']);
    Route::get('supervisor/job/view_all_pending_job', [EmployeeController::class, 'btnViewAllPendingJob']);
    Route::get('autoSearchAllPendingJobs', [EmployeeController::class, 'autoSearchAllPendingJobs']);
    Route::get('supervisor/job/view_more_job_description/{job_id}', [EmployeeController::class, 'btnSupervisorViewIndividualJob']);
    Route::get('supervisor/job/edit_job/{job_id}', [EmployeeController::class, 'btnSupervisorEditJob']);
    Route::get('supervisor/job/delete_job/{job_id}', [EmployeeController::class, 'deleteJob']);
    Route::post('supervisor/job/edit_job/{job_id}', [EmployeeController::class, 'editJob']);
    Route::get('supervisor/job/view_all_completed_job', [EmployeeController::class, 'btnViewAllCompletedJob']);
    Route::get('supervisor/job/view_all_job_require_assistance', [EmployeeController::class, 'btnViewAllJobRequireAssistance']);
    Route::get('supervisor/job/send_assistance/{job_id}', [EmployeeController::class, 'btnAssistanceOver']);
    Route::get('supervisor/job/view_deleted_job', [EmployeeController::class, 'btnViewAllDeletedJob']);
    Route::get('supervisor/job/view_report/{job_id}', [EmployeeController::class, 'btnViewReport']);
    Route::post('supervisor/job/create_new_job', [EmployeeController::class, 'createAndAssignedJob']);
    Route::post('supervisor/job/create_job_assistance', [EmployeeController::class, 'createJobAssistance']);
});

// TECHNICIAN [24]
Route::group(['middleware' => 'technician'], function (){
    // DASHBOARD
    Route::get('technician/dashboard', [DashboardController::class, 'dashboard']);

    // SETTINGS
    Route::get('technician/settings/my_account', [AccountController::class, 'technicianAccount']);
    Route::post('technician/settings/my_account', [AccountController::class, 'updateTechnicianAccount']);
    Route::get('technician/settings/change_password', [AccountController::class, 'technicianChangePassword']);
    Route::post('technician/settings/change_password', [AccountController::class, 'updateTechnicianPassword']);

    // JOB
    Route::get('technician/job/view_pending_job', [EmployeeController::class, 'btnViewPendigJob']);
    Route::get('technician/job/request_assistant/{job_id}', [EmployeeController::class, 'btnRequireAssistance']);
    Route::get('technician/job/view_more_job_description/{job_id}', [EmployeeController::class, 'btnTechnicianViewJob']);
    Route::get('technician/job/update_job/{job_id}', [EmployeeController::class, 'btnUpdateJob']);
    Route::get('technician/job/view_my_completed_jobs', [EmployeeController::class, 'btnViewCompletedJob']);
    Route::post('technician/job/update_job/{job_id}', [EmployeeController::class, 'updateJobStatusAndReport']);

    // METER READING
    Route::get('technician/meterreading/view_all_customer_meter_reading', [EmployeeController::class, 'btnViewAllCustomerMeterReadingTechnician']);
    Route::get('technician/meterreading/view_individual_customer_meter_reading/{customer_id}', [EmployeeController::class, 'btnViewIndividualCustomerMeterReadingTechnician']);
    Route::get('autoSearchCustomerMeterTechnician', [EmployeeController::class, 'autoSearchCustomerMeterTechnician']);

    // CUSTOMER MANAGEMENT
    Route::get('technician/customermanagement/view_customer_by_region', [EmployeeController::class, 'btnViewAllCustomerRegionTechnician']);
    Route::get('autoSearchCustomerRegionTechnician', [EmployeeController::class, 'autoSearchCustomerRegionTechnician']);
    Route::get('technician/customermanagement/view_customer_north_region', [EmployeeController::class, 'btnViewAllCustomerNorthRegionTechnician']);
    Route::get('autoSearchCustomerNorthRegionTechnician', [EmployeeController::class, 'autoSearchCustomerNorthRegionTechnician']);
    Route::get('technician/customermanagement/view_customer_south_region', [EmployeeController::class, 'btnViewAllCustomerSouthRegionTechnician']);
    Route::get('autoSearchCustomerSouthRegionTechnician', [EmployeeController::class, 'autoSearchCustomerSouthRegionTechnician']);
    Route::get('technician/customermanagement/view_customer_east_region', [EmployeeController::class, 'btnViewAllCustomerEastRegionTechnician']);
    Route::get('autoSearchCustomerEastRegionTechnician', [EmployeeController::class, 'autoSearchCustomerEastRegionTechnician']);
    Route::get('technician/customermanagement/view_customer_west_region', [EmployeeController::class, 'btnViewAllCustomerWestRegionTechnician']);
    Route::get('autoSearchCustomerWestRegionTechnician', [EmployeeController::class, 'autoSearchCustomerWestRegionTechnician']);




});


// COMMING SOON [ALL NEWLY ROLES (except: HR & CUSTOMER SERVICE, SUPERVISOR, TECHNICIANS)]
Route::group(['middleware' => 'commingsoon'], function (){
    Route::get('commingsoon', [DashboardController::class, 'dashboard']);
});
