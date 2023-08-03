<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    public $incrementing = true;
    public $timestamps = false;

    // TO GET SINGLE RECORD OF QUERY
    static function ToSingleProduct($product_id)
    {
        return ProductModel::find($product_id);
    }

    // TO GET ALL ACTIVE PRODUCTS
    static function ToViewAllActiveProducts($seller_id)
    {
         $records = ProductModel::select('*',)
                    ->where('seller_id', $seller_id)
                    ->where('product_status', 1)
                    ->paginate(4);
        return $records;
    }

    // TO GET INDIVIDUAL PRODUCT DETAILS
    static function ToProductsDetails($product_id)
    {
        // User Status = 1: Active, 2: Delete, 3: Suspend
        $records = ProductModel::select('*')
                ->where('product_status', 1)
                ->where('product_id', $product_id)
                ->first();
        return $records;
    }

    // TO GET ALL DELETE PRODUCTS
    static function ToViewDeleteProducts($seller_id)
    {
         $records = ProductModel::select('*',)
                    ->where('seller_id', $seller_id)
                    ->where('product_status', 2)
                    ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no delete products !';
        }
        return $records;
    }

}
