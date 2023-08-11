<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\user\CreateUserRequest;
use App\Http\Requests\user\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('user_list');

        $data['users'] = User::orderBy('name')->get();
        $data['roleList'] = Role::where('status','1')->orderBy('name')->get();

        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $this->authorize('user_create');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            $user= User::create([
                'type'=> $validated['type'],
                'name'=> $validated['name'],
                'email'=> $validated['email'],
                'mobile'=> $validated['mobile'],
                'password'=> $validated['password']
            ]);

            //sync role
            $user->role()->sync($validated['role']);

            //sync permissions
            $this->InitialUserRolePermission($user);
        });

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('user_view');

        $data['user'] = $user;

        return view('user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('user_update');

        $data['user'] = $user;

        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('user_update');

        $fields = $request->validated();
        $userPrevProfile = $user->profile;

        //upload profile
        if ($request->hasFile('profile')) {
            $img = $request->file('profile');
            $path = $img->store('user', 'public');

            $fields['profile'] = $path;

            $this->deleteImage($imgDisk = 'public', $imgPath = $userPrevProfile);
        }

        DB::transaction(function () use ($user, $fields) {
            $user->update($fields);
        });

        return to_route('user.index')->with('status', 'User Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('user_delete');

        $userProfileImg = $user->profile;

        DB::transaction(function () use ($user, $userProfileImg) {
            $user->delete();

            $this->deleteImage($imgDisk = 'public', $imgPath = $userProfileImg);
        });

        return to_route('user.index')->with('status', 'User Deleted');
    }
}
