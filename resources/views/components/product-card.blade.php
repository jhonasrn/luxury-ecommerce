<a href="{{ route('product.show', $product->slug) }}" class="block">
    <div class="bg-white rounded shadow text-sm overflow-hidden w-full max-w-xs mx-auto hover:shadow-md transition duration-200">
        @if ($product->primaryImage)
            <img 
                src="{{ $product->primaryImage->url }}" 
                alt="{{ $product->name }}" 
                class="w-full h-40 object-cover"
                loading="lazy"
            >
        @else
            <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-400">
                No image
            </div>
        @endif

        <div class="p-3">
            <h4 class="font-semibold text-gray-800 truncate">{{ $product->name }}</h4>
            <p class="text-gray-500 truncate">{{ $product->category }}</p>
            <p class="text-rose-600 font-bold mt-1">
                R$ {{ number_format($product->price, 2, ',', '.') }}
            </p>
        </div>
    </div>
</a>
