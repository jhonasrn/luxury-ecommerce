@extends('layouts.app')

@section('content')
<div class="bg-white py-16 px-6 max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Help Center</h1>

    <p class="text-gray-700 leading-relaxed mb-4">
        Need support? You've come to the right place. Below are some of the most common topics our customers ask about. Can't find what you're looking for? Reach out to our team.
    </p>

    <ul class="list-disc pl-6 text-gray-700 mb-4 space-y-2">
        <li><a href="{{ url('/policies/shipping-returns') }}" class="text-indigo-600 hover:underline">Shipping & Returns</a></li>
        <li><a href="{{ url('/policies/privacy') }}" class="text-indigo-600 hover:underline">Privacy Policy</a></li>
        <li><a href="{{ url('/policies/terms') }}" class="text-indigo-600 hover:underline">Terms of Service</a></li>
        <li><a href="mailto:support@luxora-retail.com" class="text-indigo-600 hover:underline">Contact Support</a></li>
    </ul>

    <p class="text-gray-700">We're here to help Monday–Friday, 9am to 5pm PST.</p>
</div>
@endsection
