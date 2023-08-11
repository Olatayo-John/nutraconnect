<?php

namespace App\Traits;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait UserTrait
{

    //initial permissionPerRole for new user
    public function InitialUserRolePermission($user)
    {
        $user->load('role.permissions');
        $dbPermissions = $user->role->pluck('permissions')->collapse()->pluck('id')->unique()->toArray();
        $user->permissions()->sync($dbPermissions);

        return true;
    }

    //is the loggedIn user is the owner of the resource trying to be accessed
    public function isOwner($id)
    {
        if (Auth::user()->id !== $id) {
            abort(403, 'Unauthorized user');
        }
    }

    //is the loggedIn user is the owner of the resource trying to be accessed
    //if not owner check if its admin
    public function isOwnerOrAdmin($id)
    {
        if (Auth::user()->id === $id) {
            return true;
        }

        if (Auth::user()->role === 'Admin') {
            return true;
        }

        dd(Auth::user()->role);
        abort(403, 'Unauthorized user');
    }

    //delete images from storage
    public function deleteImage($imgDisk, $imgPath, $isArray = false)
    {
        //an array of images
        if ($isArray === true) {
            foreach ($imgPath as $key => $value) {
                if ($value && isset($value)) {
                    Storage::disk($imgDisk)->delete($value);
                }
            }

            return true;
        } else {
            //single img
            if ($imgPath && isset($imgPath)) {
                Storage::disk($imgDisk)->delete($imgPath);

                return true;
            }
        }
    }

    //get value of setting by key
    public function getSiteSettings($settingKey)
    {
        if ($settingKey ?? false) {
            $settingVal = Setting::where('meta_key', '=', $settingKey)->get()->pluck('meta_value')->first();

            if ($settingVal) {
                return $settingVal;
            } else {
                return null;
            }
        }
    }
}
