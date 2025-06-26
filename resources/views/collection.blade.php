@extends('layouts.app')

@section('content')
<div class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-10 text-center">Explore Our Collection</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($images as $slug => $data)
                <a href="{{ route('collection.category', $slug) }}"
                   class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    @if ($data['image'])
                        <img src="{{ $data['image'] }}" alt="{{ $data['label'] }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                            No image
                        </div>
                    @endif
                    <div class="p-4 text-center font-semibold text-gray-800">{{ $data['label'] }}</div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
