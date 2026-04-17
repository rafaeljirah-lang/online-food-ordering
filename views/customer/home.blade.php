@extends('layouts.app')

@section('title', 'Home - FoodHub')

@section('content')
<!-- Hero Section -->
<div class="bg-dark text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-4">Welcome to FoodHub</h1>
        <p class="text-xl mb-8">Order your favorite food online and get it delivered to your doorstep</p>
        <a href="{{ route('customer.menu') }}" class="inline-block bg-primary px-8 py-3 rounded-lg text-lg font-semibold hover:opacity-90 transition">
            Order Now
        </a>
    </div>
</div>

<!-- Features Section -->
<div class="container mx-auto px-4 py-16">
    <div class="grid md:grid-cols-3 gap-8">
        <div class="text-center p-6">
            <div class="w-16 h-16 bg-primary rounded-full mx-auto mb-4 flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-2 text-dark">Fast Delivery</h3>
            <p class="text-gray-600">Get your food delivered quickly to your doorstep</p>
        </div>

        <div class="text-center p-6">
            <div class="w-16 h-16 bg-primary rounded-full mx-auto mb-4 flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-2 text-dark">Quality Food</h3>
            <p class="text-gray-600">Freshly prepared meals with the finest ingredients</p>
        </div>

        <div class="text-center p-6">
            <div class="w-16 h-16 bg-primary rounded-full mx-auto mb-4 flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-2 text-dark">Easy Ordering</h3>
            <p class="text-gray-600">Simple and secure online ordering process</p>
        </div>
    </div>
</div>

<!-- Popular Items -->
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12 text-dark">Popular Items</h2>
        <div class="grid md:grid-cols-4 gap-6">
            @foreach($popularItems ?? [] as $item)
            <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">No Image</span>
                </div>
                @endif
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2 text-dark">{{ $item->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($item->description, 60) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-primary font-bold text-xl">${{ number_format($item->price, 2) }}</span>
                        <a href="{{ route('customer.menu.show', $item->id) }}" class="bg-primary text-white px-4 py-2 rounded hover:opacity-90 transition text-sm">
                            Order
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('customer.menu') }}" class="inline-block bg-dark text-white px-8 py-3 rounded-lg hover:opacity-90 transition">
                View Full Menu
            </a>
        </div>
    </div>
</div>
@endsection
