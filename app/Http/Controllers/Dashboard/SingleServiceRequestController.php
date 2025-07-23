<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SingleService;
use App\Models\SingleServiceRequest;
use Illuminate\Http\Request;

class SingleServiceRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware(["permission:single_services_requests_read,guard:admin"])->only(["index", "completed"]);
        $this->middleware(["permission:single_services_requests_update,guard:admin"])->only(["accept_request"]);
        $this->middleware(["permission:single_services_requests_delete,guard:admin"])->only(["reject_request"]);
    }

    public function index()
    {
        $single_services = SingleServiceRequest::where("status", "process")->paginate(10);
        return view("dashboard.single_services.show", compact("single_services"));
    }

    public function completed()
    {
        $single_services = SingleServiceRequest::where("status", "completed")->paginate(10);
        return view("dashboard.single_services.completed", compact("single_services"));
    }

    public function subscribe_single_service(Request $request, $id)
    {
        $user = auth()->user();
        $single_service = SingleService::findOrFail($id);
        SingleServiceRequest::create([
            "user_id" => $user->id,
            "single_service_id" => $id,
        ]);
        return redirect()->back()->with("success", "تم استقبال طلبك وسيتم التواصل معك قريبا لاتمامه");
    }

    public function accept_request(Request $request, $id)
    {
        $req = SingleServiceRequest::findOrFail($id);
        $service = $req->single_service->name;
        $user = $req->user;
        if ($service === "add_properties_service") {
            $user->update([
                "property_charge" => $user->property_charge + 10
            ]);
        }
        $req->update([
            "status" => "completed"
        ]);
        return redirect()->back()->with("success", "تم تحديث الطلب كموافق عليه");
    }

    public function reject_request(Request $request, $id)
    {
        $req = SingleServiceRequest::findOrFail($id);
        $req->delete();
        return redirect()->back()->with("success", "تم حذف الطلب");
    }

}
