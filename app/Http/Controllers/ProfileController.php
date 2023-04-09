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
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
    
        $user->fill($request->validated());
    
        // Check if a new profile picture was uploaded
         if ($request->hasFile('profile_picture')) {
        $profilePicture = $request->file('profile_picture');
        $profilePictureName = time() . '_' . $profilePicture->getClientOriginalName();
        $profilePicturePath = $profilePicture->storeAs('public/profile_pictures', $profilePictureName);

        $user->profile_picture = $profilePictureName;
        }

        // If email is updated, mark it as unverified
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        $user->save();
    
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

        return Redirect::to('/login');
    }

    public function deletePicture(Request $request)
    {
        $user = $request->user();

        if ($user->profile_picture) {
            Storage::delete('public/profile_pictures/' . $user->profile_picture);
            $user->profile_picture = null;
            $user->save();
        }
        return redirect()->back()->with('status', 'Profile picture deleted.');
    }
}
