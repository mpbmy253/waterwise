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

class HomeMarketingWebsiteController extends Controller
{
    public function GoToHomePage()
    {
        return view('index');
    }

    public function GoToAboutUsPage()
    {
        return view('marketing_website.AboutUs');
    }

    public function GoToContactUsPage()
    {
        return view('marketing_website.ContactUs');
    }

    public function GoToWebPackagePage()
    {
        return view('marketing_website.WebPackage');
    }

    public function GoToFullPackagePage()
    {
        return view('marketing_website.FullPackage');
    }

    public function GoToRegistrationPage()
    {
        return view('marketing_website.Registration');
    }
}
