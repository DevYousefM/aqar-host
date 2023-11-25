<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CompanyPlans;
use App\Models\SubscribeCompanyPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscribeCompanyPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware(["permission:company_plans_requests_read,guard:admin"])->only(["index", "active_plans", "must_stop", "stop_plan", "expired_plans"]);
        $this->middleware(["permission:company_plans_requests_update,guard:admin"])->only(["activate_plan", "reject_request", "update_resources"]);
    }

    public function index()
    {
        $company_plans_requests = SubscribeCompanyPlan::where("status", "process")->paginate(10);
        return view("dashboard.requests.company.company_plans_requests", ["company_plans_requests" => $company_plans_requests]);
    }

    public function active_plans()
    {
        $active_plans = SubscribeCompanyPlan::where("status", "active")->paginate(10);
        return view("dashboard.requests.company.active_plans", ["active_plans" => $active_plans]);
    }

    public function must_stop()
    {
        $plans = SubscribeCompanyPlan::where('status', 'active')
            ->whereDate('end_date', '<=', Carbon::now())
            ->paginate(10);
        return view("dashboard.requests.company.plans_must_stop", ["plans" => $plans]);
    }

    public function stop_plan($id)
    {
        $request = SubscribeCompanyPlan::findOrFail($id);
        $request->update([
            "status" => "expired"
        ]);
        return redirect()->back()->with("success", "تم ايقاف الباقة");
    }

    public function expired_plans()
    {
        $expired_plans = SubscribeCompanyPlan::where("status", "expired")->paginate(10);
        return view("dashboard.requests.company.expired_plans", ["expired_plans" => $expired_plans]);
    }

    public function store(Request $request)
    {
        if (auth()->user()->account_type !== "company") {
            abort(404);
        }
        $plan = CompanyPlans::findOrFail($request->plan_id);
        $process = [];
        if (!empty(auth()->user()->company_plans_sub)) {
            $process = auth()->user()->company_plans_sub->where("status", "process")->first();
        }
        $active = [];
        if (!empty(auth()->user()->company_plans_sub)) {
            $active = auth()->user()->company_plans_sub->where("status", "active")->first();
        }
        if (!empty($process)) {
            return redirect()->route("show.plans")->with("success", "لديك طلب اشتراك في باقة شركات قيد المراجعة فعلياً");
        }
        if (!empty($active)) {
            return redirect()->route("show.plans")->with("success", "انت مشترك في باقة شركات حالياً اذا كنت ترغب في التغيير الي باقة اعلي تواصل مع الدعم");
        }
        SubscribeCompanyPlan::create([
            "user_id" => auth()->user()->id,
            "company_plan_id" => $plan->id,
            "remaining_properties" => $plan->property_num,
            "remaining_special" => $plan->special_property_num,
            "remaining_facebook_ads" => $plan->facebook_ads_num,
            "remaining_youtube_ads" => $plan->youtube_ads_num ?? null,
            "remaining_google_ads" => $plan->google_ads_num ?? null,
            "status" => "process"
        ]);
        return redirect()->route("show.plans")->with("success", "تم استلام طلبك وسوف يتم تفعيل الباقة في غضون ساعات");
    }

    public function activate_plan($id)
    {
        $request = SubscribeCompanyPlan::findOrFail($id);
        $user = $request->user;
        $subs = $user->company_plans_sub;
        $active = false;
        if (!empty($subs)) {
            foreach ($subs as $sub) {
                if ($sub->status === "active") {
                    $active = true;
                }
            }
        }
        if ($active) {
            return redirect()->back()->with("success", "هذا المستخدم لديه باقة مفعلة بالفعل");
        }
        $plan = $request->company_plan;
        $request->update([
            "remaining_properties" => $plan->property_num,
            "remaining_special" => $plan->special_property_num,
            "remaining_facebook_ads" => $plan->facebook_ads_num,
            "remaining_youtube_ads" => $plan->youtube_ads_num ?? null,
            "remaining_google_ads" => $plan->google_ads_num ?? null,
            "start_date" => Carbon::now(),
            "end_date" => Carbon::now()->addYear(),
            "status" => "active"
        ]);
        return redirect()->back()->with("success", "تم تفعيل الباقة");
    }

    public function reject_request($id)
    {
        $request = SubscribeCompanyPlan::findOrFail($id);
        $request->update([
            "status" => "rejected"
        ]);
        return redirect()->back()->with("success", "تم رفض وحذف الطلب");
    }

    public function update_resources($id, $key)
    {
        $allowed_keys = ["remaining_facebook_ads", "remaining_youtube_ads", "remaining_google_ads"];
        if (!in_array($key, $allowed_keys)) {
            abort(404);
        }
        $subscribe = SubscribeCompanyPlan::findOrFail($id);
        if ($subscribe->$key > 0) {
            $subscribe->update([
                "$key" => $subscribe->$key - 1,
            ]);
            return redirect()->back()->with("success", "تم تحديث بيانات الاشتراك");
        }
        return redirect()->back();
    }

    public function show_plans()
    {
        $company_plans_sub = auth()->user()->company_plans_sub;
        return view("pages.user_plans", ["subs" => $company_plans_sub]);
    }
}
