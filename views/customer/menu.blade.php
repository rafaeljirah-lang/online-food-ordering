@extends('layouts.app')

@section('title', 'Menu - FoodHub')

@section('content')
<div class="bg-dark text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold">Our Menu</h1>
        <p class="mt-2">Choose from our delicious selection</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Filter/Search Section -->
    <div class="mb-8">
        <form method="GET" action="{{ route('customer.menu') }}" class="flex gap-4">
            <input type="text" name="search" placeholder="Search menu items..." 
                   value="{{ request('search') }}"
                   class="flex-1 px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none">
            <select name="category" class="px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none">
                <option value="">All Categories</option>
                @foreach($categories ?? [] as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:opacity-90 transition">
                Filter
            </button>
        </form>
    </div>

    <!-- Menu Items Grid -->
    <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($menuItems ?? [] as $item)
        <div class="bg-white border-2 border-gray-200 rounded-lg overflow-hidden hover:border-primary transition">
            @if($item->image)
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-400">No Image</span>
            </div>
            @endif
            
            <div class="p-4">
                <h3 class="font-bold text-lg mb-2 text-dark">{{ $item->name }}</h3>
                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $item->description }}</p>
                
                <div class="flex justify-between items-center mb-3">
                    <span class="text-primary font-bold text-xl">${{ number_format($item->price, 2) }}</span>
                    @if(!$item->is_available)
                    <span class="text-red-500 text-sm font-semibold">Out of Stock</span>
                    @endif
                </div>

                @auth
                <form action="{{ route('customer.cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                    <div class="flex gap-2 mb-3">
                        <input type="number" name="quantity" value="1" min="1" 
                               class="w-20 px-2 py-1 border-2 border-gray-300 rounded focus:border-primary focus:outline-none">
                        <button type="submit" 
                                class="flex-1 bg-primary text-white px-4 py-2 rounded hover:opacity-90 transition {{ !$item->is_available ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ !$item->is_available ? 'disabled' : '' }}>
                            Add to Cart
                        </button>
                    </div>
                </form>
                @else
                <a href="{{ route('login') }}" class="block text-center bg-dark text-white px-4 py-2 rounded hover:opacity-90 transition">
                    Login to Order
                </a>
                @endauth
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <p class="text-gray-500 text-lg">No menu items found.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(isset($menuItems) && $menuItems->hasPages())
    <div class="mt-8">
        {{ $menuItems->links() }}
    </div>
    @endif
</div>
@endsection
