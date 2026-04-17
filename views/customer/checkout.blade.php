@extends('layouts.app')

@section('title', 'Checkout - FoodHub')

@section('content')
<div class="bg-dark text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold">Checkout</h1>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <form action="{{ route('customer.order.place') }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Delivery Information -->
            <div class="md:col-span-2">
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-4 text-dark">Delivery Information</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-dark font-semibold mb-2">Full Name</label>
                            <input type="text" name="name" required 
                                   class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none"
                                   value="{{ auth()->user()->name }}">
                        </div>

                        <div>
                            <label class="block text-dark font-semibold mb-2">Phone Number</label>
                            <input type="tel" name="phone" required 
                                   class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none"
                                   value="{{ auth()->user()->phone ?? '' }}">
                        </div>

                        <div>
                            <label class="block text-dark font-semibold mb-2">Delivery Address</label>
                            <textarea name="address" rows="3" required 
                                      class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none">{{ auth()->user()->address ?? '' }}</textarea>
                        </div>

                        <div>
                            <label class="block text-dark font-semibold mb-2">Special Instructions (Optional)</label>
                            <textarea name="notes" rows="2" 
                                      class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none"
                                      placeholder="Any special requests for your order..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-4 text-dark">Payment Method</h2>
                    
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-primary transition">
                            <input type="radio" name="payment_method" value="cash" checked class="w-5 h-5 text-primary">
                            <span class="ml-3 font-semibold text-dark">Cash on Delivery</span>
                        </label>

                        <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-primary transition">
                            <input type="radio" name="payment_method" value="card" class="w-5 h-5 text-primary">
                            <span class="ml-3 font-semibold text-dark">Credit/Debit Card</span>
                        </label>

                        <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-primary transition">
                            <input type="radio" name="payment_method" value="online" class="w-5 h-5 text-primary">
                            <span class="ml-3 font-semibold text-dark">Online Payment</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="md:col-span-1">
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 sticky top-4">
                    <h3 class="text-2xl font-bold mb-4 text-dark">Order Summary</h3>
                    
                    <div class="space-y-3 mb-6">
                        @php
                            $total = 0;
                        @endphp
                        @foreach(session('cart', []) as $details)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">{{ $details['name'] }} x{{ $details['quantity'] }}</span>
                            <span class="text-dark font-semibold">${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                        </div>
                        @php
                            $total += $details['price'] * $details['quantity'];
                        @endphp
                        @endforeach

                        <div class="border-t-2 border-gray-200 pt-3">
                            <div class="flex justify-between text-gray-600 mb-2">
                                <span>Subtotal</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600 mb-3">
                                <span>Delivery Fee</span>
                                <span>$50.00</span>
                            </div>
                            <div class="flex justify-between font-bold text-lg text-dark">
                                <span>Total</span>
                                <span class="text-primary">${{ number_format($total + 50, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:opacity-90 transition">
                        Place Order
                    </button>

                    <a href="{{ route('customer.cart') }}" class="block w-full text-center text-dark px-6 py-3 rounded-lg mt-3 border-2 border-gray-300 hover:border-primary transition">
                        Back to Cart
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
