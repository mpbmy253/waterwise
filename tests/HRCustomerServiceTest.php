<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

// $response->assertRedirect();
// $response->assertStatus(200);  // Status: OK

// DB::beginTransaction();
// DB::rollBack();

// To run: php artisan test tests/HRCustomerServiceTest.php

class HRCustomerServiceTest extends TestCase
{
    // Test the 'dashboard' route
    public function test_ToViewHrCustomerServiceDashboard()
    {
        $response = $this->get('/hr_customer_service/dashboard');
        $response->assertRedirect();
    }

    // Test the 'HrCustomerServiceAccount' route
    public function test_ToViewHrCustomerServiceAccount()
    {
        $response = $this->get('/hr_customer_service/settings/my_account');
        $response->assertRedirect();
    }

    // Test the 'updateHrCustomerServiceAccount' route
    public function test_ToUpdateHrCustomerServiceAccount()
    {
        $formData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'mobile' => '123456789',
            'gender' => 'Male',
        ];

        $response = $this->withoutMiddleware()->post('/hr_customer_service/settings/my_account', $formData);
        $response->assertStatus(200);
    }

	// Test the 'HrCustomerServiceChangePassword' route
    public function test_ToViewHrCustomerServiceChangePassword()
    {
        $response = $this->get('/hr_customer_service/settings/change_password');
        $response->assertRedirect();
    }

    // Test the 'updateHrCustomerServicePassword' route
    public function test_ToUpdateHrCustomerServicePassword()
    {
        $formData = [
            'password' => '123456789',
        ];

        $response = $this->withoutMiddleware()->post('/hr_customer_service/settings/change_password', $formData);
        $response->assertStatus(200);
    }

    // Test the 'btnViewAllCustomerBillings' route
    public function test_ToViewAllCustomerBillings()
    {
        $response = $this->get('/hr_customer_service/customerbilling/view_all_customer_pending_bills');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerPendingBill' route
    public function test_ToSearchCustomerPendingBill()
    {
        $response = $this->get('/autoSearchCustomerPendingBill');
        $response->assertRedirect();
    }

    // Test the 'btnToSendBillAlert' route
    public function test_ToSendBillAlert()
    {
        $response = $this->get('/hr_customer_service/customerbilling/send_bill_alert/{customer_id}');
        $response->assertRedirect();
    }

    // Test the 'btnViewVoidBills' route
    public function test_ToViewVoidBills()
    {
        $response = $this->get('/hr_customer_service/customerbilling/view_void_bills');
        $response->assertRedirect();
    }

    // Test the 'voidBills' route
    public function test_ToVoidBills()
    {
        $response = $this->get('/hr_customer_service/customerbilling/void_bills/{customer_id}');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerPayment' route
    public function test_ToViewAllCustomerPayment()
    {
        $response = $this->get('/hr_customer_service/customerpayment/view_all_customer_payment');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerPaidBill' route
    public function test_ToSearchCustomerPaidBill()
    {
        $response = $this->get('/autoSearchCustomerPaidBill');
        $response->assertRedirect();
    }

    // Test the 'btnViewIndividualCustomerPayment' route
    public function test_ToViewIndividualCustomerPayment()
    {
        $response = $this->get('/hr_customer_service/customerpayment/view_individual_customer_payment_history/{customer_id}');
        $response->assertRedirect();
    }

    // Test the 'btnViewFeedbacks' route
    public function test_ToViewFeedbacks()
    {
        $response = $this->get('/hr_customer_service/customerinteraction/view_feedback');
        $response->assertRedirect();
    }

    // Test the 'btnViewIndividialFeedback' route
    public function test_ToViewIndividualFeedback()
    {
        $response = $this->get('/hr_customer_service/customerinteraction/view_feedback/{feedback_id}');
        $response->assertRedirect();
    }

    // Test the 'btndeleteFeedback' route
    public function test_ToDeleteFeedback()
    {
        $response = $this->get('/hr_customer_service/customerinteraction/delete_feedback/{feedback_id}');
        $response->assertRedirect();
    }

    // Test the 'replyFeedback' route
    public function test_ToReplyFeedback()
    {
        $formData = [
            'reply_feedback' => 'John',
        ];

        $response = $this->withoutMiddleware()->post('/hr_customer_service/customerinteraction/reply_feedback', $formData);
        $response->assertStatus(302);
    }

    // Test the 'btnViewServiceRequest' route
    public function test_ToViewServiceRequest()
    {
        $response = $this->get('/hr_customer_service/customerinteraction/view_service_request');
        $response->assertRedirect();
    }

    // Test the 'btnViewIndividialServiceRequest' route
    public function test_ToViewIndividialServiceRequest()
    {
        $response = $this->get('/hr_customer_service/customerinteraction/view_service_request/{service_id}');
        $response->assertRedirect();
    }

    // Test the 'btnSendTechnicianOverToService' route
    public function test_ToSendTechnicianOverToService()
    {
        $response = $this->get('/hr_customer_service/customerinteraction/sent_technician_over/{service_id}');
        $response->assertRedirect();
    }

    /*
    // Test the 'btnViewAllCustomerBank' route
    public function test_ToViewAllCustomerBank()
    {
        $response = $this->get('/hr_customer_service/customermanagement/view_all_customer_bank');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerBank' route
    public function test_ToSearchCustomerBank()
    {
        $response = $this->get('/autoSearchCustomerBank');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerRegionHR' route
    public function test_ToViewAllCustomerRegionHr()
    {
        $response = $this->get('/hr_customer_service/customermanagement/view_customer_by_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerRegionHR' route
    public function test_ToSearchCustomerRegionHr()
    {
        $response = $this->get('/autoSearchCustomerRegionHR');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerNorthRegionHR' route
    public function test_ToViewAllCustomerNorthRegionHr()
    {
        $response = $this->get('/hr_customer_service/customermanagement/view_customer_north_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerNorthRegionHR' route
    public function test_ToSearchCustomerNorthRegionHr()
    {
        $response = $this->get('/autoSearchCustomerNorthRegionHR');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerSouthRegionHR' route
    public function test_ToViewAllCustomerSouthRegionHr()
    {
        $response = $this->get('/hr_customer_service/customermanagement/view_customer_south_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerSouthRegionHR' route
    public function test_ToSearchCustomerSouthRegionHr()
    {
        $response = $this->get('/autoSearchCustomerSouthRegionHR');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerEastRegionHR' route
    public function test_ToViewAllCustomerEastRegionHr()
    {
        $response = $this->get('/hr_customer_service/customermanagement/view_customer_east_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerEastRegionHR' route
    public function test_ToSearchCustomerEastRegionHr()
    {
        $response = $this->get('/autoSearchCustomerEastRegionHR');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllCustomerWestRegionHR' route
    public function test_ToViewAllCustomerWestRegionHr()
    {
        $response = $this->get('/hr_customer_service/customermanagement/view_customer_west_region');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCustomerWestRegionHR' route
    public function test_ToSearchCustomerWestRegionHr()
    {
        $response = $this->get('/autoSearchCustomerWestRegionHR');
        $response->assertRedirect();
    } */

}
