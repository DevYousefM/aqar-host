<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\UserPlans;
use Illuminate\Http\Request;

class UserPlansController extends Controller
{
    public function __construct()
    {
        $this->middleware(["permission:user_plans_update,guard:admin"])->only(["edit", "update"]);
        $this->middleware(["permission:user_plans_read,guard:admin"])->only("index");
    }

    public function index()
    {
        $plans = UserPlans::all();
        return view("dashboard.user_plans.show", ["plans" => $plans]);
    }

    public function edit($id)
    {
        $plan = UserPlans::findOrFail($id);
        return view("dashboard.user_plans.edit", compact("plan"));
    }

    public function update(Request $request, $id)
    {
        $plan = UserPlans::findOrFail($id);
        $request->validate([
            "days_num" => "required|integer|min:1",
            "social_media_appear" => "required|integer",
            "price" => "required|integer|min:1",
        ]);
        $plan->update([
            "days_num" => $request->days_num,
            "social_media_appear" => $request->social_media_appear,
            "price" => $request->price,
        ]);
        return redirect()->back()->with("success", "تم تعديل بيانات الباقة");
    }
}
