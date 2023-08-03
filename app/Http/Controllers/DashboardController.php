<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\AddressModel; // AddressModel
use App\Models\ChemicalModel; // ChemicalModel
use App\Models\CommentModel;  // CommentModel
use App\Models\CompanyModel; // CompanyModel
use App\Models\CustomerBillModel; // CustomerBillModel
use App\Models\CustomerModel; // CustomerModel
use App\Models\EmployeeModel; // EmployeeModel
use App\Models\EquipmentModel; // EquipmentModel
use App\Models\FeedbackModel; // FeedbackModel
use App\Models\JobModel; // JobModel
use App\Models\JobReportModel; // JobReportModel
use App\Models\NotificationModel; // NotificationModel
use App\Models\PaymentModel; // PaymentModel
use App\Models\PipeModel; // PipeModel
use App\Models\PlatformAdminModel; // PlatformAdminModel
use App\Models\ProductModel; // ProductModel
use App\Models\ReplyFeedbackModel;  // ReplyFeedbackModel
use App\Models\RoleModel; // RoleModel
use App\Models\SellerModel;// SellerModel
use App\Models\ServiceModel; // ServiceModel
use App\Models\SystemAdminModel; // SystemAdminModel
use App\Models\User; // User
use App\Models\WaterSupplyEquipmentModel;// WaterSupplyEquipmentModel
use App\Models\WaterUsageModel;// WaterUsageModel

class DashboardController extends Controller
{
    public function dashboard()
    {
        //  User Type:  1, Platform Admin, 2: Seller, 3: Customers,  4: System Admin , 5: HR & Customer Service, 6: Supervisor, 7: Technicians, 8: Others,

        // Platform Admin
        if (Auth::user()->user_type == 1)
        {
            return view('platformadmin.dashboard');
        }

        // Seller
        else if (Auth::user()->user_type == 2)
        {
            return view('seller.dashboard');
        }

        // System Admin
        else if (Auth::user()->user_type == 4)
        {
            // IN THE EVENT CUSTOMER NO REGIONS
            $customerWithNoRegions = CustomerModel::ToGetCustomerWithNoRegions();
            $a = array("North", "South", "East", "West");
            foreach ($customerWithNoRegions as $customer)
            {
                if ($customer->region === '-')
                {
                    $random_keys = array_rand($a, 1);
                    $update_regions = $a[$random_keys]; // Randomly select a new region
                    $customer->region = $update_regions;
                    $customer->save();
                }
            }
            return view('systemadmin.dashboard');
        }

        // HR & Customer Service
        if (Auth::user()->user_type == 5)
        {
            // IN THE EVENT CUSTOMER NO REGIONS
            $customerWithNoRegions = CustomerModel::ToGetCustomerWithNoRegions();
            $a = array("North", "South", "East", "West");
            foreach ($customerWithNoRegions as $customer)
            {
                if ($customer->region === '-')
                {
                    $random_keys = array_rand($a, 1);
                    $update_regions = $a[$random_keys]; // Randomly select a new region
                    $customer->region = $update_regions;
                    $customer->save();
                }
            }
            return view('hr_customer_service.dashboard');
        }

        // Supervisor
        else if (Auth::user()->user_type == 6)
        {
            // IN THE EVENT CUSTOMER NO REGIONS
            $customerWithNoRegions = CustomerModel::ToGetCustomerWithNoRegions();
            $a = array("North", "South", "East", "West");
            foreach ($customerWithNoRegions as $customer)
            {
                if ($customer->region === '-')
                {
                    $random_keys = array_rand($a, 1);
                    $update_regions = $a[$random_keys]; // Randomly select a new region
                    $customer->region = $update_regions;
                    $customer->save();
                }
            }
            return view('supervisor.dashboard');
        }

        //Technician
        else if (Auth::user()->user_type == 7)
        {
            // IN THE EVENT CUSTOMER NO REGIONS
            $customerWithNoRegions = CustomerModel::ToGetCustomerWithNoRegions();
            $a = array("North", "South", "East", "West");
            foreach ($customerWithNoRegions as $customer)
            {
                if ($customer->region === '-')
                {
                    $random_keys = array_rand($a, 1);
                    $update_regions = $a[$random_keys]; // Randomly select a new region
                    $customer->region = $update_regions;
                    $customer->save();
                }
            }
            return view('technician.dashboard');
        }

        // Others
        else if (Auth::user()->user_type == 8)
        {
            return view('commingsoon');
        }
    }
}
