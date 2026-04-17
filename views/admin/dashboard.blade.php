@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Today's Orders</p>
            <p class="text-2xl font-bold mt-1">{{ $todayOrders }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Today's Revenue</p>
            <p class="text-2xl font-bold text-blue-600 mt-1">${{ number_format($todaySales, 2) }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Pending Orders</p>
            <p class="text-2xl font-bold mt-1">{{ $pendingOrders }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Total Menu Items</p>
            <p class="text-2xl font-bold mt-1">{{ $totalMenuItems }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Total Customers</p>
            <p class="text-xl font-semibold">{{ $totalCustomers }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Total Orders</p>
            <p class="text-xl font-semibold">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Total Revenue</p>
            <p class="text-xl font-semibold">${{ number_format($totalRevenue, 2) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="bg-white border border-gray-200 rounded-xl p-4 xl:col-span-1">
            <h2 class="font-semibold mb-3">Popular Menu Items</h2>
            <div class="space-y-2">
                @forelse($popularItems as $item)
                    <div class="flex items-center justify-between text-sm border border-gray-100 rounded-lg px-3 py-2">
                        <span>{{ $item->name }}</span>
                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">{{ $item->order_items_count }} orders</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No data available.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-4 xl:col-span-2">
            <h2 class="font-semibold mb-3">Recent Orders</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="py-2">Order ID</th>
                            <th class="py-2">Customer</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Total</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr class="border-b border-gray-100">
                                <td class="py-2">#{{ $order->id }}</td>
                                <td class="py-2">{{ $order->user->name ?? 'Guest' }}</td>
                                <td class="py-2">
                                    <span class="text-xs px-2 py-1 rounded-full
                                        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="py-2">${{ number_format($order->total_amount, 2) }}</td>
                                <td class="py-2">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:underline">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-4 text-gray-500">No recent orders.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
