<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ExportCompany;
use App\Exports\ExportUser;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(["permission:companies_update,guard:admin"])->only(["make_important", "make_unimportant"]);
        $this->middleware(["permission:companies_read,guard:admin"])->only("companies");
        $this->middleware(["permission:users_read,guard:admin"])->only("users");
        $this->middleware(["permission:messages_read,guard:admin"])->only("messages");
    }


    public function login()
    {
        return view("dashboard.auth.login");
    }

    public function companies()
    {
        $companies = User::where("account_type", "company")->get();
        return view("dashboard.companies.show", ["companies" => $companies]);
    }

    public function exportCompanies()
    {
        return Excel::download(new ExportCompany(), 'companies.xlsx');
    }


    public function users()
    {
        $users = User::where("account_type", "personal")->get();
        return view("dashboard.users.show", ["users" => $users]);
    }

    public function exportUsers()
    {
        return Excel::download(new ExportUser, 'users.xlsx');
    }

    public function make_important($id)
    {
        $com = User::find($id);
        if (!$com) {
            return redirect()->back()->with("error", "الحساب غير موجود");
        }
        $com->update(["is_important" => true]);
        return redirect()->back();
    }

    public function make_unimportant($id)
    {
        $com = User::find($id);
        if (!$com) {
            return redirect()->back()->with("error", "الحساب غير موجود");
        }
        $com->update(["is_important" => false]);
        return redirect()->back();
    }

    public function messages()
    {
        $messages = Contact::paginate(10);
        return view("dashboard.messages.show", ["messages" => $messages]);
    }

    // Will Delete It
    public function add_properties()
    {
        $users = User::all();
        return view("dashboard.properties.add", ["users" => $users]);
    }

    public function store_property(Request $request)
    {
        if ($request->user_case === "exist_user") {
            $request->validate([
                'user_ulid' => 'required|exists:users,id',
            ], [
                'user_ulid.*' => 'يجب اختيار مستخدم مسجل',
            ]);
            $user = User::find($request->user_ulid);
        }
        if ($request->user_case === "new_user") {
            $request->validate([
                'user_name' => ['required', 'string', 'max:255'],
                'user_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'user_phone' => ['required', 'max:11', 'unique:users,phone'],
                'user_password' => ['required', Rules\Password::defaults()],
            ]);
            $user_create = [
                'name' => $request->user_name,
                'email' => $request->user_email,
                'phone' => $request->user_phone,
                'password' => Hash::make($request->user_password),
                'account_type' => "personal",
                "image" => "users_images/default.svg",
                "property_charge" => 2
            ];
            $user = User::create($user_create);
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'brief' => 'required|string',
            'type' => 'required|string|max:255',
            'purpose' => 'required|string|max:255|in:بيع,شراء,ايجار',
            'gov' => 'required|numeric|exists:governments,id',
            'area' => 'required|string|max:255',
            'level' => 'nullable',
            'rooms' => 'nullable|integer|min:1',
            'meters' => 'required|numeric|min:1',
            'payment' => 'nullable|in:كاش,قسط',
            'price' => 'required_if:payment,كاش',
            'presenter' => 'required_if:payment,قسط',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if (!empty($request->price)) {
            $request->validate([
                'price' => 'required_if:payment,كاش|integer|max_digits:20',
            ]);
        }
        if (!empty($request->presenter)) {
            $request->validate([
                'presenter' => 'required_if:payment,قسط|integer|max_digits:11',
            ]);
        }
        // Create a new property instance
        $property = Property::create([
            "user_id" => $user->id,
            'title' => $request->title,
            'brief' => $request->brief,
            'type' => $request->type,
            'purpose' => $request->purpose,
            'gov' => $request->gov,
            'area' => $request->area,
            'level' => $request->level,
            'rooms' => $request->rooms,
            'meters' => $request->meters,
            'payment' => $request->payment,
            'presenter' => $request->presenter,
            'price' => $request->price,
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();

                Storage::disk('public')->putFileAs('property_images', $image, $filename);

                $propertyImage = new PropertyImage([
                    'property_id' => $property->id,
                    'path' => $filename,
                ]);

                $propertyImage->save();
            }
        }
        return redirect()->back()->with("success", "تم اضافة العقار");
    }
}
