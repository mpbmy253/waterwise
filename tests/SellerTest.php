<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

// $response->assertRedirect();
// $response->assertStatus(200);  // Status: OK

// DB::beginTransaction();
// DB::rollBack();

// To run: php artisan test tests/SellerTest.php

class SellerTest extends TestCase
{
    // Test the 'dashboard' route
    public function test_ToViewSellerDashboard()
    {
        $response = $this->get('/seller/dashboard');
        $response->assertRedirect();
    }

    // Test the 'sellerAccount' route
    public function test_ToViewSellerAccount()
    {
        $response = $this->get('/seller/settings/my_account');
        $response->assertRedirect();
    }

    // Test the 'updateSellerAccount' route
    public function test_ToUpdateSellerAccount()
    {
        $formData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'mobile' => '123456789',
            'gender' => 'Male',
        ];

        $response = $this->withoutMiddleware()->post('/seller/settings/my_account', $formData);
        $response->assertStatus(200);
    }

	// Test the 'sellerChangePassword' route
    public function test_ToViewSellerChangePassword()
    {
        $response = $this->get('/seller/settings/change_password');
        $response->assertRedirect();
    }

    // Test the 'updateSellerPassword' route
    public function test_ToUpdateSellerPassword()
    {
        $formData = [
            'password' => '123456789',
        ];

        $response = $this->withoutMiddleware()->post('/seller/settings/change_password', $formData);
        $response->assertStatus(200);
    }

    // Test the 'btnAddNewProduct' route
    public function test_ToViewAddNewProduct()
    {
        $response = $this->get('/seller/product/add_new_product');
        $response->assertRedirect();
    }

    // Test the 'btnViewAllProduct' route
    public function test_ToViewAllProduct()
    {
        $response = $this->get('/seller/product/view_all_products');
        $response->assertRedirect();
    }

    // Test the 'btnViewIndivialProduct' route
    public function test_ToViewIndivialProduct()
    {
        $response = $this->get('/seller/product/view_individual_product/{product_id}');
        $response->assertRedirect();
    }

    // Test the 'btnEditProduct' route
    public function test_ToViewEditProduct()
    {
        $response = $this->get('/seller/product/edit_product/{product_id}');
        $response->assertRedirect();
    }

    // Test the 'btnViewDeleteProduct' route
    public function test_ToViewDeleteProduct()
    {
        $response = $this->get('/seller/product/view_delete_product');
        $response->assertRedirect();
    }

    // Test the 'deleteProduct' route
    public function test_ToDeleteProduct()
    {
        $response = $this->get('/seller/product/delete_product/{product_id}');
        $response->assertRedirect();
    }

    // Test the 'autoSearchProducts' route
    public function test_ToAutoSearchProducts()
    {
        $response = $this->get('/autoSearchProducts');
        $response->assertRedirect();
    }








}
