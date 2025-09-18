<!-- resources/views/layouts/navigation.blade.php -->

<nav class="bg-white border-b shadow px-4 py-3 flex justify-between items-center">
    <!-- Left side -->
    <div>
        <h1 class="text-lg font-bold"></h1>
    </div>

    <!-- Right side: User Dropdown -->
    <div class="relative" x-data="{ open: false }">
        <!-- Trigger -->
        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
            <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown -->
        <div x-show="open" @click.outside="open = false"
             class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg z-50">
            {{-- <a href="{{ route('profile.edit') }}" 
               class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a> --}}
            
            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Alpine.js (for dropdown toggle) -->
<script src="//unpkg.com/alpinejs" defer></script>
