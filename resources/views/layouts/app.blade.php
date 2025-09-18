<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Task Manager') }}</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- jQuery + DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="font-sans antialiased bg-gray-100">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-indigo-600 to-indigo-700 text-white shadow-lg min-h-screen flex flex-col">
        <div class="p-6 flex items-center space-x-3 border-b border-indigo-500">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="w-10 h-10 rounded-full">
            <span class="text-2xl font-bold">Task Manager</span>
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-500 transition duration-200">
                <i data-feather="home" class="mr-3 w-5"></i>
                Dashboard
            </a>

            <a href="{{ route('tasks.index') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-500 transition duration-200">
                <i data-feather="check-square" class="mr-3 w-5"></i>
                Tasks
            </a>

            <a href="{{ route('users.index') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-500 transition duration-200">
                <i data-feather="users" class="mr-3 w-5"></i>
                Users
            </a>
        </nav>
    </aside>

   
    <div class="flex-1 flex flex-col">

    
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-700">{{ $header ?? 'Dashboard' }}</h1>

           
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex items-center space-x-2 hover:text-indigo-600 transition duration-200 focus:outline-none">
                    <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

          
                <div x-show="open" @click.away="open = false"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                   
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-100 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

  
        <main class="flex-1 p-6 bg-gray-100">
            {{ $slot }}
        </main>

        <footer class="bg-white shadow p-4 text-center text-gray-600">
            © {{ date('Y') }} Task Manager. All rights reserved. By Developer Dharmendra Laxkar
        </footer>

    </div>
</div>


<script>
    feather.replace()
</script>

</body>
</html>
