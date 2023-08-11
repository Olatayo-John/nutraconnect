<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\setting\UpdateSettingRequest;

class SettingController extends Controller
{

    public function index()
    {
        $this->authorize('setting_update');

        $settings = Setting::all();
        $data['keyedSettings'] = Arr::keyBy($settings, 'meta_key');

        return view('settings.index', $data);
    }

    public function update(UpdateSettingRequest $request)
    {
        $this->authorize('setting_update');

        $validated = $request->all();

        if ($request->hasFile('site_logo')) {
            $siteLogo = $request->file('site_logo');
            $path = $siteLogo->store('settings', 'public');

            $validated['site_logo'] = $path;

            //delete prev logo
            $this->deleteImage($imgDisk = 'public', $imgPath = $this->getSiteSettings('site_logo'));
        }

        DB::transaction(function () use ($validated, $request) {
            foreach ($validated as $key => $value) {
                Setting::where('meta_key', '=', $key)->update([
                    'meta_value' => $value
                ]);
            }
        });

        return back()->with('status', 'Settings updated');
    }
}
