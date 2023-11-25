<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update_image(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $oldImagePath = auth()->user()->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users_images', 'public');

            auth()->user()->update(['image' => $imagePath]);

            if ($oldImagePath && $oldImagePath !== 'users_images/default.svg') {
                Storage::disk('public')->delete($oldImagePath);
            }

            return redirect()->route('profile.edit')->with('status', 'image-updated');
        }
        return redirect()->route('profile.edit');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function update_brief(Request $request)
    {
        $request->validate([
            'company_brief' => ["nullable", 'string', 'max:500'],
        ]);
        auth()->user()->update([
            "company_brief" => $request->company_brief
        ]);
        return Redirect::route('profile.edit')->with('status', 'update-brief');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
