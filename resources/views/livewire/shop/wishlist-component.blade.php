<div>
    <button wire:click="toggleWishlist"
        class="absolute top-2 right-2 z-10 w-8 h-8 rounded-full bg-white/90 dark:bg-gray-800/90 flex items-center justify-center shadow hover:scale-110 transition">
        {{-- if already in wishlist --}}
        @if($isUserLiked)
            <i class="fa-solid fa-heart text-red-500 text-sm"></i>
        @else
            <i class="fa-regular fa-heart text-gray-600 dark:text-gray-300 text-sm"></i>
        @endif
    </button>
</div>