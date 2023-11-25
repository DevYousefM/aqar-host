<?php

namespace App\Http\Controllers;

use App\Models\UserPlans;
use App\Models\UserPlansRequests;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserPlansRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware(["permission:user_plans_requests_update,guard:admin"])->only(["accept_request", "end_sub", "expired_subscriptions"]);
        $this->middleware(["permission:user_plans_requests_read,guard:admin"])->only(["index", "current_subscriptions"]);
        $this->middleware(["permission:user_plans_requests_delete,guard:admin"])->only("delete_req");
    }

    public function index()
    {
        $user_plans_requests = UserPlansRequests::where("status", "process")->paginate(10);
        return view("dashboard.requests.personal.user_plans_requests", ["user_plans_requests" => $user_plans_requests]);
    }

    public function store(Request $request)
    {
        if (auth()->user()->account_type !== "personal") {
            abort(404);
        }
        $plan = UserPlans::findOrFail($request->user_plan_id);
        UserPlansRequests::create([
            "user_plan_id" => $request->user_plan_id,
            "property_id" => $request->property_id,
            "status" => "process"
        ]);
        return redirect()->back()->with("success", "تم استلام طلبك وسيتم التواصل معك لاتمامه");
    }

    public function current_subscriptions()
    {
        $user_plans_requests = UserPlansRequests::where("status", "continued")->paginate(10);
        return view("dashboard.requests.personal.process_requests", ["user_plans_requests" => $user_plans_requests]);
    }

    public function accept_request($id)
    {
        $user_request = UserPlansRequests::findOrFail($id);
        $property = $user_request->property;
        $property->update([
            "is_special" => true
        ]);
        $user_request->update([
            "expire_date" => Carbon::now()->addDays($user_request->user_plan->days_num),
            "start_date" => Carbon::now(),
            "status" => "continued"
        ]);
        return redirect()->back()->with("success", "تم قبول الطلب");
    }

    public function end_sub($id)
    {
        $user_request = UserPlansRequests::findOrFail($id);
        $property = $user_request->property;
        $property->update([
            "is_special" => false
        ]);
        $user_request->update([
            "status" => "expired",
        ]);
        return redirect()->back()->with("success", "تم انهاء الاشتراك");
    }

    public function expired_subscriptions()
    {
        $user_plans_requests = UserPlansRequests::where("status", "expired")->paginate(10);
        return view("dashboard.requests.personal.expired_subscriptions", ["user_plans_requests" => $user_plans_requests]);
    }

    public function delete_req($id)
    {
        $user_request = UserPlansRequests::findOrFail($id);
        $user_request->delete();
        return redirect()->back()->with("success", "تم حذف الطلب تماما من السجلات");
    }

    public function show_requests()
    {
        $properties = auth()->user()->properties;
        $requests = [];
        foreach ($properties as $property) {
            $pro_reqs = $property->user_request;
            foreach ($pro_reqs as $req) {
                $requests[] = $req;
            }
        }
        return view("pages.user_requests", ["requests" => $requests]);
    }
}
