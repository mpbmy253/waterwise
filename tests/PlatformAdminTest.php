<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

// $response->assertRedirect();
// $response->assertStatus(200);  // Status: OK

// DB::beginTransaction();
// DB::rollBack();

// To run: php artisan test tests/PlatformAdminTest.php

class PlatformAdminTest extends TestCase
{
    // Test the 'dashboard' route
    public function test_ToViewPlatformDashboard()
    {
        $response = $this->get('/platformadmin/dashboard');
        $response->assertRedirect();
    }

    // Test the 'platformAdminAccount' route
    public function test_ToViewPlatformAdminAccount()
    {
        $response = $this->get('/platformadmin/settings/my_account');
        $response->assertRedirect();
    }

    // Test the 'updatePlatformAdminAccount' route
    public function test_ToUpdatePlatformAdminAccount()
    {
        $formData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'mobile' => '123456789',
            'gender' => 'Male',
        ];

        $response = $this->withoutMiddleware()->post('/platformadmin/settings/my_account', $formData);
        $response->assertStatus(200);
    }

	// Test the 'platformAdminChangePassword' route
    public function test_ToViewPlatformAdminChangePassword()
    {
        $response = $this->get('/platformadmin/settings/change_password');
        $response->assertRedirect();
    }

    // Test the 'updatePlatformAdminPassword' route
    public function test_ToUpdatePlatformAdminPassword()
    {
        $formData = [
            'password' => '123456789',
        ];

        $response = $this->withoutMiddleware()->post('/platformadmin/settings/change_password', $formData);
        $response->assertStatus(200);
    }

    // Test the 'btnViewAllCompany' route
    public function test_ToViewAllCompany()
    {
        $response = $this->get('/platformadmin/settings/change_password');
        $response->assertRedirect();
    }

    // Test the 'autoSearchCompany' route
    public function test_ToSearchCompany()
    {
        $response = $this->get('/autoSearchCompany');
        $response->assertRedirect();
    }

    // Test the 'btnViewPendingCompany' route
    public function test_ToViewPendingCompan()
    {
        $response = $this->get('/platformadmin/company/view_all_company');
        $response->assertRedirect();
    }

    // Test the 'approvedCompany' route
    public function test_ToApprovedCompany()
    {
        $response = $this->get('/platformadmin/company/approve/{company_id}');
        $response->assertRedirect();
    }

    // Test the 'btnViewSuspendCompany' route
    public function test_ToViewViewSuspendCompany()
    {
        $response = $this->get('/platformadmin/company/view_suspend_company');
        $response->assertRedirect();
    }

    // Test the 'suspendCompany' route
    public function test_ToSuspendCompany()
    {
        $response = $this->get('/platformadmin/company/suspend_company/{company_id}');
        $response->assertRedirect();
    }

    // Test the 'btnCreateNewSystemAdminForCompany' route
    public function test_ToViewCreateNewSystemAdminForCompany()
    {
        $response = $this->get('/platformadmin/account/create_new_sys_admin_account_for_company');
        $response->assertRedirect();
    }

    // Test the 'createNewSystemAdminForCompany' route
    public function test_ToCreateNewSystemAdminForCompany()
    {
        $formData = [
            'username' => 'johndoe',
            'password' => '1234'
        ];
        $response = $this->withoutMiddleware()->post('/platformadmin/account/create_new_sys_admin_account_for_company', $formData);
        $response->assertStatus(200);
    }

    // Test the 'findUserDetailsBaasedOnCompanySelection' route
    public function test_ToFindUserDetailsBaasedOnCompanySelection()
    {
        $response = $this->get('/autoFillUserDetailsBasedOnCompanySelection');
        $response->assertRedirect();
    }

    // Test the 'btnToSendEmailToCompany' route
    public function test_ToSendEmailToCompany()
    {
        $response = $this->get('/platformadmin/company/send_email');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllSeller' route
    public function test_ToViewAllSeller()
    {
        $response = $this->get('/platformadmin/seller/view_all_seller');
        $response->assertRedirect();
    }

    // Test the 'autoSearchSeller' route
    public function test_ToSearchSeller()
    {
        $response = $this->get('/autoSearchSeller');
        $response->assertRedirect();
    }

    // Test the 'btnViewPendingSeller' route
    public function test_ToViewPendingSelle()
    {
        $response = $this->get('/platformadmin/seller/view_pending_seller');
        $response->assertRedirect();
    }

    // Test the 'approvedSeller' route
    public function test_ToApprovedSeller()
    {
        $response = $this->get('/platformadmin/seller/approve/{company_id}');
        $response->assertRedirect();
    }

    // Test the 'btnCreateNewSystemAdminForSeller' route
    public function test_ToViewCreateNewSystemAdminForSeller()
    {
        $response = $this->get('/platformadmin/account/create_new_sys_admin_account_for_seller');
        $response->assertRedirect();
    }

    // Test the 'createNewSystemAdminForSeller' route
    public function test_ToCreateNewSystemAdminForSeller()
    {
        $formData = [
            'username' => 'johndoe',
            'password' => '1234'
        ];
        $response = $this->withoutMiddleware()->post('/platformadmin/account/create_new_sys_admin_account_for_seller', $formData);
        $response->assertStatus(200);
    }

    // Test the 'findUserDetailsBaasedOnSellerSelection' route
    public function test_ToFindUserDetailsBaasedOnSellerSelection()
    {
        $response = $this->get('/autoFillUserDetailsBasedOnSellerSelection');
        $response->assertRedirect();
    }

    // Test the 'btnToSendEmailToSeller' route
    public function test_ToSendEmailToSeller()
    {
        $response = $this->get('/platformadmin/seller/send_email');
        $response->assertRedirect();
    }

}
