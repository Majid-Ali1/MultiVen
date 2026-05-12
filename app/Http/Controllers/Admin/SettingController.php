<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->get('tab', 'general');
        
        $settings = [
            'site_name' => Setting::get('site_name', 'MultiVen Platform'),
            'support_email' => Setting::get('support_email', 'support@multiven.com'),
            'commission_rate' => Setting::get('commission_rate', 10),
            'currency' => Setting::get('currency', 'USD'),
            'maintenance_mode' => Setting::get('maintenance_mode', false),
            'theme_color' => Setting::get('theme_color', '#4f46e5'),
            'min_payout' => Setting::get('min_payout', 50),
            'require_vendor_approval' => Setting::get('require_vendor_approval', true),
            'registration_enabled' => Setting::get('registration_enabled', true),
        ];
        
        return view('admin.settings.index', compact('settings', 'activeTab'));
    }

    public function update(Request $request)
    {
        $activeTab = $request->get('tab', 'general');

        $rules = [
            'general' => [
                'site_name' => 'required|string|max:255',
                'support_email' => 'required|email|max:255',
                'currency' => 'required|string|size:3',
            ],
            'appearance' => [
                'theme_color' => 'required|string|regex:/^#[a-fA-F0-9]{6}$/',
            ],
            'marketplace' => [
                'commission_rate' => 'required|numeric|min:0|max:100',
                'min_payout' => 'required|numeric|min:0',
                'maintenance_mode' => 'nullable',
            ],
            'security' => [
                'require_vendor_approval' => 'nullable',
                'registration_enabled' => 'nullable',
            ],
        ];

        $validated = $request->validate($rules[$activeTab] ?? []);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        if ($activeTab === 'marketplace') {
            Setting::set('maintenance_mode', $request->has('maintenance_mode'));
        }

        if ($activeTab === 'security') {
            Setting::set('require_vendor_approval', $request->has('require_vendor_approval'));
            Setting::set('registration_enabled', $request->has('registration_enabled'));
        }

        return redirect()->route('admin.settings.index', ['tab' => $activeTab])->with('success', 'Settings updated successfully!');
    }
}
