<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first() ?: new Setting();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first() ?: new Setting();

        $data = $request->except(['site_logo', 'site_favicon']);

        if ($request->hasFile('site_logo')) {
            if ($setting->site_logo) {
                Storage::disk('public')->delete($setting->site_logo);
            }
            $data['site_logo'] = $request->file('site_logo')->store('settings', 'public');
        }

        if ($request->hasFile('site_favicon')) {
            if ($setting->site_favicon) {
                Storage::disk('public')->delete($setting->site_favicon);
            }
            $data['site_favicon'] = $request->file('site_favicon')->store('settings', 'public');
        }

        if ($request->hasFile('site_signature')) {
            if ($setting->site_signature) {
                Storage::disk('public')->delete($setting->site_signature);
            }
            $data['site_signature'] = $request->file('site_signature')->store('settings', 'public');
        }

        if ($setting->id) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
