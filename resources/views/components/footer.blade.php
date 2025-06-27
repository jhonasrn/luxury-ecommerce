<footer class="bg-gray-900 text-gray-300 text-sm mt-16">
    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
        <div>
            <h3 class="text-white text-base font-semibold mb-4">Company</h3>
            <p class="mb-2">Luxora Retail Inc.</p>
            <p class="mb-2">1234 Market Street, Suite 500</p>
            <p class="mb-2">San Francisco, CA 94103</p>
            <p class="mb-2">United States</p>
            <p class="mb-2">Phone: +1 (415) 555-0198</p>
            <p>Email: support@luxora-retail.com</p>
        </div>

        <div>
            <h3 class="text-white text-base font-semibold mb-4">Sitemap</h3>
            <ul class="space-y-2">
                <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                <li><a href="{{ route('collection') }}" class="hover:underline">Collection</a></li>
                <li><a href="{{ route('bag.index') }}" class="hover:underline">Shopping Bag</a></li>
                <li><a href="{{ route('orders.index') }}" class="hover:underline">My Orders</a></li>
                <li><a href="{{ route('profile.edit') }}" class="hover:underline">Profile</a></li>
            </ul>
        </div>

<div>
    <h3 class="text-white text-base font-semibold mb-4">Customer Support</h3>
    <ul class="space-y-2">
        <li><a href="{{ url('/about') }}" class="hover:underline">About</a></li>
        <li><a href="{{ route('policies.shipping') }}" class="hover:underline">Shipping & Returns</a></li>
        <li><a href="{{ route('policies.privacy') }}" class="hover:underline">Privacy Policy</a></li>
        <li><a href="{{ route('policies.terms') }}" class="hover:underline">Terms of Service</a></li>
        <li><a href="{{ route('help') }}" class="hover:underline">Help Center</a></li>
    </ul>
</div>


        <div>
            <h3 class="text-white text-base font-semibold mb-4">Follow Us</h3>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-white">Instagram</a>
                <a href="#" class="hover:text-white">Facebook</a>
                <a href="#" class="hover:text-white">Twitter</a>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-700 text-center py-6 text-xs text-gray-500">
        © {{ date('Y') }} Luxora Retail Inc. All rights reserved.
    </div>
</footer>
