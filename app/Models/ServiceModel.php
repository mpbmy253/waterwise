<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceModel extends Model
{
    use HasFactory;
    protected $table = 'service';
    protected $primaryKey = 'service_id';
    public $incrementing = true;
    public $timestamps = false;

    // TO GET SINGLE RECORD OF QUERY
    static function ToSingleService($service_id)
    {
        return ServiceModel::find($service_id);
    }

    // TO GET ALL SERVICE REQUEST
    static function ToGetAllServiceRequest()
    {
        $records = ServiceModel::select('*',)
                ->join('customer', 'service.customer_id', '=', 'customer.customer_id')
                ->join('users', 'customer.user_id', '=', 'users.id')
                ->where('service.service_status', 0)
                ->orderBy('service.service_date', 'desc')
                ->paginate(15);
        return $records;
    }

    // TO GET INDIVIDUAL SERVICE REQUEST
    static function ToGetIndividualServiceRequest($service_id)
    {
        $records = ServiceModel::select("*",DB::raw("CONCAT(users.fname, ' ', users.lname) as customer_name"))
            ->join('customer', 'service.customer_id', '=', 'customer.customer_id')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->where('service.service_id', $service_id)
            ->first();
        return $records;
    }

    // TO GET DATE OF SERVICE REQUEST
    static function ToGetDateFromServiceRequest($service_id)
    {
        $records = ServiceModel::select('*')
            ->where('service.service_id', $service_id)
            ->get();
        return $records;
    }
}
