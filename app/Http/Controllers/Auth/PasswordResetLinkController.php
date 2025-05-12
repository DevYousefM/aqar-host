<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    // public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'login_identifier' => ['required', 'string'],
        ]);

        $email = null;
        if (filter_var($request->login_identifier, FILTER_VALIDATE_EMAIL)) {
            $email = $request->login_identifier;
        } else {
            $user = User::where('phone', $request->login_identifier)->OrWhere('phone_sec', $request->login_identifier)->first();
            if ($user) {
                $email = $user->email;
            }
        }


        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        // return $email;

        if ($email) {
            try {
                Password::sendResetLink(
                    ["email" => $email]
                );
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }

        return back()->with('status', __(Password::RESET_LINK_SENT));
    }
}
