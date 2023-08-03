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


class EmployeeController extends Controller
{
    // HR & CUSTOMER SERVICE
    // CUSTOMER BILLING
    public function btnViewAllCustomerBillings()
    {
        $data['customerPendingBills'] = CustomerModel::ToGetCustomerLatestBillAmountNotPaid();
        if ($data['customerPendingBills']->isEmpty())
        {
            $data['noCustomerPendingBills'] = true;
        }
        else
        {
            $data['noCustomerPendingBills'] = false;
        }
        return view('hr_customer_service.customerbilling.view_all_customer_pending_bills', $data);
    }

    public function btnToSendBillAlert($customer_id)
    {
        $customerLatestBillAmount = CustomerModel::ToGetCustomerLatestBillAmount($customer_id);
        // Access the amount value
        $amount = $customerLatestBillAmount->amount;

        $notification = new NotificationModel;
        $notification->notification_name = "Bill Due";
        $notification->message = "You have an Outstanding Bill of $" .$amount;
        $notification->customer_id = $customer_id;
        $notification->status = 0;
        $notification->url = "/billing_screen";
        $notification->save();

        return redirect('hr_customer_service/customerbilling/view_all_customer_pending_bills')->with('success', "Customer has been notified !");
    }

    public function autoSearchCustomerPendingBill(Request $request)
    {
        $searchTerm = '%' . $request->search . '%';

        $data = CustomerModel::select('*', DB::raw("CONCAT(users.fname, ' ', users.lname) AS full_name"))
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->join('customer_bill', 'customer.customer_id', '=', 'customer_bill.customer_id')
            ->join(DB::raw('(SELECT customer_id, MAX(customer_bill_id) AS latest_bill_id FROM customer_bill GROUP BY customer_id) AS latest'), function ($join) use ($searchTerm) {
                $join->on('customer_bill.customer_id', '=', 'latest.customer_id')
                    ->on('customer_bill.customer_bill_id', '=', 'latest.latest_bill_id')
                    ->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm])
                    ->where('customer_bill.bill_status', 2);
            })
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    public function btnViewVoidBills()
    {
        $data['customerVoidBill'] = CustomerModel::ToGetCustomerVoidBill();
        return view('hr_customer_service.customerbilling.view_void_bills', $data);
    }

    public function voidBills($customer_bill_id)
    {
        $bill = CustomerBillModel::ToSingleCustomerBill($customer_bill_id);
        $bill->bill_status = 3; // Status: 1: Paid, 2: Not Paid, 3: Void
        $bill->save();

        return redirect('hr_customer_service/customerbilling/view_all_customer_pending_bills')->with('success', "Customer Bill Successfully Void !");
    }

    // CUSTOMER PAYMENT
    public function btnViewAllCustomerPayment()
    {
        $data['customerPaidBills'] = CustomerModel::ToGetCustomerLatestBillAmountPaid();
        if ($data['customerPaidBills']->isEmpty())
        {
            $data['noCustomerPaidBills'] = true;
        }
        else
        {
            $data['noCustomerPaidBills'] = false;
        }
        return view('hr_customer_service.customerpayment.view_all_customer_payment', $data);
    }

    public function btnViewIndividualCustomerPayment($id)
    {
        $customer = User::ToGetSingleUserDetails($id);
        $data['customer'] = $customer;
        $data['ToViewIndividualCustomerPaymentHistory'] = CustomerModel::ToViewIndividualCustomerPaymentHistory($id);
        return view('hr_customer_service.customerpayment.view_payment_history', $data);
    }

    public function autoSearchCustomerPaidBill(Request $request)
    {
        $searchTerm = '%' . $request->search . '%';

        $data = CustomerModel::select('*', DB::raw("CONCAT(users.fname, ' ', users.lname) AS full_name"))
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->join('customer_bill', 'customer.customer_id', '=', 'customer_bill.customer_id')
            ->join(DB::raw('(SELECT customer_id, MAX(customer_bill_id) AS latest_bill_id FROM customer_bill GROUP BY customer_id) AS latest'), function ($join) use ($searchTerm) {
                $join->on('customer_bill.customer_id', '=', 'latest.customer_id')
                    ->on('customer_bill.customer_bill_id', '=', 'latest.latest_bill_id');
            })
            ->where(DB::raw("CONCAT(users.fname, ' ', users.lname)"), 'LIKE', $searchTerm)
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    // CUSTOMER INTEACTION
    public function btnViewFeedbacks()
    {
        $data['ToGetAllFeedbacks'] = FeedbackModel::ToGetAllFeedbacks();
        if ($data['ToGetAllFeedbacks']->isEmpty())
        {
            $data['noFeedbacks'] = true;
        }
        else
        {
            $data['noFeedbacks'] = false;
        }
        return view('hr_customer_service.customerinteraction.view_feedback', $data);
    }

    public function btnViewIndividialFeedback($feedback_id)
    {
        $data['individualFeedback'] = FeedbackModel::ToGetIndividualFeedback($feedback_id);
        if(!empty($data['individualFeedback']))
        {
            return view('hr_customer_service.customerinteraction.view_individual_feedback', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function btnDeleteFeedback($feedback_id)
    {
        $feedback = FeedbackModel::ToGetIndividualFeedback($feedback_id);
        $feedback->feedback_status = 2; //  1: Feedback, 2: Remove/Delete
        $feedback->save();

        return redirect('hr_customer_service/customerinteraction/view_feedback')->with('success', "Feedback Successfully Delete !");
    }

    public function replyFeedback()
    {
        return redirect('hr_customer_service/customerinteraction/view_feedback')->with('success', "Reply Feedback Successfully Sent to Customer Email !");
    }

    public function btnViewServiceRequest()
    {
        $data['ToGetAllServiceRequest'] = ServiceModel::ToGetAllServiceRequest();
        if ($data['ToGetAllServiceRequest']->isEmpty())
        {
            $data['noServiceRequest'] = true;
        }
        else
        {
            $data['noServiceRequest'] = false;
        }
        return view('hr_customer_service.customerinteraction.view_service_request', $data);
    }

    public function btnViewIndividialServiceRequest($service_id)
    {
        $data['individualServiceRequest'] = ServiceModel::ToGetIndividualServiceRequest($service_id);
        if(!empty($data['individualServiceRequest']))
        {
            return view('hr_customer_service.customerinteraction.view_individual_service_request', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function btnSendTechnicianOverToService($service_id)
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $ToGetActiveTechnician = EmployeeModel::ToGetActiveTechnician($company_ID);
        $TotalNumTechnician = count(collect($ToGetActiveTechnician));

        // Check if there are available technicians
        if($ToGetActiveTechnician === 0)
        {
            return redirect('hr_customer_service/customerinteraction/view_service_request')->with('error', "There is no Technician Available at the moment !");
        }
        else
        {
            $randomIndex = random_int(0, $TotalNumTechnician - 1);
            $availableTechnician = $ToGetActiveTechnician[$randomIndex];

            $employee_ID = $availableTechnician->employee_id; // employee_id

            $service_date_request = ServiceModel::ToGetDateFromServiceRequest($service_id);
            $service_collection = collect($service_date_request);
            $service_date = $service_collection->pluck('service_date')->first();

            $customerID = ServiceModel::ToSingleService($service_id);
            $customer_collection = collect($customerID);
            $customer_id = $service_collection->pluck('customer_id')->first(); // customer_id
            $service_description = $service_collection->pluck('service_description')->first(); // service_description

            $service_time = date('H', strtotime($service_date));

            // Add 2 days excluding weekends
            $daysToAdd = 1;
            $addedDays = 0;
            while ($addedDays < $daysToAdd) {
                $service_date = date('Y-m-d', strtotime($service_date . ' +1 day'));
                $dayOfWeek = date('N', strtotime($service_date));
                if ($dayOfWeek < 6) { // 6 represents Saturday, 7 represents Sunday
                    $addedDays++;
                }
            }

            $dateTime = new \DateTime($service_date . ' ' . $service_time . ':00:00');

            // Adjust the time if it exceeds 18:00
            if ($dateTime->format('H') >= 18)
            {
                $dateTime->modify('+2 day');
                $dateTime->setTime(8, 0); // Set time to 08:00
            }
            else
            {
                $dateTime->modify('+1 day');
                $dateTime->setTime(8, 0); // Set time to 08:00
            }

            $availableDate = $service_date; // job_date
            $availableTime = $dateTime->format('H:i'); // job_start_time

            $jobSynopsis = '';
            // if ($service_description === "pipe leak")
            if (strpos($service_description, "leak") !== false)
            {
                $a = array(
                    "To fix pipe leaks due to high water pressure.",
                    "To fix pipe leaks due to pipe materials which have manufacturing defects.",
                    "To fix pipe leaks due to pipe age, requiring a new pipe system.",
                    "To fix pipe leaks due to certain chemicals present in the water pipe.",
                    "To fix pipe leaks due to physical damage, requiring a new pipe system.",
                    "To fix pipe leaks due to faulty pipe joints, requiring a new pipe system.",
                    "To fix pipe leaks due to wastage of a significant amount of water over time.",
                    "To fix pipe leaks due to higher water bills due to the constant water flow.",
                    "To fix pipe leaks due to weaken the foundation, erode soil, and compromise the stability of walls and floors.",
                    "To fix pipe leaks due to pipe bursts or joint failures.",

                );
                $random_keys = array_rand($a, 2);
                $jobSynopsis = $a[$random_keys[0]]; // job_description
            }
            else if (strpos($service_description, "maintenance") !== false)
            {
                $a = array(
                    "To regular maintenance allows us to identify and repair small leaks before they escalate into larger, more costly problems",
                    "To prevent further damage and ensure the longevity of customer plumbing system",
                    "To reduce the likelihood of sudden breakdowns, which can cause inconvenience and potentially require emergency repairs",
                    "To improve water flow and ensure cleaner, fresher water for consumption and everyday use.",
                    "To ensure efficient drainage, reducing the risk of backups and wastewater overflow.",
                    "To reduces the likelihood of unexpected issues, allowing customer to have confidence in the reliability and safety of water supply.",
                );
                $random_keys = array_rand($a, 2);
                $jobSynopsis = $a[$random_keys[0]]; // job_description
            }

            $new_job_assigned = new JobModel;
            $new_job_assigned->employee_id = $employee_ID;
            $new_job_assigned->customer_id = $customer_id;
            $new_job_assigned->job_date = $availableDate;
            $new_job_assigned->job_start_time = $availableTime;
            $new_job_assigned->job_end_time =  "";
            $new_job_assigned->job_description = $jobSynopsis;
            $new_job_assigned->job_status = 0; // Status: 0: Not Completed, 1: Completed, 2: Require Extra Help, 3: Delete, 4: Incompleted
            $new_job_assigned->save();

            $notification = new NotificationModel;
            $notification->notification_name = "Technician is comming.";
            $notification->message = "Please be patient, we are sending our Technician over soon on ". $availableDate. " at " . $availableTime ;
            $notification->customer_id = $customer_id;
            $notification->status = 0;
            $notification->url = "";
            $notification->save();

            $service_status = ServiceModel::ToSingleService($service_id);
            $service_status->service_status = 1; // Status: 0: Pending, 2: Sending
            $service_status->save();

            return redirect('hr_customer_service/customerinteraction/view_service_request')->with('success', "Technician has been sent over !");
        }
    }

    // SUPERVISOR
    // EQUIPMENT
    public function btnAddNewEquipment()
    {
        return view('supervisor.equipment.add_new_equipment');
    }

    public function autoSearchEquipments(Request $request)
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data = EquipmentModel::select('*',)
                ->where('equipment_status', 1)
                ->where('company_id', $company_ID)
                ->where('equipment_name', 'LIKE', '%' .  $request->search. '%')
                ->get();
        // Return the data as a JSON response
        return response()->json($data);
    }

    public function btnViewAllEquipment()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['viewActiveEquipment'] = EquipmentModel::ToGetAllActiveEquipment($company_ID);
        return view('supervisor.equipment.view_all_equipment', $data);
    }

    public function btnViewIndividialEquipment($equipment_id)
    {
        $data['singleEquipment'] = EquipmentModel::ToSingleEquipment($equipment_id);
        return view('supervisor.equipment.view_individual_equipment', $data);
    }

    public function btnEditEquipment($equipment_id)
    {
        $data['singleEquipment'] = EquipmentModel::ToSingleEquipment($equipment_id);
        if(!empty($data['singleEquipment']))
        {
            return view('supervisor.equipment.edit_equipment', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function btnViewDeletedEquipment()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['viewDeleteEquipment'] = EquipmentModel::ToGetAllDeleteEquipment($company_ID);
        return view('supervisor.equipment.view_deleted_equipment', $data);
    }

    public function btnViewSuspendEquipment()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['viewSuspendEquipment'] = EquipmentModel::ToGetAllSuspendEquipment($company_ID);
        return view('supervisor.equipment.view_suspend_equipment', $data);
    }

    public function deleteEquipment($equipment_id)
    {
        $equipment = EquipmentModel::ToSingleEquipment($equipment_id);
        $equipment->equipment_status = 2; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $equipment->save();

        return redirect('supervisor/equipment/view_all_equipment')->with('success', "Equipment Successfully Delete !");
    }

    public function suspendEquipment($equipment_id)
    {
        $equipment = EquipmentModel::ToSingleEquipment($equipment_id);
        $equipment->equipment_status = 3; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $equipment->save();

        return redirect('supervisor/equipment/view_all_equipment')->with('success', "Equipment Successfully Suspend !");
    }

    public function restoreEquipment($equipment_id)
    {
        $equipment = EquipmentModel::ToSingleEquipment($equipment_id);
        $equipment->equipment_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $equipment->save();

        return redirect('supervisor/equipment/view_all_equipment')->with('success', "Equipment Successfully Restore !");
    }

    public function activateEquipment($equipment_id)
    {
        $equipment = EquipmentModel::ToSingleEquipment($equipment_id);
        $equipment->equipment_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $equipment->save();

        return redirect('supervisor/equipment/view_all_equipment')->with('success', "Equipment Successfully Activate !");
    }

    public function addNewEquipment(Request $request)
    {
        /* dd($request->all()); */
        $userDetails = User::ToGetCompanyIDFromEmployee(auth()->id());
        $collection = collect($userDetails);
        $company_id = $collection->pluck('company_id')->first();

        $rules = [
            'equipment_name' => [
                'required',
                Rule::unique('equipment')
                    ->where(function ($query) use ($company_id) {
                        $query->where('company_id', $company_id);
                    })
            ],
            'equipment_qty' => 'required',
            'equipment_price' => 'required',
            'date' => 'required',
            'guarantee_period' => 'required',
            'replacement_period' => 'required',
            'flow_rate' => 'required',
            'power_consumption' => 'required',
            'pressure_capacity' => 'required',
            'voltage_requirements' => 'required',
        ];

        // Custom error messages
        $messages = [
            'equipment_name.unique' => 'The Equipment already exists in the company !',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = auth()->id();
        if ($id)
        {
            $userDetails = User::ToGetCompanyIDFromEmployee($id);
            $collection = collect($userDetails);
            $company_ID = $collection->pluck('company_id')->first();

            $new_equipment = new EquipmentModel;
            $new_equipment->equipment_name = trim($request->equipment_name);
            $new_equipment->equipment_qty = trim($request->equipment_qty);
            $new_equipment->equipment_price = trim($request->equipment_price);
            $new_equipment->installation_date = date('Y-m-d', strtotime(trim($request->date))); // SQL STORE DATE format: Y-m-d
            $new_equipment->guarantee_period = trim($request->guarantee_period);
            $new_equipment->replacement_period = trim($request->replacement_period);
            $new_equipment->flow_rate = trim($request->flow_rate);
            $new_equipment->power_consumption = trim($request->power_consumption);
            $new_equipment->pressure_capacity = trim($request->pressure_capacity);
            $new_equipment->voltage_requirements = trim($request->voltage_requirements);
            $new_equipment->equipment_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
            $new_equipment->company_id = $company_ID;

            $new_equipment->save();

            return redirect('supervisor/equipment/view_all_equipment')->with('success', "New Equipment Successfully Added !");
        }
        return redirect()->back()->with('error', 'Equipment not found.');
    }

    public function editEquipment($equipment_id, Request $request)
    {
        /* dd($request->all()); */
        $userDetails = User::ToGetCompanyIDFromEmployee(auth()->id());
        $collection = collect($userDetails);
        $company_id = $collection->pluck('company_id')->first();

        $rules = [
            'equipment_name' => [
                'required',
                Rule::unique('equipment')
                    ->where(function ($query) use ($company_id) {
                        $query->where('company_id', $company_id);
                    })
            ],
            'equipment_qty' => 'required',
            'equipment_price' => 'required',
            'guarantee_period' => 'required',
            'replacement_period' => 'required',
            'flow_rate' => 'required',
            'power_consumption' => 'required',
            'pressure_capacity' => 'required',
            'voltage_requirements' => 'required',
        ];

        // Custom error messages
        $messages = [
            'equipment_name.unique' => 'The Equipment already exists in the company !',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = auth()->id();
        if ($id)
        {
            $userDetails = User::ToGetCompanyIDFromEmployee($id);
            $collection = collect($userDetails);
            $company_ID = $collection->pluck('company_id')->first();

            $updateEquipment = EquipmentModel::ToSingleEquipment($equipment_id);
            $updateEquipment->equipment_name = trim($request->equipment_name);
            $updateEquipment->equipment_qty = trim($request->equipment_qty);
            $updateEquipment->equipment_price = trim($request->equipment_price);
            $updateEquipment->guarantee_period = trim($request->guarantee_period);
            $updateEquipment->replacement_period = trim($request->replacement_period);
            $updateEquipment->flow_rate = trim($request->flow_rate);
            $updateEquipment->power_consumption = trim($request->power_consumption);
            $updateEquipment->pressure_capacity = trim($request->pressure_capacity);
            $updateEquipment->voltage_requirements = trim($request->voltage_requirements);
            $updateEquipment->equipment_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
            $updateEquipment->company_id = $company_ID;
            $updateEquipment->save();

            return redirect('supervisor/equipment/view_all_equipment')->with('success', "Equipment Successfully Update !");
        }
        return redirect()->back()->with('error', 'Equipment not found.');
    }

    // CHECMICAL
    public function btnAddNewChemical()
    {
        return view('supervisor.chemical.add_new_chemical');
    }

    public function autoSearchChemicals(Request $request)
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data = ChemicalModel::select('*',)
                ->where('chemical_status', 1)
                ->where('company_id', $company_ID)
                ->where('chemical_name', 'LIKE', '%' .  $request->search. '%')
                ->get();
        // Return the data as a JSON response
        return response()->json($data);
    }

    public function btnViewAllChemical()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['viewActiveChemical'] = ChemicalModel::ToGetAllActiveChemical($company_ID);
        if ($data['viewActiveChemical']->isEmpty())
        {
            $data['noActiveChemical'] = true;
        }
        else
        {
            $data['noActiveChemical'] = false;
        }

        return view('supervisor.chemical.view_all_chemical', $data);
    }

    public function btnViewIndividialChemical($chemical_id)
    {
        $data['singleChemical'] = ChemicalModel::ToSingleChemical($chemical_id);
        return view('supervisor.chemical.view_individual_chemical', $data);
    }

    public function btnEditChemical($chemical_id)
    {
        $data['singleChemical'] = ChemicalModel::ToSingleChemical($chemical_id);
        if(!empty($data['singleChemical']))
        {
            return view('supervisor.chemical.edit_chemical', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function btnViewDeletedChemical()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['viewDeleteChemical'] = ChemicalModel::ToGetAllDeleteChemical($company_ID);

        return view('supervisor.chemical.view_deleted_chemical', $data);
    }

    public function btnViewSuspendChemical()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['viewSuspendChemical'] = ChemicalModel::ToGetAllSuspendChemical($company_ID);

        return view('supervisor.chemical.view_suspend_chemical', $data);
    }

    public function deleteChemical($chemical_id)
    {
        $chemical = ChemicalModel::ToSingleChemical($chemical_id);
        $chemical->chemical_status = 2; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $chemical->save();

        return redirect('supervisor/chemical/view_all_chemical')->with('success', "Chemical Successfully Delete !");
    }

    public function suspendChemical($chemical_id)
    {
        $chemical = ChemicalModel::ToSingleChemical($chemical_id);
        $chemical->chemical_status = 3; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $chemical->save();

        return redirect('supervisor/chemical/view_all_chemical')->with('success', "Chemical Successfully Suspend !");
    }

    public function restoreChemical($chemical_id)
    {
        $chemical = ChemicalModel::ToSingleChemical($chemical_id);
        $chemical->chemical_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $chemical->save();

        return redirect('supervisor/chemical/view_all_chemical')->with('success', "Chemical Successfully Restore !");
    }

    public function activateChemical($chemical_id)
    {
        $chemical = ChemicalModel::ToSingleChemical($chemical_id);
        $chemical->chemical_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $chemical->save();

        return redirect('supervisor/chemical/view_all_chemical')->with('success', "Chemical Successfully Activate !");
    }

    public function addNewChemical(Request $request)
    {
        /* dd($request->all()); */
        $userDetails = User::ToGetCompanyIDFromEmployee(auth()->id());
        $collection = collect($userDetails);
        $company_id = $collection->pluck('company_id')->first();

        $rules = [
            'chemical_name' => [
                'required',
                Rule::unique('chemical')
                    ->where(function ($query) use ($company_id) {
                        $query->where('company_id', $company_id);
                    })
            ],
            'chemical_qty' => 'required',
            'chemical_price' => 'required',
            'using_time' => 'required',
            'chemical_level' => 'required',
        ];

        // Custom error messages
        $messages = [
            'chemical_name.unique' => 'The Chemical already exists in the company !',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = auth()->id();
        if($id)
        {
            $userDetails = User::ToGetCompanyIDFromEmployee($id);
            $collection = collect($userDetails);
            $company_ID = $collection->pluck('company_id')->first();

            $new_chemical = new ChemicalModel;
            $new_chemical->chemical_name = trim($request->chemical_name);
            $new_chemical->chemical_qty = trim($request->chemical_qty);
            $new_chemical->chemical_price = trim($request->chemical_price);
            $new_chemical->using_time = trim($request->using_time);
            $new_chemical->chemical_level = trim($request->chemical_level);
            $new_chemical->chemical_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
            $new_chemical->company_id = $company_ID;
            $new_chemical->save();

            return redirect('supervisor/chemical/view_all_chemical')->with('success', "New Chemical Successfully Added !");
        }
        return redirect()->back()->with('error', 'Chemical not found.');
    }

    public function editChemical($chemical_id, Request $request)
    {
        /* dd($request->all()); */
        $userDetails = User::ToGetCompanyIDFromEmployee(auth()->id());
        $collection = collect($userDetails);
        $company_id = $collection->pluck('company_id')->first();

        $rules = [
            'chemical_name' => [
                'required',
                Rule::unique('chemical')
                    ->where(function ($query) use ($company_id) {
                        $query->where('company_id', $company_id);
                    })
            ],
            'chemical_qty' => 'required',
            'chemical_price' => 'required',
            'using_time' => 'required',
            'chemical_level' => 'required',
        ];

        // Custom error messages
        $messages = [
            'chemical_name.unique' => 'The Chemical already exists in the company !',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = auth()->id();
        if($id)
        {
            $userDetails = User::ToGetCompanyIDFromEmployee($id);
            $collection = collect($userDetails);
            $company_ID = $collection->pluck('company_id')->first();

            $update_chemical = ChemicalModel::ToSingleChemical($chemical_id);
            $update_chemical->chemical_name = trim($request->chemical_name);
            $update_chemical->chemical_qty = trim($request->chemical_qty);
            $update_chemical->chemical_price = trim($request->chemical_price);
            $update_chemical->using_time = trim($request->using_time);
            $update_chemical->chemical_level = trim($request->chemical_level);
            $update_chemical->chemical_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
            $update_chemical->company_id = $company_ID;
            $update_chemical->save();

            return redirect('supervisor/chemical/view_all_chemical')->with('success', "Chemical Successfully Update !");
        }
        return redirect()->back()->with('error', 'Chemical not found.');
    }

    // WATER SUPPLY EQUIPMENT
    public function btnAddNewWaterSupplyEquipment()
    {
        return view('supervisor.water_supply_equipment.add_new_water_supply_equipment');
    }

    public function autoSearchWaterSupplyEquipment(Request $request)
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data = WaterSupplyEquipmentModel::select('*',)
                ->where('water_supply_equipment_status', 1)
                ->where('company_id', $company_ID)
                ->where('water_supply_equipment_name', 'LIKE', '%' .  $request->search. '%')
                ->get();
        // Return the data as a JSON response
        return response()->json($data);
    }

    public function btnViewAllWaterSupplyEquipment()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['viewActiveWaterSupplyEquipment'] = WaterSupplyEquipmentModel::ToGetAllActiveWaterSupplyEquipment($company_ID);
        if ($data['viewActiveWaterSupplyEquipment']->isEmpty())
        {
            $data['noActiveWaterSupplyEquipment'] = true;
        }
        else
        {
            $data['noActiveWaterSupplyEquipment'] = false;
        }

        return view('supervisor.water_supply_equipment.view_all_water_supply_equipment', $data);
    }

    public function btnViewIndividialWaterSupplyEquipment($water_supply_equipment_id)
    {
        $data['singleWaterSupplyEquipment'] = WaterSupplyEquipmentModel::ToSingleWaterSupplyEquipment($water_supply_equipment_id);
        return view('supervisor.water_supply_equipment.view_individual_water_supply_equipment', $data);
    }

    public function btnEditWaterSupplyEquipment($water_supply_equipment_id)
    {
        $data['singleWaterSupplyEquipment'] = WaterSupplyEquipmentModel::ToSingleWaterSupplyEquipment($water_supply_equipment_id);
        if(!empty($data['singleWaterSupplyEquipment']))
        {
            return view('supervisor.water_supply_equipment.edit_water_supply_equipment', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function btnViewDeletedWaterSupplyEquipment()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['viewDeleteWaterSupplyEquipment'] = WaterSupplyEquipmentModel::ToGetAllDeleteWaterSupplyEquipment($company_ID);
        return view('supervisor.water_supply_equipment.view_deleted_water_supply_equipment', $data);
    }

    public function btnViewSuspendWaterSupplyEquipment()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['viewSuspendWaterSupplyEquipment'] = WaterSupplyEquipmentModel::ToGetAllSuspendWaterSupplyEquipment($company_ID);
        return view('supervisor.water_supply_equipment.view_suspend_water_supply_equipment', $data);
    }

    public function deleteWaterSupplyEquipment($water_supply_equipment_id)
    {
        $equipment = WaterSupplyEquipmentModel::ToSingleWaterSupplyEquipment($water_supply_equipment_id);
        $equipment->water_supply_equipment_status = 2; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $equipment->save();

        return redirect('supervisor/water_supply_equipment/view_all_water_supply_equipment')->with('success', "Water Supply Equipment Successfully Delete !");
    }

    public function suspendWaterSupplyEquipment($water_supply_equipment_id)
    {
        $equipment = WaterSupplyEquipmentModel::ToSingleWaterSupplyEquipment($water_supply_equipment_id);
        $equipment->water_supply_equipment_status = 3; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $equipment->save();

        return redirect('supervisor/water_supply_equipment/view_all_water_supply_equipment')->with('success', "Water Supply Equipment Successfully Suspend !");
    }

    public function restoreWaterSupplyEquipment($water_supply_equipment_id)
    {
        $equipment = WaterSupplyEquipmentModel::ToSingleWaterSupplyEquipment($water_supply_equipment_id);
        $equipment->water_supply_equipment_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $equipment->save();

        return redirect('supervisor/water_supply_equipment/view_all_water_supply_equipment')->with('success', "Water Supply Equipment Successfully Restore !");
    }

    public function activateWaterSupplyEquipment($water_supply_equipment_id)
    {
        $equipment = WaterSupplyEquipmentModel::ToSingleWaterSupplyEquipment($water_supply_equipment_id);
        $equipment->water_supply_equipment_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $equipment->save();

        return redirect('supervisor/water_supply_equipment/view_all_water_supply_equipment')->with('success', "Water Supply Equipment Successfully Activate !");
    }

    public function addNewWaterSupplyEquipment(Request $request)
    {
        /* dd($request->all()); */
        $userDetails = User::ToGetCompanyIDFromEmployee(auth()->id());
        $collection = collect($userDetails);
        $company_id = $collection->pluck('company_id')->first();

        $rules = [
            'water_supply_equipment_name' => [
                'required',
                Rule::unique('water_supply_equipment')
                    ->where(function ($query) use ($company_id) {
                        $query->where('company_id', $company_id);
                    })
            ],
            'water_supply_equipment_qty' => 'required',
            'water_supply_equipment_price' => 'required',
            'water_supply_equipment_description' => 'required',
        ];

        // Custom error messages
        $messages = [
            'water_supply_equipment_name.unique' => 'The Water Supply Equipment already exists in the company !',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = auth()->id();
        if($id)
        {
            $userDetails = User::ToGetCompanyIDFromEmployee($id);
            $collection = collect($userDetails);
            $company_ID = $collection->pluck('company_id')->first();

            $new_water_equipment = new WaterSupplyEquipmentModel;
            $new_water_equipment->water_supply_equipment_name = trim($request->water_supply_equipment_name);
            $new_water_equipment->water_supply_equipment_qty = trim($request->water_supply_equipment_qty);
            $new_water_equipment->water_supply_equipment_price = trim($request->water_supply_equipment_price);
            $new_water_equipment->water_supply_equipment_description = trim($request->water_supply_equipment_description);
            $new_water_equipment->water_supply_equipment_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
            $new_water_equipment->company_id = $company_ID;

            $new_water_equipment->save();

            return redirect('supervisor/water_supply_equipment/view_all_water_supply_equipment')->with('success', "New Water Supply Equipment Successfully Added !");
        }
        return redirect()->back()->with('error', 'Water Supply Equipment not found.');
    }

    public function editWaterSupplyEquipment($water_supply_equipment_id, Request $request)
    {
        /* dd($request->all()); */
        $userDetails = User::ToGetCompanyIDFromEmployee(auth()->id());
        $collection = collect($userDetails);
        $company_id = $collection->pluck('company_id')->first();

        $rules = [
            'water_supply_equipment_name' => [
                'required',
                Rule::unique('water_supply_equipment')
                    ->where(function ($query) use ($company_id) {
                        $query->where('company_id', $company_id);
                    })
            ],
            'water_supply_equipment_qty' => 'required',
            'water_supply_equipment_price' => 'required',
            'water_supply_equipment_description' => 'required',
        ];

        // Custom error messages
        $messages = [
            'water_supply_equipment_name.unique' => 'The Water Supply Equipment already exists in the company !',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = auth()->id();
        if($id)
        {
            $userDetails = User::ToGetCompanyIDFromEmployee($id);
            $collection = collect($userDetails);
            $company_ID = $collection->pluck('company_id')->first();

            $update_water_equipment = WaterSupplyEquipmentModel::ToSingleWaterSupplyEquipment($water_supply_equipment_id);
            $update_water_equipment->water_supply_equipment_name = trim($request->water_supply_equipment_name);
            $update_water_equipment->water_supply_equipment_qty = trim($request->water_supply_equipment_qty);
            $update_water_equipment->water_supply_equipment_price = trim($request->water_supply_equipment_price);
            $update_water_equipment->water_supply_equipment_description = trim($request->water_supply_equipment_description);
            $update_water_equipment->water_supply_equipment_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
            $update_water_equipment->company_id = $company_ID;
            $update_water_equipment->save();

            return redirect('supervisor/water_supply_equipment/view_all_water_supply_equipment')->with('success', "Water Supply Equipment Successfully Update !");
        }
        return redirect()->back()->with('error', 'Water Supply Equipment not found.');
    }

    // JOB MANAGEMENT [SUPERVISOR SIDE]
    public function btnCreateNewJob()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['ToGetActiveTechnician'] = EmployeeModel::ToGetActiveTechnician($company_ID);
        $data['ToGetCustomerDetails'] = CustomerModel::ToGetCustomerDetails();
        return view('supervisor.job.create_new_job', $data);
    }

    public function createAndAssignedJob(Request $request)
    {
        /* dd($request->all()); */
        $rules = [
            'employee_id' => 'required',
            'customer_id' => 'required',
            'job_date' => 'required|date',
            'job_start_time' => [
                'required',
                Rule::unique('job')->where(function ($query) use ($request) {
                    return $query->where('employee_id', $request->employee_id)
                                 ->where('job_date', date('Y-m-d', strtotime($request->job_date)))
                                 ->where('job_start_time', $request->job_start_time);
                }),
                function ($attribute, $value, $fail) use ($request) {
                    $startTime = $value;
                    $endTime = date('H:i', strtotime('+1 hour', strtotime($value))); // Assuming each job is 1 hour long

                    $clashingJobs = JobModel::where('employee_id', $request->employee_id)
                        ->where('job_date', date('Y-m-d', strtotime($request->job_date)))
                        ->where(function ($query) use ($startTime, $endTime) {
                            $query->whereBetween('job_start_time', [$startTime, $endTime])
                                ->orWhereBetween('job_end_time', [$startTime, $endTime]);
                        })
                        ->count();

                    if ($clashingJobs > 0) {
                        $fail('The selected start time clashes with an existing job for the employee.');
                    }
                },
            ],
            'job_description' => 'required',
        ];

        // Custom error messages
        $messages = [
            'job_start_time.unique' => 'The selected start time is already assigned for the employee on the given time.',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $new_job_assigned = new JobModel;
        $new_job_assigned->employee_id = trim($request->employee_id);
        $new_job_assigned->customer_id = trim($request->customer_id);
        $new_job_assigned->job_date = date('Y-m-d', strtotime(trim($request->job_date))); // SQL STORE DATE format: Y-m-d
        $new_job_assigned->job_start_time = trim($request->job_start_time);
        $new_job_assigned->job_end_time =  "";
        $new_job_assigned->job_description = trim($request->job_description);
        $new_job_assigned->job_status = 0; // Status: 0: Not Completed, 1: Completed, 2: Require Extra Help, 3: Delete, 4: Incompleted
        $new_job_assigned->save();

        return redirect('supervisor/job/view_all_pending_job')->with('success', "New Job Successfully created and assigned to Technician !");
    }

    public function btnViewAllPendingJob()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['viewAllPendingJob'] = JobModel::ToViewAllPendingJob($company_ID);
        if ($data['viewAllPendingJob']->isEmpty())
        {
            $data['noPendingJob'] = true;
        }
        else
        {
            $data['noPendingJob'] = false;
        }
        return view('supervisor.job.view_all_pending_job', $data);
    }

    public function autoSearchAllPendingJobs(Request $request)
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data = JobModel::select('*',)
                ->join('employee', 'job.employee_id', '=', 'employee.employee_id')
                ->join('users', 'employee.user_id', '=', 'users.id')
                ->where('job.job_status', '=', 0)
                ->where('employee.company_id', $company_ID)
                ->where(function ($query) use ($request) {
                    $searchTerm = '%' . $request->search . '%';
                    $query->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm]);
                })
                ->get();
        // Return the data as a JSON response
        return response()->json($data);
    }

    public function btnSupervisorViewIndividualJob($job_id)
    {
        $data['individualEmployeeJob'] = JobModel::ToGetIndividualEmployeeOnJob($job_id);
        if(!empty($data['individualEmployeeJob']))
        {
            return view('supervisor.job.view_more_job_description', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function btnSupervisorEditJob($job_id)
    {
        $data['jobDescription'] = JobModel::ToGetIndividualEmployeeOnJob($job_id);
        if(!empty($data['jobDescription']))
        {
            return view('supervisor.job.edit_job', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function editJob($job_id, Request $request)
    {
        /* dd($request->all()); */
        $edit_job = JobModel::ToGetIndividualEmployeeOnJob($job_id);
        /* $edit_job->job_start_time = trim($request->job_start_time); */
        $edit_job->job_end_time = "";
        $edit_job->job_description = trim($request->job_description);
        $edit_job->job_status = 0; // Status: 0: Not Completed, 1: Completed, 2: Require Extra Help, 3: Delete, 4: Incompleted
        $edit_job->save();

        return redirect('supervisor/job/view_all_pending_job')->with('success', "Job Successfully Update !");
    }

    public function deleteJob($job_id)
    {
        $delete_job = JobModel::ToGetIndividualEmployeeOnJob($job_id);
        $delete_job->job_status = 3; // Status: 0: Not Completed, 1: Completed, 2: Require Extra Help, 3: Delete, 4: Incompleted
        $delete_job->save();

        return redirect('supervisor/job/view_all_pending_job')->with('success', "Job Successfully Delete !");
    }

    public function btnViewAllCompletedJob()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['viewAllCompletedJob'] = JobModel::ToViewAllCompletedJobsByTechnicians($company_ID);
        if ($data['viewAllCompletedJob']->isEmpty())
        {
            $data['noCompletedJob'] = true;
        }
        else
        {
            $data['noCompletedJob'] = false;
        }
        return view('supervisor.job.view_all_completed_job', $data);
    }

    public function btnViewAllJobRequireAssistance()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['viewAllJobRequireAssistance'] = JobModel::ToViewAllJobRequireAssistance($company_ID);
        if ($data['viewAllJobRequireAssistance']->isEmpty())
        {
            $data['noRequireAssistance'] = true;
        }
        else
        {
            $data['noRequireAssistance'] = false;
        }
        return view('supervisor.job.view_all_job_require_assistance', $data);
    }

    public function btnAssistanceOver($job_id)
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromEmployee($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $jobDetails = JobModel::ToViewJobDetailsBasedOnEmployeeThatRequestingAssistance($job_id);

        $customer_ID =  $jobDetails->pluck('customer_id'); // customer_id
        $employee_ID =  $jobDetails->pluck('employee_id'); // employee_id
        $jobDescription = $jobDetails->pluck('job_description'); // job_description

        $data['ToGetAllDetailsForAssistance'] = EmployeeModel::ToGetAllDetailsForAssistance($employee_ID, $company_ID, $jobDescription);
        $data['ToGetOtherTechnicianAvailable'] = EmployeeModel::ToGetOtherTechnicianAvailable($employee_ID, $company_ID);
        $data['ToGetCustomerName'] = CustomerModel::ToGetCustomerName($customer_ID);

        $update_job_status = JobModel::ToSingleJob($job_id);
        $update_job_status->job_status = 4; // Status: 0: Not Completed, 1: Completed, 2: Require Extra Help, 3: Delete, 4: Incompleted
        $update_job_status->save();

        return view('supervisor.job.sent_assistance', $data);
    }

    public function createJobAssistance(Request $request)
    {
        /* dd($request->all()); */
        $rules = [
            'employee_id' => 'required',
            'customer_id' => 'required',
            'job_date' => 'required|date',
            'job_start_time' => [
                'required',
                Rule::unique('job')->where(function ($query) use ($request) {
                    return $query->where('employee_id', $request->employee_id)
                                 ->where('job_date', date('Y-m-d', strtotime($request->job_date)))
                                 ->where('job_start_time', $request->job_start_time);
                }),
                function ($attribute, $value, $fail) use ($request) {
                    $startTime = $value;
                    $endTime = date('H:i', strtotime('+1 hour', strtotime($value))); // Assuming each job is 1 hour long

                    $clashingJobs = JobModel::where('employee_id', $request->employee_id)
                        ->where('job_date', date('Y-m-d', strtotime($request->job_date)))
                        ->where(function ($query) use ($startTime, $endTime) {
                            $query->whereBetween('job_start_time', [$startTime, $endTime])
                                ->orWhereBetween('job_end_time', [$startTime, $endTime]);
                        })
                        ->count();

                    if ($clashingJobs > 0) {
                        $fail('The selected start time clashes with an existing job for the employee.');
                    }
                },
            ],
            'job_description' => 'required',
        ];

        // Custom error messages
        $messages = [
            'job_start_time.unique' => 'The selected start time is already assigned for the employee on the given time.',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $new_job_assigned = new JobModel;
        $new_job_assigned->employee_id = trim($request->employee_id);
        $new_job_assigned->customer_id = trim($request->customer_id);
        $new_job_assigned->job_date = date('Y-m-d', strtotime(trim($request->job_date))); // SQL STORE DATE format: Y-m-d
        $new_job_assigned->job_start_time = trim($request->job_start_time);
        $new_job_assigned->job_end_time =  "";
        $new_job_assigned->job_description = trim($request->job_description);
        $new_job_assigned->job_status = 0; // Status: 0: Not Completed, 1: Completed, 2: Require Extra Help, 3: Delete, 4: Incompleted

        $new_job_assigned->save();

        return redirect('supervisor/job/view_all_pending_job')->with('success', "Assistance successfully deployed !");
    }

    public function btnViewAllDeletedJob()
    {
        $data['viewAllDeletedJob'] = JobModel::ToViewAllDeletedJob();
        if ($data['viewAllDeletedJob']->isEmpty())
        {
            $data['noDeletedJob'] = true;
        }
        else
        {
            $data['noDeletedJob'] = false;
        }
        return view('supervisor.job.view_deleted_job', $data);
    }

    public function btnViewReport($job_id)
    {

        $data['individualEmployeeJob'] = JobModel::ToGetIndividualEmployeeOnJob($job_id);
        $data['individualEmployeeJobReport'] = JobReportModel::ToGetIndividualEmployeeOnJobReport($job_id);
        return view('supervisor.job.view_report', $data);
    }

    // REPORT & ANALYSIS [SUPERVISOR SIDE]
    public function btnViewAllCustomerRegionSupervisor()
    {
        $data['viewCustomersRegion'] = CustomerModel::ToViewCustomersRegion();
        if ($data['viewCustomersRegion']->isEmpty())
        {
            $data['noCustomerRegion'] = true;
        }
        else
        {
            $data['noCustomerRegion'] = false;
        }
        return view('supervisor.report_analysis.view_customer_by_region', $data);
    }
    public function btnViewAllCustomerNorthRegionSupervisor()
    {
        $data['viewCustomerNorthRegion'] = CustomerModel::ToViewCustomerNorthRegion();
        if ($data['viewCustomerNorthRegion']->isEmpty())
        {
            $data['noCustomerInNorthRegion'] = true;
        }
        else
        {
            $data['noCustomerInNorthRegion'] = false;
        }
        return view('supervisor.report_analysis.customers_north_region', $data);
    }

    public function btnViewAllCustomerSouthRegionSupervisor()
    {
        $data['viewCustomerSouthRegion'] = CustomerModel::ToViewCustomerSouthRegion();
        if ($data['viewCustomerSouthRegion']->isEmpty())
        {
            $data['noCustomerInSouthRegion'] = true;
        }
        else
        {
            $data['noCustomerInSouthRegion'] = false;
        }
        return view('supervisor.report_analysis.customers_south_region', $data);
    }

    public function btnViewAllCustomerEastRegionSupervisor()
    {
        $data['viewCustomerEastRegion'] = CustomerModel::ToViewCustomerEastRegion();
        if ($data['viewCustomerEastRegion']->isEmpty())
        {
            $data['noCustomerInEastRegion'] = true;
        }
        else
        {
            $data['noCustomerInEastRegion'] = false;
        }
        return view('supervisor.report_analysis.customers_east_region', $data);
    }

    public function btnViewAllCustomerWestRegionSupervisor()
    {
        $data['viewCustomerWestRegion'] = CustomerModel::ToViewCustomerWestRegion();
        if ($data['viewCustomerWestRegion']->isEmpty())
        {
            $data['noCustomerInWestRegion'] = true;
        }
        else
        {
            $data['noCustomerInWestRegion'] = false;
        }
        return view('supervisor.report_analysis.customers_west_region', $data);
    }

    public function autoSearchCustomerRegionSupervisor(Request $request)
    {
        $searchTerm = '%' . $request->search . '%';

        $data = CustomerModel::select('*',)
            ->join('payment', 'customer.customer_id', '=', 'payment.customer_id')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm])
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    public function autoSearchCustomerNorthRegionSupervisor(Request $request)
    {
        $searchTerm = '%' . $request->search . '%';

        $data = CustomerModel::select('*',)
            ->join('payment', 'customer.customer_id', '=', 'payment.customer_id')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm])
            ->where('customer.region', 'North')
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    public function autoSearchCustomerSouthRegionSupervisor(Request $request)
    {
        $searchTerm = '%' . $request->search . '%';

        $data = CustomerModel::select('*',)
            ->join('payment', 'customer.customer_id', '=', 'payment.customer_id')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm])
            ->where('customer.region', 'South')
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    public function autoSearchCustomerEastRegionSupervisor(Request $request)
    {
        $searchTerm = '%' . $request->search . '%';

        $data = CustomerModel::select('*',)
            ->join('payment', 'customer.customer_id', '=', 'payment.customer_id')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm])
            ->where('customer.region', 'East')
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    public function autoSearchCustomerWestRegionSupervisor(Request $request)
    {
        $searchTerm = '%' . $request->search . '%';

        $data = CustomerModel::select('*',)
            ->join('payment', 'customer.customer_id', '=', 'payment.customer_id')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm])
            ->where('customer.region', 'West')
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    // METER READING [SUPERVISOR SIDE]
    public function btnViewAllCustomerMeterReadingSupervisor()
    {
        $data['viewCustomerMeterReading'] = PipeModel::ToViewAllCustomerMeterReading();
        if ($data['viewCustomerMeterReading']->isEmpty())
        {
            $data['noCustomerMeterReading'] = true;
        }
        else
        {
            $data['noCustomerMeterReading'] = false;
        }
        return view('supervisor.report_analysis.view_all_customer_meter_reading', $data);
    }

    public function btnViewIndividualCustomerMeterReadingSupervisor($customer_id)
    {
        $data['pipeNames'] = PipeModel::getPipeNames($customer_id);
        $data['leakStatus'] = PipeModel::getLeakStatus($customer_id);
        $data['pipeStatus'] = PipeModel::getPipeStatus($customer_id);
        $data['meterValue'] = PipeModel::getMeterValue($customer_id);
        if(!empty($data['pipeNames']))
        {
            return view('supervisor.report_analysis.view_individual_customer_meter_reading', $data);
        }
        else
        {
            abort(404);
        }
        return view('supervisor.report_analysis.view_individual_customer_meter_reading', $data);
    }

    public function autoSearchCustomerMeterSupervisor(Request $request)
    {
        $data = PipeModel::select(
                    'customer.customer_id',
                    DB::raw("CONCAT(users.fname, ' ', users.lname) AS customer_name"),
                    DB::raw('SUM(pipe.meter_value) AS total_meter_value')
                )
                ->join('customer', 'customer.customer_id', '=', 'pipe.customer_id')
                ->join('users', 'customer.user_id', '=', 'users.id')
                ->groupBy('customer.customer_id', 'users.fname', 'users.lname')
                ->where(function ($query) use ($request) {
                    $searchTerm = '%' . $request->search . '%';
                    $query->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm]);

                })
                ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    // JOB MANAGEMENT [TECHNICIAN SIDE]
    public function btnViewPendigJob()
    {
        $id = Auth::user()->id;
        $data['viewPendingJobForTechnician'] = JobModel::ToViewPendingJobForTechnician($id);
        if ($data['viewPendingJobForTechnician']->isEmpty())
        {
            $data['noPendingJobForTechnician'] = true;
        }
        else
        {
            $data['noPendingJobForTechnician'] = false;
        }
        return view('technician.job.view_pending_job', $data);
    }

    public function btnRequireAssistance($job_id)
    {
        $assistance = JobModel::ToGetIndividualEmployeeOnJob($job_id);
        $assistance->job_status = 2; // Status: 0: Not Completed, 1: Completed, 2: Require Extra Help, 3: Delete, 4: Incompleted
        $assistance->save();
        return redirect('technician/job/view_pending_job')->with('success', "Awaiting Assistance !");
    }

    public function btnTechnicianViewJob($job_id)
    {
        $data['jobDescription'] = JobModel::ToGetIndividualEmployeeOnJob($job_id);
        if(!empty($data['jobDescription']))
        {
            return view('technician.job.view_more_job_description', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function btnUpdateJob($job_id)
    {
        $data['jobDescription'] = JobModel::ToGetIndividualEmployeeOnJob($job_id);
        if(!empty($data['jobDescription']))
        {
            return view('technician.job.update_job', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function btnViewCompletedJob()
    {
        $id = Auth::user()->id;
        $data['viewAllCompletedJob'] = JobModel::ToViewAllCompletedJob($id);
        if ($data['viewAllCompletedJob']->isEmpty())
        {
            $data['noCompletedJob'] = true;
        }
        else
        {
            $data['noCompletedJob'] = false;
        }
        return view('technician.job.view_all_completed_job', $data);
    }

    public function updateJobStatusAndReport($job_id, Request $request)
    {
        /* dd($request->all()); */
        $update_job = JobModel::ToGetIndividualEmployeeOnJob($job_id);
        $update_job->job_end_time = trim($request->job_end_time); // "";
        $update_job->job_status = 1; // Status: 0: Not Completed, 1: Completed, 2: Require Extra Help, 3: Delete, 4: Incompleted
        $update_job->save();

        $job_report = new JobReportModel;
        $job_report->job_id = $job_id;
        $job_report->job_report = trim($request->job_report);
        $job_report->save();

        return redirect('technician/job/view_my_completed_jobs')->with('success', "Job Successfully Completed and Update !");
    }

    // CUSTOMER MANAGEMENT [TECHNICIAN SIDE]
    public function btnViewAllCustomerRegionTechnician()
    {
        $data['viewCustomersRegion'] = CustomerModel::ToViewCustomersRegion();
        if ($data['viewCustomersRegion']->isEmpty())
        {
            $data['noCustomerRegion'] = true;
        }
        else
        {
            $data['noCustomerRegion'] = false;
        }
        return view('technician.customermanagement.view_customer_by_region', $data);
    }

    public function btnViewAllCustomerNorthRegionTechnician()
    {
        $data['viewCustomerNorthRegion'] = CustomerModel::ToViewCustomerNorthRegion();
        if ($data['viewCustomerNorthRegion']->isEmpty())
        {
            $data['noCustomerInNorthRegion'] = true;
        }
        else
        {
            $data['noCustomerInNorthRegion'] = false;
        }
        return view('technician.customermanagement.customers_north_region', $data);
    }

    public function btnViewAllCustomerSouthRegionTechnician()
    {
        $data['viewCustomerSouthRegion'] = CustomerModel::ToViewCustomerSouthRegion();
        if ($data['viewCustomerSouthRegion']->isEmpty())
        {
            $data['noCustomerInSouthRegion'] = true;
        }
        else
        {
            $data['noCustomerInSouthRegion'] = false;
        }
        return view('technician.customermanagement.customers_south_region', $data);
    }

    public function btnViewAllCustomerEastRegionTechnician()
    {
        $data['viewCustomerEastRegion'] = CustomerModel::ToViewCustomerEastRegion();
        if ($data['viewCustomerEastRegion']->isEmpty())
        {
            $data['noCustomerInEastRegion'] = true;
        }
        else
        {
            $data['noCustomerInEastRegion'] = false;
        }
        return view('technician.customermanagement.customers_east_region', $data);
    }


    public function btnViewAllCustomerWestRegionTechnician()
    {
        $data['viewCustomerWestRegion'] = CustomerModel::ToViewCustomerWestRegion();
        if ($data['viewCustomerWestRegion']->isEmpty())
        {
            $data['noCustomerInWestRegion'] = true;
        }
        else
        {
            $data['noCustomerInWestRegion'] = false;
        }
        return view('technician.customermanagement.customers_west_region', $data);
    }

    public function autoSearchCustomerRegionTechnician(Request $request)
    {
        $searchTerm = '%' . $request->search . '%';

        $data = CustomerModel::select('*',)
            ->join('payment', 'customer.customer_id', '=', 'payment.customer_id')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm])
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    public function autoSearchCustomerNorthRegionTechnician(Request $request)
    {
        $searchTerm = '%' . $request->search . '%';

        $data = CustomerModel::select('*',)
            ->join('payment', 'customer.customer_id', '=', 'payment.customer_id')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm])
            ->where('customer.region', 'North')
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }
    public function autoSearchCustomerSouthRegionTechnician(Request $request)
    {
        $searchTerm = '%' . $request->search . '%';

        $data = CustomerModel::select('*',)
            ->join('payment', 'customer.customer_id', '=', 'payment.customer_id')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm])
            ->where('customer.region', 'South')
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    public function autoSearchCustomerEastRegionTechnician(Request $request)
    {
        $searchTerm = '%' . $request->search . '%';

        $data = CustomerModel::select('*',)
            ->join('payment', 'customer.customer_id', '=', 'payment.customer_id')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm])
            ->where('customer.region', 'East')
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    public function autoSearchCustomerWestRegionTechnician(Request $request)
    {
        $searchTerm = '%' . $request->search . '%';

        $data = CustomerModel::select('*',)
            ->join('payment', 'customer.customer_id', '=', 'payment.customer_id')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm])
            ->where('customer.region', 'West')
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    // METER READING [TECHNICIAN SIDE]
    public function btnViewAllCustomerMeterReadingTechnician()
    {
        $data['viewCustomerMeterReading'] = PipeModel::ToViewAllCustomerMeterReading();
        //$data['averageUsage'] = CustomerModel::ToGetAverageBasedOnRegions();
        if ($data['viewCustomerMeterReading']->isEmpty())
        {
            $data['noCustomerMeterReading'] = true;
        }
        else
        {
            $data['noCustomerMeterReading'] = false;
        }
        return view('technician.meterreading.view_all_customer_meter_reading', $data);
    }

    public function btnViewIndividualCustomerMeterReadingTechnician($customer_id)
    {
        $data['pipeNames'] = PipeModel::getPipeNames($customer_id);
        $data['leakStatus'] = PipeModel::getLeakStatus($customer_id);
        $data['pipeStatus'] = PipeModel::getPipeStatus($customer_id);
        $data['meterValue'] = PipeModel::getMeterValue($customer_id);
        if(!empty($data['pipeNames']))
        {
            return view('technician.meterreading.view_individual_customer_meter_reading', $data);
        }
        else
        {
            abort(404);
        }
        return view('technician.meterreading.view_individual_customer_meter_reading', $data);
    }

    public function autoSearchCustomerMeterTechnician(Request $request)
    {
        $data = PipeModel::select(
                    'customer.customer_id',
                    DB::raw("CONCAT(users.fname, ' ', users.lname) AS customer_name"),
                    DB::raw('SUM(pipe.meter_value) AS total_meter_value')
                )
                ->join('customer', 'customer.customer_id', '=', 'pipe.customer_id')
                ->join('users', 'customer.user_id', '=', 'users.id')
                ->groupBy('customer.customer_id', 'users.fname', 'users.lname')
                ->where(function ($query) use ($request) {
                    $searchTerm = '%' . $request->search . '%';
                    $query->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm]);

                })
                ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }
}
