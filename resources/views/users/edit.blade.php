<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('users.index') }}" class="text-indigo-600 hover:underline">&larr; Back to Users</a>
            </div>

            <!-- Edit User Form -->
            <div class="bg-white shadow rounded p-6 mb-6">
                <h2 class="text-xl font-bold mb-4">Edit User</h2>

                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-4">

                        <!-- Name -->
                        <div>
                            <label class="block text-gray-700 mb-1">Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" 
                                placeholder="Enter name" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror" 
                                placeholder="Enter email" required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-gray-700 mb-1">Password 
                                <span class="text-gray-500 text-sm">(leave blank to keep current)</span>
                            </label>
                            <input type="password" name="password" 
                                class="w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror" 
                                placeholder="Enter new password">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-gray-700 mb-1">Confirm Password</label>
                            <input type="password" name="password_confirmation" 
                                class="w-full border rounded px-3 py-2" 
                                placeholder="Confirm password">
                        </div>

                        <!-- Role -->
                        <div>
                            <label class="block text-gray-700 mb-1">Role</label>
                            <select name="role" 
                                class="w-full border rounded px-3 py-2 @error('role') border-red-500 @enderror" 
                                required>
                                <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
                                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                                <option value="manager" {{ $user->role=='manager'?'selected':'' }}>Manager</option>
                            </select>
                            @error('role')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Save User
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
