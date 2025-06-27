@extends('layouts.app')

@section('content')
<div class="bg-white">

    {{-- Hero --}}
    <div class="relative">
        <img src="https://plus.unsplash.com/premium_photo-1728582543415-f3acc737f1fe?q=80&w=1600&auto=format&fit=crop"
             alt="Hero"
             class="w-full h-[500px] object-cover brightness-75">
        <div class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-white text-4xl md:text-5xl font-bold tracking-wide">Our Story</h1>
        </div>
    </div>

    {{-- Section 1 --}}
    <section class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Where It All Began</h2>
            <p class="text-gray-700 text-lg leading-relaxed">
                Luxora was born in a sunlit garage in San Diego in 2015. Two friends — one a fashion enthusiast, the other a minimalist designer — set out to create accessories that blend elegance with everyday function. What started with hand-packed sunglasses has grown into a global lifestyle brand.
            </p>
        </div>
        <img src="https://plus.unsplash.com/premium_photo-1661645478022-88ecb1de0b2f?q=80&w=800&auto=format&fit=crop"
             alt="Founders"
             class="rounded-lg shadow-lg w-full h-auto">
    </section>

    {{-- Section 2 --}}
    <section class="bg-gray-50 py-20">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <img src="https://images.unsplash.com/photo-1693960794591-fc7c72a15e9f?q=80&w=800&auto=format&fit=crop"
                 alt="Design"
                 class="rounded-lg shadow-lg w-full h-auto">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Design That Speaks</h2>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Our products are crafted with intention — from the brushed edge of a watch strap to the grain of vegetable-tanned leather. Every detail is considered. Every silhouette is timeless. Our Portland-based design team obsesses over every sketch to bring you accessories that feel personal.
                </p>
            </div>
        </div>
    </section>

    {{-- Section 3 --}}
    <section class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Built to Last</h2>
            <p class="text-gray-700 text-lg leading-relaxed">
                We believe in small-batch production, ethical sourcing, and quality that endures. Every clasp, stitch, and buckle is tested and refined. We don’t just sell accessories — we deliver pieces that become part of your story.
            </p>
        </div>
        <img src="https://images.unsplash.com/photo-1688744478584-f7b40ce4fe1a?q=80&w=800&auto=format&fit=crop"
             alt="Craft"
             class="rounded-lg shadow-lg w-full h-auto">
    </section>

    {{-- Section 4 --}}
    <section class="bg-gray-50 py-20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <img src="https://images.unsplash.com/photo-1587492797458-47c2c0558b88?q=80&w=800&auto=format&fit=crop"
                 alt="Team"
                 class="rounded-lg shadow-lg mx-auto mb-8 w-full max-w-2xl">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Looking Ahead</h2>
            <p class="text-gray-700 text-lg leading-relaxed">
                As we grow, we’re investing in sustainable materials, expanding our global reach, and building a community that values intention and expression. Luxora isn’t just a brand — it’s a movement.
            </p>
        </div>
    </section>

</div>
@endsection
