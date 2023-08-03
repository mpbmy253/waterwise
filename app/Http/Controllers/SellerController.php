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

class SellerController extends Controller
{
    public function btnAddNewProduct()
    {
        return view('seller.product.add_new_product');
    }

    public function btnEditProduct($product_id)
    {
        $data['singleProductDetails'] = ProductModel::ToProductsDetails($product_id);
        $data['sellerID'] = Auth::user()->id;
        if(!empty($data['singleProductDetails']))
        {
            return view('seller.product.edit_product', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function btnViewAllProduct()
    {
        // To Pluck SellerID
        $sellerInfo = User::ToGetSellerID($id = Auth::user()->id);
        $seller_collection = collect($sellerInfo);
        $seller_id = $seller_collection->pluck('seller_id')->first();

        $data['ToViewAllActiveProducts'] = ProductModel::ToViewAllActiveProducts($seller_id);
        $data['sellerID'] = Auth::user()->id;
        if ($data['ToViewAllActiveProducts']->isEmpty())
        {
            $data['noProducts'] = true;
        }
        else
        {
            $data['noProducts'] = false;
        }
        return view('seller.product.view_all_products', $data);
    }

    public function btnViewIndivialProduct($product_id)
    {
        $data['singleProductDetails'] = ProductModel::ToProductsDetails($product_id);
        $data['sellerID'] = Auth::user()->id;
        return view('seller.product.view_individual_product', $data);
    }

    public function btnViewDeleteProduct()
    {
        // To Pluck SellerID
        $sellerInfo = User::ToGetSellerID($id = Auth::user()->id);
        $seller_collection = collect($sellerInfo);
        $seller_id = $seller_collection->pluck('seller_id')->first();

        $data['ToViewAllDeleteProducts'] = ProductModel::ToViewDeleteProducts($seller_id);
        return view('seller.product.view_deleted_products', $data);
    }

    public function deleteProduct($product_id)
    {
        $product = ProductModel::ToSingleProduct($product_id);
        $product->product_status = 2; // Status: 1: Available, 2: Deleted
        $product->save();
        return redirect('seller/product/view_all_products')->with('success', "Product Successfully Delete !");
    }

    public function autoSearchProducts(Request $request)
    {

        $sellerInfo = User::ToGetSellerID($id = Auth::user()->id);
        $seller_collection = collect($sellerInfo);
        $seller_id = $seller_collection->pluck('seller_id')->first();

        $data = ProductModel::select('*',)
                ->where('seller_id', $seller_id)
                ->where('product_status', 1)
                ->where('product_name', 'LIKE', '%' .  $request->search. '%')
                ->get();
        // Return the data as a JSON response
        return response()->json($data);
    }

    public function addNewProduct(Request $request)
    {
        /* dd($request->all()); */
        request()->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'filenames' => 'required|image',
        ]);

        if($request->hasFile('filenames'))
        {
            $file = $request->file('filenames');
            $sellerID = Auth::user()->id;
            $name = $sellerID.'_'.$file->getClientOriginalName();
            $file->move(public_path('files/'), $name);
        }
        $user = Auth::user();
        if ($user)
        {
            $id = $user->id;
            $sellerInfo = User::ToGetSellerID($id);
            $seller_collection = collect($sellerInfo);
            $seller_id = $seller_collection->pluck('seller_id')->first();

            // $sellerID = Auth::user()->id;
            $new_product = new ProductModel;
            $new_product->seller_id = $seller_id;
            $new_product->product_name = trim($request->product_name);
            $new_product->product_description = trim($request->product_description);
            $new_product->product_price = trim($request->product_price);
            $new_product->product_status = 1; // Status: 1: Available, 2: Deleted
            $new_product->filenames = $name;
            $new_product->save();

            return redirect('seller/product/view_all_products')->with('success', "New Product Successfully Added !");
        }
    }

    public function editProduct(Request $request, $product_id)
    {
        /* dd($request->all()); */
        request()->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
        ]);
        $update_product = ProductModel::ToSingleProduct($product_id);
        $update_product->product_name = trim($request->product_name);
        $update_product->product_description = trim($request->product_description);
        $update_product->product_price = trim($request->product_price);
        $update_product->product_status = 1; // Status: 1: Available, 2: Deleted
        $update_product->save();

        return redirect('seller/product/view_all_products')->with('success', "Product Successfully Update !");
    }
}
