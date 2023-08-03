<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PipeModel extends Model
{
    use HasFactory;
    protected $table = 'pipe';
    protected $primaryKey = 'pipe_id';
    public $incrementing = true;
    public $timestamps = false;

    // TO GET SINGLE RECORD OF QUERY
    static function ToSingleMeter($customer_id)
    {
        return PipeModel::find($customer_id);
    }

    // TO GET PIPE NAME
    static function getPipeNames($customer_id)
    {
        return PipeModel::where('customer_id', $customer_id)->pluck('pipe_name')->toArray();
    }

    // TO GET LEAK STATUS
    static function getLeakStatus($customer_id)
    {
        return PipeModel::where('customer_id', $customer_id)->pluck('leak_status')->toArray();
    }

    // TO GET METER VALUE
    static function getMeterValue($customer_id)
    {
        return PipeModel::where('customer_id', $customer_id)->pluck('meter_value')->toArray();
    }

    // TO GET PIPE STATUS
    static function getPipeStatus($customer_id)
    {
        return PipeModel::where('customer_id', $customer_id)->pluck('pipe_status')->toArray();
    }

    // TO GET ALL CUSTOMER METER READING
    static function ToViewAllCustomerMeterReading()
    {
        $records = PipeModel::select(
            'customer.customer_id',
            DB::raw("CONCAT(users.fname, ' ', users.lname) AS customer_name"),
            DB::raw('SUM(pipe.meter_value) AS total_meter_value'),
            'customer.region'
        )
            ->join('customer', 'customer.customer_id', '=', 'pipe.customer_id')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->groupBy('customer.customer_id', 'users.fname', 'users.lname', 'customer.region')
            ->paginate(15);

        return $records;
    }
}
