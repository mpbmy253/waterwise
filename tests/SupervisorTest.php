<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

// $response->assertRedirect();
// $response->assertStatus(200);  // Status: OK

// DB::beginTransaction();
// DB::rollBack();

// To run: php artisan test tests/SupervisorTest.php

class SupervisorTest extends TestCase
{
    // Test the 'dashboard' route
    public function test_ToViewSupervisorDashboard()
    {
        $response = $this->get('/supervisor/dashboard');
        $response->assertRedirect();
    }

    // Test the 'supervisorAccount' route
    public function test_ToViewSupervisorAccount()
    {
        $response = $this->get('/supervisor/settings/my_account');
        $response->assertRedirect();
    }

    // Test the 'updateSupervisorAccount' route
    public function test_ToUpdateSupervisorAccount()
    {
        $formData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'mobile' => '123456789',
            'gender' => 'Male',
        ];

        $response = $this->withoutMiddleware()->post('/supervisor/settings/my_account', $formData);
        $response->assertStatus(200);
    }

	// Test the 'supervisorChangePassword' route
    public function test_ToViewSupervisorChangePassword()
    {
        $response = $this->get('/supervisor/settings/change_password');
        $response->assertRedirect();
    }

    // Test the 'updateSupervisorPassword' route
    public function test_ToUpdateSupervisorPassword()
    {
        $formData = [
            'password' => '123456789',
        ];

        $response = $this->withoutMiddleware()->post('/supervisor/settings/change_password', $formData);
        $response->assertStatus(200);
    }

    // Test the 'btnAddNewEquipment' route
    public function test_ToAViewddNewEquipment()
    {
        $response = $this->get('/supervisor/equipment/create_new_equipment');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllEquipment' route
    public function test_ToViewAllEquipment()
    {
        $response = $this->get('/supervisor/equipment/view_all_equipment');
        $response->assertRedirect();
    }

    // Test the 'btnViewIndividialEquipment' route
    public function test_ToViewIndividialEquipment()
    {
        $response = $this->get('/supervisor/equipment/view_individual_equipment/{equipment_id}');
        $response->assertRedirect();
    }

    // Test the 'autoSearchEquipments' route
    public function test_ToSearchEquipments()
    {
        $response = $this->get('/autoSearchEquipments');
        $response->assertRedirect();
    }

    // Test the 'btnEditEquipment' route
    public function test_ToViewEditEquipment()
    {
        $response = $this->get('/supervisor/equipment/edit_equipment/{equipment_id}');
        $response->assertRedirect();
    }

    // Test the 'btnViewDeletedEquipment' route
    public function test_ToViewDeletedEquipment()
    {
        $response = $this->get('/supervisor/equipment/view_deleted_equipment');
        $response->assertRedirect();
    }

    // Test the 'btnViewSuspendEquipment' route
    public function test_ToViewSuspendEquipment()
    {
        $response = $this->get('/supervisor/equipment/view_suspend_equipment');
        $response->assertRedirect();
    }

    // Test the 'deleteEquipment' route
    public function test_ToDeleteEquipment()
    {
        $response = $this->get('/supervisor/equipment/delete_equipment/{equipment_id}');
        $response->assertRedirect();
    }

    // Test the 'suspendEquipment' route
    public function test_ToSuspendEquipment()
    {
        $response = $this->get('/supervisor/equipment/suspend_equipment/{equipment_id}');
        $response->assertRedirect();
    }

    // Test the 'restoreEquipment' route
    public function test_ToRestoreEquipment()
    {
        $response = $this->get('/supervisor/equipment/restore_equipment/{equipment_id}');
        $response->assertRedirect();
    }

    // Test the 'activateEquipment' route
    public function test_ToActivateEquipment()
    {
        $response = $this->get('/supervisor/equipment/activate_equipment/{equipment_id}');
        $response->assertRedirect();
    }

    // Test the 'addNewEquipment' route
    public function test_ToAddNewEquipment()
    {
        $formData = [
            'equipment_name' => 'Test Equipment',
            'equipment_qty' => '10',
            'equipment_price' => '200',
            'date' => '2021-08-30',
            'guarantee_period' => '1',
            'replacement_period' => '10',
            'flow_rate' => '500',
            'power_consumption' => '10',
            'pressure_capacity' => '200',
            'voltage_requirements' => '5'
        ];
        $response = $this->withoutMiddleware()->post('/supervisor/equipment/create_new_equipment', $formData);
        $response->assertStatus(302);
    }

    // Test the 'editEquipment' route
    public function test_ToEditEquipment()
    {
        $formData = [
            'equipment_name' => 'Test Equipment',
            'equipment_qty' => '10',
            'equipment_price' => '200',
            'date' => '2021-08-30',
            'guarantee_period' => '1',
            'replacement_period' => '10',
            'flow_rate' => '500',
            'power_consumption' => '10',
            'pressure_capacity' => '200',
            'voltage_requirements' => '5'
        ];
        $equipment_id = 1;
        $response = $this->withoutMiddleware()->post('/supervisor/equipment/edit_equipment/{equipment_id}', $formData);
        $response->assertStatus(302);
    }

	// Test the 'btnAddNewChemical' route
    public function test_ToViewAddNewChemical()
    {
        $response = $this->get('/supervisor/chemical/create_new_chemical');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllChemical' route
    public function test_ToViewAllChemical()
    {
        $response = $this->get('/supervisor/chemical/view_all_chemical');
        $response->assertRedirect();
    }

    // Test the 'btnViewIndividialChemical' route
    public function test_ToViewIndividialChemical()
    {
        $response = $this->get('/supervisor/chemical/view_individual_chemical/{chemical_id}');
        $response->assertRedirect();
    }

    // Test the 'autoSearchChemicals' route
    public function test_ToAutoSearchChemicals()
    {
        $response = $this->get('/autoSearchChemicals');
        $response->assertRedirect();
    }

    // Test the 'btnEditChemical' route
    public function test_ToViewEditChemical()
    {
        $response = $this->get('/supervisor/chemical/edit_chemical/{chemical_id}');
        $response->assertRedirect();
    }

    // Test the 'btnViewDeletedChemical' route
    public function test_ToViewDeletedChemical()
    {
        $response = $this->get('/supervisor/chemical/view_deleted_chemical');
        $response->assertRedirect();
    }

    // Test the 'btnViewSuspendChemical' route
    public function test_ToViewSuspendChemical()
    {
        $response = $this->get('/supervisor/chemical/view_suspend_chemical');
        $response->assertRedirect();
    }

    // Test the 'deleteChemical' route
    public function test_ToDeleteChemical()
    {
        $response = $this->get('/supervisor/chemical/delete_chemical/{chemical_id}');
        $response->assertRedirect();
    }

    // Test the 'suspendChemical' route
    public function test_ToSuspendChemical()
    {
        $response = $this->get('/supervisor/chemical/suspend_chemical/{chemical_id}');
        $response->assertRedirect();
    }

    // Test the 'restoreChemical' route
    public function test_ToRestoreChemical()
    {
        $response = $this->get('/supervisor/chemical/restore_chemical/{chemical_id}');
        $response->assertRedirect();
    }

    // Test the 'activateChemical' route
    public function test_ToActivateChemical()
    {
        $response = $this->get('/supervisor/chemical/activate_chemical/{chemical_id}');
        $response->assertRedirect();
    }

    // Test the 'addNewChemical' route
    public function test_ToAddNewChemical()
    {
        $formData = [
            'chemical_name' => 'Test Chemical',
            'chemical_qty' => '10',
            'chemical_price' => '20',
            'using_time' => '5',
            'chemical_level' => '5'
        ];
        $response = $this->withoutMiddleware()->post('/supervisor/chemical/create_new_chemical', $formData);
        $response->assertStatus(302);
    }

    // Test the 'editChemical' route
    public function test_ToEditChemical()
    {
        $formData = [
            'chemical_name' => 'Test Chemical',
            'chemical_qty' => '10',
            'chemical_price' => '20',
            'using_time' => '5',
            'chemical_level' => '5'
        ];
        $chemical_id = 1;
        $response = $this->withoutMiddleware()->post('/supervisor/chemical/edit_chemical/{chemical_id}', $formData);
        $response->assertStatus(302);
    }

	// Test the 'btnAddNewWaterSupplyEquipment' route
    public function test_ToViewAddNewWaterSupplyEquipment()
    {
        $response = $this->get('/supervisor/water_supply_equipment/create_new_water_supply_equipment');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllWaterSupplyEquipment' route
    public function test_ToViewAllWaterSupplyEquipment()
    {
        $response = $this->get('/supervisor/water_supply_equipment/view_all_water_supply_equipment');
        $response->assertRedirect();
    }

    // Test the 'btnViewIndividialWaterSupplyEquipment' route
    public function test_ToViewIndividialWaterSupplyEquipment()
    {
        $response = $this->get('/supervisor/water_supply_equipment/view_individual_water_supply_equipment/{water_supply_equipment_id}');
        $response->assertRedirect();
    }

    // Test the 'autoSearchWaterSupplyEquipment' route
    public function test_ToAutoSearchWaterSupplyEquipment()
    {
        $response = $this->get('/autoSearchWaterSupplyEquipment');
        $response->assertRedirect();
    }

    // Test the 'btnEditWaterSupplyEquipment' route
    public function test_ToViewEditWaterSupplyEquipment()
    {
        $response = $this->get('/supervisor/water_supply_equipment/edit_water_supply_equipment/{water_supply_equipment_id}');
        $response->assertRedirect();
    }

    // Test the 'btnViewDeletedWaterSupplyEquipment' route
    public function test_ToViewDeletedWaterSupplyEquipment()
    {
        $response = $this->get('/supervisor/water_supply_equipment/view_deleted_water_supply_equipment');
        $response->assertRedirect();
    }

    // Test the 'btnViewSuspendWaterSupplyEquipment' route
    public function test_ToViewSuspendWaterSupplyEquipment()
    {
        $response = $this->get('/supervisor/water_supply_equipment/view_suspend_water_supply_equipment');
        $response->assertRedirect();
    }

    // Test the 'deleteWaterSupplyEquipment' route
    public function test_ToDeleteWaterSupplyEquipment()
    {
        $response = $this->get('/supervisor/water_supply_equipment/delete_water_supply_equipment/{water_supply_equipment_id}');
        $response->assertRedirect();
    }

    // Test the 'suspendWaterSupplyEquipment' route
    public function test_ToSuspendWaterSupplyEquipment()
    {
        $response = $this->get('/supervisor/water_supply_equipment/suspend_water_supply_equipment/{water_supply_equipment_id}');
        $response->assertRedirect();
    }

    // Test the 'restoreWaterSupplyEquipment' route
    public function test_ToRestoreWaterSupplyEquipment()
    {
        $response = $this->get('/supervisor/water_supply_equipment/restore_water_supply_equipment/{water_supply_equipment_id}');
        $response->assertRedirect();
    }

    // Test the 'activateWaterSupplyEquipment' route
    public function test_ToActivateWaterSupplyEquipment()
    {
        $response = $this->get('/supervisor/water_supply_equipment/activate_water_supply_equipment/{water_supply_equipment_id}');
        $response->assertRedirect();
    }

    // Test the 'addNewWaterSupplyEquipment' route
    public function test_ToAddNewWaterSupplyEquipment()
    {
        $formData = [
            'water_supply_equipment_name' => 'Test Water Equipment',
            'water_supply_equipment_qty' => '10',
            'water_supply_equipment_price' => '20',
            'water_supply_equipment_description' => 'Test Water Equipment Description',
        ];
        $response = $this->withoutMiddleware()->post('/supervisor/water_supply_equipment/create_new_water_supply_equipment', $formData);
        $response->assertStatus(302);
    }

    // Test the 'editWaterSupplyEquipment' route
    public function test_ToEditWaterSupplyEquipment()
    {
        $formData = [
            'water_supply_equipment_name' => 'Test Water Equipment',
            'water_supply_equipment_qty' => '10',
            'water_supply_equipment_price' => '20',
            'water_supply_equipment_description' => 'Test Water Equipment Description',
        ];
        $water_supply_equipment_id = 1;
        $response = $this->withoutMiddleware()->post('/supervisor/water_supply_equipment/edit_water_supply_equipment/{water_supply_equipment_id}', $formData);
        $response->assertStatus(302);
    }

	// Test the 'btnViewAllCustomerMeterReadingSupervisor' route
    public function test_ToViewAllCustomerMeterReadingSupervisor()
    {
        $response = $this->get('/supervisor/report_analysis/view_all_customer_meter_reading');
        $response->assertRedirect();
    }

    // Test the 'btnViewIndividualCustomerMeterReadingSupervisor' route
    public function test_ToViewIndividualCustomerMeterReadingSupervisor()
    {
        $response = $this->get('/supervisor/report_analysis/view_individual_customer_meter_reading/{customer_id}');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerMeterSupervisor' route
    public function test_ToAutoSearchCustomerMeterSupervisor()
    {
        $response = $this->get('/autoSearchCustomerMeterSupervisor');
        $response->assertRedirect();
    }

	// Test the 'btnViewAllCustomerRegionSupervisor' route
    public function test_ToViewAllCustomerRegionSupervisor()
    {
        $response = $this->get('/supervisor/report_analysis/view_customer_by_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerRegionSupervisor' route
    public function test_ToAutoSearchCustomerRegionSupervisor()
    {
        $response = $this->get('/autoSearchCustomerRegionSupervisor');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerNorthRegionSupervisor' route
    public function test_ToViewAllCustomerNorthRegionSupervisor()
    {
        $response = $this->get('/supervisor/report_analysis/view_customer_north_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerNorthRegionSupervisor' route
    public function test_ToAutoSearchCustomerNorthRegionSupervisor()
    {
        $response = $this->get('/autoSearchCustomerNorthRegionSupervisor');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerSouthRegionSupervisor' route
    public function test_ToViewAllCustomerSouthRegionSupervisor()
    {
        $response = $this->get('/supervisor/report_analysis/view_customer_south_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerSouthRegionSupervisor' route
    public function test_ToAutoSearchCustomerSouthRegionSupervisor()
    {
        $response = $this->get('/autoSearchCustomerSouthRegionSupervisor');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerEastRegionSupervisor' route
    public function test_ToViewAllCustomerEastRegionSupervisor()
    {
        $response = $this->get('/supervisor/report_analysis/view_customer_east_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerEastRegionSupervisor' route
    public function test_ToAutoSearchCustomerEastRegionSupervisor()
    {
        $response = $this->get('/autoSearchCustomerEastRegionSupervisor');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerWestRegionSupervisor' route
    public function test_ToViewAllCustomerWestRegionSupervisor()
    {
        $response = $this->get('/supervisor/report_analysis/view_customer_west_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerWestRegionSupervisor' route
    public function test_ToAutoSearchCustomerWestRegionSupervisor()
    {
        $response = $this->get('/autoSearchCustomerWestRegionSupervisor');
        $response->assertRedirect();
    }

	// Test the 'btnCreateNewJob' route
    public function test_ToViewCreateNewJob()
    {
        $response = $this->get('/supervisor/job/create_new_job');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllPendingJob' route
    public function test_ToViewAllPendingJob()
    {
        $response = $this->get('/supervisor/job/view_all_pending_job');
        $response->assertRedirect();
    }

    // Test the 'autoSearchAllPendingJobs' route
    public function test_ToAutoSearchAllPendingJobs()
    {
        $response = $this->get('/autoSearchAllPendingJobs');
        $response->assertRedirect();
    }

    // Test the 'btnSupervisorViewIndividualJob' route
    public function test_ToSupervisorViewIndividualJob()
    {
        $response = $this->get('/supervisor/job/view_more_job_description/{job_id}');
        $response->assertRedirect();
    }

    // Test the 'btnSupervisorEditJob' route
    public function test_ToSupervisorEditJob()
    {
        $response = $this->get('/supervisor/job/edit_job/{job_id}');
        $response->assertRedirect();
    }

    // Test the 'deleteJob' route
    public function test_ToDeleteJob()
    {
        $response = $this->get('/supervisor/job/delete_job/{job_id}');
        $response->assertRedirect();
    }

    // Test the 'editJob' route
    public function test_ToEditJob()
    {
        $formData = [
            'job_start_time' => '09:00',
            'job_description' => 'Test Job Description',
        ];
        DB::beginTransaction();
        $job_id = 1;
        $response = $this->withoutMiddleware()->post('/supervisor/job/edit_job/'. $job_id, $formData);
        $response->assertStatus(302);
        DB::rollBack();
    }

    // Test the 'btnViewAllCompletedJob' route
    public function test_ToViewAllCompletedJob()
    {
        $response = $this->get('/supervisor/job/view_all_completed_job');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllJobRequireAssistance' route
    public function test_ToViewAllJobRequireAssistance()
    {
        $response = $this->get('/supervisor/job/view_all_job_require_assistance');
        $response->assertRedirect();
    }

    // Test the 'btnAssistanceOver' route
    public function test_ToSendAssistanceOver()
    {
        $response = $this->get('/supervisor/job/send_assistance');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllDeletedJob' route
    public function test_ToViewAllDeletedJob()
    {
        $response = $this->get('/supervisor/job/view_deleted_job');
        $response->assertRedirect();
    }

    // Test the 'btnViewReport' route
    public function test_ToViewReport()
    {
        $response = $this->get('/supervisor/job/view_report/{job_id}');
        $response->assertRedirect();
    }

    // Test the 'createAndAssignedJob' route
    public function test_ToCreateAndAssignedJob()
    {
        $formData = [
            'employee_id' => 1,
            'customer_id' => 1,
            'date' => '2023-07-06',
            'start_time' => '09:00',
            'job_description' => 'Test Job Description',
        ];
        DB::beginTransaction();
        $response = $this->withoutMiddleware()->post('/supervisor/job/create_new_job', $formData);
        $response->assertStatus(302);
        DB::rollBack();
    }

    // Test the 'createJobAssistance' route
    public function test_ToCreateJobAssistance()
    {
        $formData = [
            'employee_id' => 1,
            'customer_id' => 1,
            'date' => '2023-07-06',
            'start_time' => '09:00',
            'job_description' => 'Asssiting',
        ];
        DB::beginTransaction();
        $response = $this->withoutMiddleware()->post('/supervisor/job/create_job_assistance', $formData);
        $response->assertStatus(302);
        DB::rollBack();
    }
}
