<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(["permission:admins_create,guard:admin"])->only(["create", "store"]);
        $this->middleware(["permission:admins_read,guard:admin"])->only("show");
        $this->middleware(["permission:admins_update,guard:admin"])->only(["update", "edit"]);
        $this->middleware(["permission:admins_delete,guard:admin"])->only("delete");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:4",
            "email" => "required|email|unique:admins,email",
            "password" => "required|min:4|confirmed",
            "permissions" => "required",
        ]);
        $admin = Admin::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        $admin->addRole("admin");
        $admin->syncPermissions($request->permissions);

        return redirect()->back()->with("success", "تم تسجيل المسئول");
    }

    public function create(): View
    {
        return view('dashboard.admins.create');
    }

    public function edit($id): View
    {
        $admin = Admin::findOrFail($id);
        return view('dashboard.admins.edit', compact("admin"));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $request->validate([
            "name" => "required|min:4",
            "email" => ["required", "email", Rule::unique('admins')->ignore($admin->id),],
            "permissions" => "required",
        ]);
        if ($request->password) {
            $request->validate([
                "password" => "min:4|confirmed",
            ]);
            $admin->update([
                "password" => Hash::make($request->password),
            ]);
        }
        $admin->update([
            "name" => $request->name,
            "email" => $request->email,
        ]);
        $admin->syncPermissions($request->permissions);
        return redirect()->route("admins.show")->with("success", "تم تعديل المسئول");
    }

    public function show()
    {
        $admins = [];
        foreach (Admin::all() as $admin) {
            if (!$admin->hasRole("super_admin")) {
                $admins[] = $admin;
            }
        }
        return view("dashboard.admins.show", ["admins" => $admins]);
    }

    public function delete($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route("admins.show")->with("success", "تم حذف المسئول");

    }
}
