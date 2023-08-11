<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\profile\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $this->authorize('profile_view');

        $data['user'] = User::find(auth()->user()->id);

        return view('profile.index', $data);
    }

    public function edit()
    {
        $this->authorize('profile_update');

        $data['user'] = User::find(auth()->user()->id);

        return view('profile.edit', $data);
    }

    public function update(UpdateProfileRequest $request)
    {
        $this->authorize('profile_update');

        $validated = $request->validated();
        $user= User::find(auth()->user()->id);

        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $path = $image->store('profile', 'public');

            $validated['profile'] = $path;

            //delete prev profile
            $this->deleteImage($imgDisk = 'public', $imgPath = auth()->user()->profile);
        }

        DB::transaction(function () use ($user,$validated) {
            $user->update($validated);
        });

        return to_route('profile')->with('status','Profile Updated');
    }
}
