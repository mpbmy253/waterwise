<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerBillModel extends Model
{
    use HasFactory;
    protected $table = 'customer_bill';
    protected $primaryKey = 'customer_bill_id';
    public $incrementing = true;
    public $timestamps = false;

    // TO GET SINGLE RECORD OF QUERY
    static function ToSingleCustomerBill($customer_bill_id)
    {
        return CustomerBillModel::find($customer_bill_id);
    }
}
