<div class="bg-white rounded shadow w-[150px] text-xs overflow-hidden">
    <img 
        src="{{ $product->primaryImage->url }}" 
        alt="{{ $product->name }}" 
        class="w-full h-[96px] object-cover"
        loading="lazy"
    >

    <div class="p-2">
        <h4 class="font-semibold text-gray-800 truncate">{{ $product->name }}</h4>
        <p class="text-gray-500 truncate">{{ $product->category }}</p>
        <p class="text-rose-600 font-bold mt-1">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
    </div>
</div>
