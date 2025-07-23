<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function store(Request $request): RedirectResponse
    {

        $roles = [];
        $user_create = [];
        if ($request->account_type === "personal") {
            $roles = [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'phone' => ['required', 'max:11', 'unique:' . User::class],
                'phone_second' => ['max:11'],
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ];
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('users_images', 'public');
            }
            $user_create = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'phone_sec' => $request->phone_second ?? null,
                'password' => Hash::make($request->password),
                'account_type' => "personal",
                "image" => $path ?? "users_images/default.svg",
                "property_charge" => 2
            ];

        }
        if ($request->account_type === "company") {
            $roles = [
                'name' => ['required', 'string', 'max:255'],
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'company_brief' => ['required', 'string', 'max:500'],
                'company_name' => ['required', 'string', 'max:255', 'unique:' . User::class],
                'company_type' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'location' => ['max:255'],
                'phone' => ['required', 'max:11', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ];
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('users_images', 'public');
            }
            $user_create = [
                'name' => $request->name,
                'company_name' => $request->company_name,
                'company_brief' => $request->company_brief,
                'company_type' => $request->company_type,
                'email' => $request->email,
                'location' => $request->location ?? null,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'account_type' => "company",
                "image" => $path ?? "users_images/default.svg",
                "property_charge" => 10
            ];
        }
        $request->validate($roles);

        $user = User::create($user_create);

        event(new Registered($user));

        Auth::login($user);

        if ($user->account_type === "company") {
            return redirect()->route("company.plans");
        }
        return redirect("/");
    }

    public function create(): View
    {
        return view('auth.register');
    }
}
