<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

// $response->assertRedirect();
// $response->assertStatus(200);  // Status: OK

// DB::beginTransaction();
// DB::rollBack();

// To run: php artisan test tests/SystemAdminTest.php

class SystemAdminTest extends TestCase
{
    // Test the 'dashboard' route
    public function test_ToViewSystemAdminDashboard()
    {
        $response = $this->get('/systemadmin/dashboard');
        $response->assertRedirect();
    }

    // Test the 'systemAdminAccount' route
    public function test_ToViewSystemAdminAccount()
    {
        $response = $this->get('/systemadmin/settings/my_account');
        $response->assertRedirect();
    }

    // Test the 'updateSystemAdminAccount' route
    public function test_ToUpdateSystemAdminAccount()
    {
        $formData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'mobile' => '123456789',
            'gender' => 'Male',
        ];

        $response = $this->withoutMiddleware()->post('/systemadmin/settings/my_account', $formData);
        $response->assertStatus(200);
    }

	// Test the 'systemAdminChangePassword' route
    public function test_ToViewSystemAdminChangePassword()
    {
        $response = $this->get('/systemadmin/settings/change_password');
        $response->assertRedirect();
    }

    // Test the 'updateSystemAdminPassword' route
    public function test_ToUpdateSystemAdminPassword()
    {
        $formData = [
            'password' => '123456789',
        ];

        $response = $this->withoutMiddleware()->post('/systemadmin/settings/change_password', $formData);
        $response->assertStatus(200);
    }

	// Test the 'btnCreateNewUserProfile' route
    public function test_ToCreateNewUserProfile()
    {
        $response = $this->get('/systemadmin/roles/create_new_roles');
        $response->assertStatus(302);
        $response->assertRedirect();
    }

    // Test the 'btnViewAllUserProfile' route
    public function test_ToViewAllUserProfile()
    {
        $response = $this->get('/systemadmin/roles/view_all_roles');
        $response->assertRedirect();
    }

    // Test the 'btnViewIndividialRole' route
    public function test_ToViewIndividialRole()
    {
        $response = $this->get('/systemadmin/roles/view_individual_role/{role_id}');
        $response->assertRedirect();
    }

    // Test the 'autoSearchUserProfile' route
    public function test_ToSearchUserProfile()
    {
        $response = $this->get('/autoSearchUserProfile');
        $response->assertRedirect();
    }

    // Test the 'btnViewDeletedUserProfile' route
    public function test_ToViewDeleteUserProfile()
    {
        $response = $this->get('/systemadmin/roles/view_deleted_roles');
        $response->assertRedirect();
    }

    // Test the 'btnViewSuspendUserProfile' route
    public function test_ToViewSuspendUserProfile()
    {
        $response = $this->get('/systemadmin/roles/view_suspend_roles');
        $response->assertRedirect();
    }

    // Test the 'btnEditUserProfile' route
    public function test_ToViewEditUserProfile()
    {
        $response = $this->get('/systemadmin/roles/edit_roles/{role_id}');
        $response->assertRedirect();
    }

	// Test the 'deleteUserProfile' route
    public function test_ToDeleteUserProfile()
    {
        $response = $this->get('/systemadmin/roles/delete_roles/{role_id}');
        $response->assertRedirect();
    }

    // Test the 'suspendUserProfile' route
    public function test_ToSuspendUserProfile()
    {
        $response = $this->get('/systemadmin/roles/suspend_roles/{role_id}');
        $response->assertRedirect();
    }

    // Test the 'restoreUserProfile' route
    public function test_ToRestoreUserProfile()
    {
        $response = $this->get('/systemadmin/roles/delete_roles/{role_id}');
        $response->assertRedirect();

    }

    // Test the 'activateUserProfile' route
    public function test_ToActivateUserProfile()
    {
        $response = $this->get('/systemadmin/roles/activate_roles/{role_id}');
        $response->assertRedirect();
    }

	// Test the 'createUserProfile' route
    public function test_ToCreateUserProfile()
    {
        $formData = [
            'role_name' => 'Test Role',
            'role_description' => 'Test Role Description'
        ];

        $response = $this->withoutMiddleware()->post('/systemadmin/roles/create_new_roles', $formData);
        $response->assertStatus(302);
    }

	// Test the 'editUserProfile' route
    public function test_ToEditUserProfile()
    {
        $formData = [
            'role_name' => 'Test Role',
            'role_description' => 'Test Role Description'
        ];

        $role_id = 1;
        $response = $this->withoutMiddleware()->post('/systemadmin/roles/edit_roles/{role_id}', $formData);
        $response->assertStatus(302);
    }

	// Test the 'btnCreateNewAccount' route
    public function test_ToCreateNewAccount()
    {
        $response = $this->get('/systemadmin/account/create_new_account');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllAccount' route
    public function test_ToViewAllAccount()
    {
        $response = $this->get('/systemadmin/account/view_all_account');
        $response->assertRedirect();
    }

    // Test the 'btnViewIndividialAccount' route
    public function test_ToViewIndividualAccount()
    {
        $response = $this->get('/systemadmin/account/view_individual_account/{id}');
        $response->assertRedirect();
    }

    // Test the 'autoSearchAccount' route
    public function test_ToearchAccount()
    {
        $response = $this->get('/autoSearchAccount');
        $response->assertRedirect();
    }

    // Test the 'btnViewDeletedAccount' route
    public function test_ToViewDeleteAccount()
    {
        $response = $this->get('/systemadmin/account/view_deleted_account');
        $response->assertRedirect();
    }

    // Test the 'btnViewSuspendAccount' route
    public function test_ToViewSuspendAccount()
    {
        $response = $this->get('/systemadmin/account/view_suspend_account');
        $response->assertRedirect();
    }

    // Test the 'btnEditAccount' route
    public function test_ToEditAccount()
    {
        $response = $this->get('/systemadmin/account/edit_account/{id}');
        $response->assertRedirect();
    }

    // Test the 'deleteUserAccount' route
    public function test_ToDeleteUserAccount()
    {
        $response = $this->get('/systemadmin/account/delete_account/{id}');
        $response->assertRedirect();
    }

    // Test the 'suspendUserAccount' route
    public function test_ToSuspendUserAccount()
    {
        $response = $this->get('/systemadmin/account/suspend_account/{id}');
        $response->assertRedirect();
    }

    // Test the 'restoreUserAccount' route
    public function test_ToRestoreUserAccount()
    {
        $response = $this->get('/systemadmin/account/restore_account/{id}');
        $response->assertRedirect();
    }

    // Test the 'activateUserAccount' route
    public function test_ToActivateUserAccount()
    {
        $response = $this->get('/systemadmin/account/activate_account/{id}');
        $response->assertRedirect();
    }

	// Test the 'createUserAccount' route
    public function test_ToCreateUserAccount()
    {
        $formData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'mobile' => '123456789',
            'gender' => 'Male',
            'role' => 'Supervisor'
        ];
        $response = $this->withoutMiddleware()->post('/systemadmin/account/create_new_account', $formData);
        $response->assertStatus(302);
    }

    // Test the 'editUserAccount' route
    public function test_ToEditUserAccount()
    {
        $formData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'mobile' => '123456789',
            'gender' => 'Male',
            'role' => 'Technician'
        ];

        $id = 15;
        $response = $this->withoutMiddleware()->post('/systemadmin/account/edit_account/{id}', $formData);
        $response->assertStatus(302);
    }

	// Test the 'btnMakePayment' route
    public function test_ToMakePayment()
    {
        $response = $this->get('/systemadmin/payment/make_payment');
        $response->assertRedirect();
    }

    // Test the 'makePayment' route
    public function test_MakePayment()
    {
        $response = $this->get('/systemadmin/payment/make_payment');
        $response->assertRedirect();
    }
}
