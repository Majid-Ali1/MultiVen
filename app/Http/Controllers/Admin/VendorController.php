<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Notifications\StatusUpdate;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $vendorRole = Role::where('slug', 'vendor')->first();
        $query = User::where('role_id', $vendorRole->id);

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        $vendors = $query->latest()->paginate(20)->withQueryString();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function suspend(User $vendor)
    {
        $vendor->update(['status' => 'suspended']);
        $vendor->notify(new StatusUpdate(
            'Vendor Account Suspended',
            "Your vendor account has been suspended. Please contact support for more information.",
            url('/suspended')
        ));
        return back()->with('success', "Vendor {$vendor->name} has been suspended.");
    }

    public function activate(User $vendor)
    {
        $vendor->update(['status' => 'active']);
        $vendor->notify(new StatusUpdate(
            'Vendor Account Activated',
            "Congratulations! Your vendor account has been activated. You can now start listing products.",
            url('/vendor/dashboard')
        ));
        return back()->with('success', "Vendor {$vendor->name} has been activated.");
    }
}
