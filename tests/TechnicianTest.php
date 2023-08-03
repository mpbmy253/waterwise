<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

// $response->assertRedirect();
// $response->assertStatus(200);  // Status: OK

// DB::beginTransaction();
// DB::rollBack();

// To run: php artisan test tests/TechnicianTest.php

class TechnicianTest extends TestCase
{
    // Test the 'dashboard' route
    public function test_ToViewTechnicianDashboard()
    {
        $response = $this->get('/technician/dashboard');
        $response->assertRedirect();
    }

    // Test the 'technicianAccount' route
    public function test_ToViewTechnicianAccount()
    {
        $response = $this->get('/technician/settings/my_account');
        $response->assertRedirect();
    }

    // Test the 'updateTechnicianAccount' route
    public function test_ToUpdateTechnicianAccount()
    {
        $formData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'mobile' => '123456789',
            'gender' => 'Male',
        ];

        $response = $this->withoutMiddleware()->post('/technician/settings/my_account', $formData);
        $response->assertStatus(200);
    }

	// Test the 'technicianChangePassword' route
    public function test_ToViewTechnicianChangePassword()
    {
        $response = $this->get('/technician/settings/change_password');
        $response->assertRedirect();
    }

    // Test the 'updateTechnicianPassword' route
    public function test_ToUpdateTechnicianPassword()
    {
        $formData = [
            'password' => '123456789',
        ];

        $response = $this->withoutMiddleware()->post('/technician/settings/change_password', $formData);
        $response->assertStatus(200);
    }

    // Test the 'btnViewPendigJob' route
    public function test_ToViewPendigJob()
    {
        $response = $this->get('/technician/job/view_pending_job');
        $response->assertRedirect();
    }

    // Test the 'btnRequireAssistance' route
    public function test_ToRequireAssistance()
    {
        $response = $this->get('/technician/job/request_assistant/{job_id}');
        $response->assertRedirect();
    }
    // Test the 'btnTechnicianViewJob' route
    public function test_ToTechnicianViewJob()
    {
        $response = $this->get('/technician/job/view_more_job_description/{job_id}');
        $response->assertRedirect();
    }

    // Test the 'btnUpdateJob' route
    public function test_ToUpdateJob()
    {
        $response = $this->get('/technician/job/update_job/{job_id}');
        $response->assertRedirect();
    }

    // Test the 'btnViewCompletedJob' route
    public function test_ToViewCompletedJob()
    {
        $response = $this->get('/technician/job/view_my_completed_jobs');
        $response->assertRedirect();
    }

    // Test the 'updateJobTimeAndStatus' route
    public function test_ToUpdateJobTimeAndStatus()
    {
        $response = $this->get('/technician/job/update_job/{job_id}');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerMeterReadingTechnician' route
    public function test_ToViewAllCustomerMeterReadingTechnician()
    {
        $response = $this->get('/technician/meterreading/view_all_customer_meter_reading');
        $response->assertRedirect();
    }

    // Test the 'btnViewIndividualCustomerMeterReadingTechnician' route
    public function test_ToViewIndividualCustomerMeterReadingTechnician()
    {
        $response = $this->get('/technician/meterreading/view_individual_customer_meter_reading/{customer_id}');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerMeterTechnician' route
    public function test_ToSearchCustomerMeterTechnician()
    {
        $response = $this->get('/autoSearchCustomerMeterTechnician');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerRegionTechnician' route
    public function test_ToViewAllCustomerRegionTechnician()
    {
        $response = $this->get('/technician/customermanagement/view_customer_by_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerRegionTechnician' route
    public function test_ToSearchCustomerRegionTechnician()
    {
        $response = $this->get('/autoSearchCustomerRegionTechnician');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerNorthRegionTechnician' route
    public function test_ToViewAllCustomerNorthRegionTechnician()
    {
        $response = $this->get('/technician/customermanagement/view_customer_north_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerNorthRegionTechnician' route
    public function test_ToSearchCustomerNorthRegionTechnician()
    {
        $response = $this->get('/autoSearchCustomerNorthRegionTechnician');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerSouthRegionTechnician' route
    public function test_ToViewAllCustomerSouthRegionTechnician()
    {
        $response = $this->get('/technician/customermanagement/view_customer_south_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerSouthRegionTechnician' route
    public function test_ToSearchCustomerSouthRegionTechnician()
    {
        $response = $this->get('/autoSearchCustomerSouthRegionTechnician');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerEastRegionTechnician' route
    public function test_ToViewAllCustomerEastRegionTechnician()
    {
        $response = $this->get('/technician/customermanagement/view_customer_east_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerEastRegionTechnician' route
    public function test_ToSearchCustomerEastRegionTechnician()
    {
        $response = $this->get('/autoSearchCustomerEastRegionTechnician');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerWestRegionTechnician' route
    public function test_ToViewAllCustomerWestRegionTechnician()
    {
        $response = $this->get('/technician/customermanagement/view_customer_west_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerWestRegionTechnician' route
    public function test_ToSearchCustomerWestRegionTechnician()
    {
        $response = $this->get('/autoSearchCustomerWestRegionTechnician');
        $response->assertRedirect();
    }
}
