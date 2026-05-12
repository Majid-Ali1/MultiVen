@extends('layouts.admin')

@section('page_title', 'Vendor Management')

@section('admin_content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-black text-gray-900">Registered Vendors</h2>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl font-semibold text-sm">✓ {{ session('success') }}</div>
    @endif

    <form method="GET" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search vendor name or email…"
            class="flex-grow border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition-colors">Search</button>
        <a href="{{ route('admin.vendors.index') }}" class="px-5 py-2 bg-gray-100 text-gray-600 text-sm font-bold rounded-xl hover:bg-gray-200 transition-colors">Reset</a>
    </form>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-50 bg-gray-50/50">
                        <th class="pb-3 pt-4 px-6 font-bold">Shop / Vendor</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Email</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Status</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Products</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Joined</th>
                        <th class="pb-3 pt-4 px-6 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($vendors as $vendor)
                        <tr class="text-sm hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                        {{ substr($vendor->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $vendor->name }}</p>
                                        <p class="text-xs text-gray-400">Professional Seller</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-gray-600">{{ $vendor->email }}</td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 rounded-full text-[10px] font-black uppercase {{ $vendor->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                    {{ $vendor->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-bold text-gray-900">
                                {{ \App\Models\Product::where('vendor_id', $vendor->id)->count() }}
                            </td>
                            <td class="py-4 px-6 text-gray-500 text-xs">{{ $vendor->created_at->format('M d, Y') }}</td>
                            <td class="py-4 px-6 text-right">
                                @if($vendor->status === 'active')
                                    <form action="{{ route('admin.vendors.suspend', $vendor) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 text-xs font-bold bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-100 transition-colors">Suspend</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.vendors.activate', $vendor) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 text-xs font-bold bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors">Activate</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-12 text-center text-gray-400">No vendors found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($vendors->hasPages())
            <div class="p-6 border-t border-gray-50">{{ $vendors->links() }}</div>
        @endif
    </div>
</div>
@endsection
