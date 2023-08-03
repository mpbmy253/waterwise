<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerModel extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    public $incrementing = true;
    public $timestamps = false;

    // TO GET SINGLE RECORD OF QUERY
    static function ToSingleCustomer($customer_id)
    {
        return CustomerModel::find($customer_id);
    }

    // TO GET CUSTOMER FULL NAME
    static function ToGetCustomerName($customer_id)
    {
        $records = CustomerModel::select(DB::raw("CONCAT(users.fname, ' ', users.lname) AS customer_name"))
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->where('customer_id', $customer_id)
            ->first();
        return $records;
    }

    // TO GET CUSTOMER DETAILS
    static function ToGetCustomerDetails()
    {
        $records = CustomerModel::select('*',)
                ->join('users', 'customer.user_id', '=', 'users.id')
                ->get();
        return $records;
    }


    // TO GET CUSTOMER WITH REGIONS '-'
    static function ToGetCustomerWithNoRegions()
    {
        $records = CustomerModel::select('*',)
                ->join('users', 'customer.user_id', '=', 'users.id')
                ->where('region', '-')
                ->get();
        return $records;
    }

    // TO GET CUSTOMER LATEST BILL AMOUNT PAID
    static function ToGetCustomerLatestBillAmountPaid()
    {
        $records = CustomerModel::select('*')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->join('customer_bill', 'customer.customer_id', '=', 'customer_bill.customer_id')
            ->where('customer_bill.bill_status', 1)
            ->join(DB::raw('(SELECT customer_id, MAX(customer_bill_id) AS latest_bill_id FROM customer_bill WHERE bill_status = 1 GROUP BY customer_id) AS latest'), function ($join) {
                $join->on('customer_bill.customer_id', '=', 'latest.customer_id')
                    ->on('customer_bill.customer_bill_id', '=', 'latest.latest_bill_id');
            })
            ->paginate(15);

        return $records;
    }

    // TO GET CUSTOMER LATEST BILL AMOUNT NOT PAID
    static function ToGetCustomerLatestBillAmountNotPaid()
    {
        $records = CustomerModel::select('*',)
                    ->join('users', 'customer.user_id', '=', 'users.id')
                    ->join('customer_bill', 'customer.customer_id', '=', 'customer_bill.customer_id')
                    ->where('customer_bill.bill_status', 2)
                    ->join(DB::raw('(SELECT customer_id, MAX(customer_bill_id) AS latest_bill_id FROM customer_bill GROUP BY customer_id) AS latest'), function ($join) {
                        $join->on('customer_bill.customer_id', '=', 'latest.customer_id')
                            ->on('customer_bill.customer_bill_id', '=', 'latest.latest_bill_id');
                            /* ->where('customer_bill.bill_status', 2); */
                    })
                    ->paginate(15);
        /* if ($records->isEmpty()) {
            return 'There is no pending bills of Customer !';
        } */
        return $records;
    }

    // TO GET CUSTOMER LATEST BILL AMOUNT BASED ON CUSTOMER ID
    static function ToGetCustomerLatestBillAmount($customer_id)
    {
        $records = CustomerModel::select('*',)
                    ->join('users', 'customer.user_id', '=', 'users.id')
                    ->join('customer_bill', 'customer.customer_id', '=', 'customer_bill.customer_id')
                    ->where('customer_bill.bill_status', 2)
                    ->where('customer.customer_id', $customer_id)
                    ->join(DB::raw('(SELECT customer_id, MAX(customer_bill_id) AS latest_bill_id FROM customer_bill GROUP BY customer_id) AS latest'), function ($join) {
                        $join->on('customer_bill.customer_id', '=', 'latest.customer_id')
                            ->on('customer_bill.customer_bill_id', '=', 'latest.latest_bill_id');
                            /* ->where('customer_bill.bill_status', 2); */
                    })
                    ->first();
        /* if ($records->isEmpty()) {
            return 'There is no pending bills of Customer !';
        } */
        return $records;
    }

    // TO GET CUSTOMER VOID BILLS
    static function ToGetCustomerVoidBill()
    {
        $records = CustomerModel::select('*',)
                    ->join('users', 'customer.user_id', '=', 'users.id')
                    ->join('customer_bill', 'customer.customer_id', '=', 'customer_bill.customer_id')
                    ->where('customer_bill.bill_status', 3)
                    ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no void bills of Customer !';
        }
        return $records;
    }

    // TO GET CUSTOMER DETAILS [SEARCHING]
    static function ToGetCustomerDetailsAndLatestBillAmounts($searchQuery)
    {
        // CONCAT
        $query = CustomerModel::select('*', DB::raw("CONCAT(users.fname, ' ', users.lname) AS full_name"))
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->join('customer_bill', 'customer.customer_id', '=', 'customer_bill.customer_id')
            ->join(DB::raw('(SELECT customer_id, MAX(customer_bill_id) AS latest_bill_id FROM customer_bill GROUP BY customer_id) AS latest'), function ($join) {
                $join->on('customer_bill.customer_id', '=', 'latest.customer_id')
                    ->on('customer_bill.customer_bill_id', '=', 'latest.latest_bill_id');
            });

        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where(DB::raw("CONCAT(users.fname, ' ', users.lname)"), 'LIKE', '%' . $searchQuery . '%');
            });
        }

        $records = $query->paginate(15);

        if ($records->isEmpty()) {
            return 'There are no matching records!';
        }

        return $records;
    }

    // TO GET CUSTOMER PAYMENT HISTORY
    static function ToViewIndividualCustomerPaymentHistory($id)
    {
        $records = CustomerModel::select('*',)
                ->join('users', 'customer.user_id', '=', 'users.id')
                ->join('customer_bill', 'customer.customer_id', '=', 'customer_bill.customer_id')
                ->where('users.id', $id)
                ->where('customer_bill.bill_status', 1)
                ->orderBy('customer_bill.inovice_number', 'desc')
                ->paginate(15);
        return $records;
    }

    // TO GET CUSTOMER BANK DETAILS
    static function ToViewCustomersWithBankDetails()
    {
        $records = CustomerModel::select('*')
                ->join('payment', 'customer.customer_id', '=', 'payment.customer_id')
                ->join('users', 'customer.user_id', '=', 'users.id')
                ->paginate(15);
        return $records;
    }

    // TO GET CUSTOMER ALL REGION
    static function ToViewCustomersRegion()
    {
        $records = CustomerModel::select('*')
                ->join('users', 'customer.user_id', '=', 'users.id')
                ->paginate(15);
        return $records;
    }

    // TO GET CUSTOMER NORTH REGION
    static function ToViewCustomerNorthRegion()
    {
        $records = CustomerModel::select('*')
                ->join('users', 'customer.user_id', '=', 'users.id')
                ->where('customer.region', 'North')
                ->paginate(15);
        return $records;
    }

    // TO GET CUSTOMER SOUTH REGION
    static function ToViewCustomerSouthRegion()
    {
        $records = CustomerModel::select('*')
                ->join('users', 'customer.user_id', '=', 'users.id')
                ->where('customer.region', 'South')
                ->paginate(15);
        return $records;
    }

    // TO GET CUSTOMER EAST REGION
    static function ToViewCustomerEastRegion()
    {
        $records = CustomerModel::select('*')
                ->join('users', 'customer.user_id', '=', 'users.id')
                ->where('customer.region', 'East')
                ->paginate(15);
        return $records;
    }

    // TO GET CUSTOMER WEST REGION
    static function ToViewCustomerWestRegion()
    {
        $records = CustomerModel::select('*')
                /* ->join('payment', 'customer.customer_id', '=', 'payment.customer_id') */
                ->join('users', 'customer.user_id', '=', 'users.id')
                ->where('customer.region', 'West')
                ->paginate(15);
        return $records;
    }

    /* static function ToGetAverageBasedOnRegions()
    {
        $records = CustomerModel::select('region', DB::raw('AVG(meter_value) AS average_meter_value'))
            ->join('pipe', 'customer.customer_id', '=', 'pipe.customer_id')
            ->groupBy('region')
            ->get();

        return $records;
    } */
}
