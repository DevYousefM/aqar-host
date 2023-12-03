<?php

namespace App\Http\Controllers;

use App\Models\CompanyBanner;
use App\Models\CompanyPlans;
use App\Models\Contact;
use App\Models\Property;
use App\Models\SingleService;
use App\Models\Slider;
use App\Models\User;
use App\Models\UserPlans;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function show_companies()
    {
        $im_companies = User::where("account_type", "company")->where("is_important", true)->paginate(8);
        $left_sliders = Slider::where("place", "left")->get();
        $right_sliders = Slider::where("place", "right")->get();
        $banners = CompanyBanner::all();
        // return view("pages.companies", ["companies" => $im_companies, "left_sliders" => $left_sliders, "right_sliders" => $right_sliders, "banners" => $banners]);
        return $im_companies;
    }

    public function im_property()
    {
        $ads = Property::where("is_special", true)->paginate(10);
        $left_sliders = Slider::where("place", "left")->get();
        $right_sliders = Slider::where("place", "right")->get();
        return view('pages.im-property', ["ads" => $ads, "left_sliders" => $left_sliders, "right_sliders" => $right_sliders]);
    }

    public function call_us()
    {
        return view("pages.call-us");
    }

    public function send_message(Request $request)
    {
        $cats = ["أستفسار", "أقتراح", "آخر"];
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|in:1,2,3',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        Contact::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "category" => $cats[$request->category],
            "subject" => $request->subject,
            "message" => $request->message,
        ]);
        return redirect()->back()->with("success", "تم ارسال الرسالة, شكرا لتواصلكم معنا");
    }

    public function company_profile($name)
    {
        $company = User::where("account_type", "company")->where("company_name", $name)->first();
        if (!$company) {
            abort(404);
        }
        return view("pages.company-profile", compact("company"));
    }

    public function plans()
    {

        $user_plans = UserPlans::all();
        $company_plans = CompanyPlans::all();
        $left_sliders = Slider::where("place", "left")->get();
        $right_sliders = Slider::where("place", "right")->get();
        return view("pages.plans", compact("user_plans", "company_plans", "left_sliders", "right_sliders"));
    }

    public function company_plans()
    {
        $company_plans = CompanyPlans::all();
        $left_sliders = Slider::where("place", "left")->get();
        $right_sliders = Slider::where("place", "right")->get();
        return view("pages.co-plans", compact("company_plans", "left_sliders", "right_sliders"));
    }

    public function single_services()
    {
        $services = SingleService::all();
        $left_sliders = Slider::where("place", "left")->get();
        $right_sliders = Slider::where("place", "right")->get();
        return view("pages.services", compact("services", "left_sliders", "right_sliders"));
    }
}
