<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;

class ProfileController extends Controller
{
    // Display the user's profile page
    public function showProfile()
    {
        $user = Auth::user();  // Get the authenticated user
        return view("user.profile", compact('user'));
    }

    // Update profile picture
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Delete the old profile picture if it exists
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        // Store the new profile picture
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $path;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile picture updated successfully.',
            'profile_picture_url' => Storage::url($path)
        ]);
    }
}
