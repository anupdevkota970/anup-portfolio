<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::current();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'tagline'      => 'nullable|string|max:255',
            'bio_short'    => 'nullable|string|max:500',
            'bio_long'     => 'nullable|string',
            'email'        => 'nullable|email',
            'phone'        => 'nullable|string|max:50',
            'location'     => 'nullable|string|max:100',
            'age'          => 'nullable|string|max:20',
            'degree'       => 'nullable|string|max:100',
            'github_url'   => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'twitter_url'  => 'nullable|url',
            'is_available' => 'nullable|boolean',
            'avatar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cv_file'      => 'nullable|mimes:pdf|max:5120',
        ]);

        $profile = Profile::current();

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                @unlink(storage_path('app/public/' . $profile->avatar));
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->hasFile('cv_file')) {
            if ($profile->cv_file) {
                @unlink(storage_path('app/public/' . $profile->cv_file));
            }
            $data['cv_file'] = $request->file('cv_file')->store('cv', 'public');
        }

        $data['is_available'] = $request->boolean('is_available');

        $profile->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }
}
