<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Add Task') }}</h2>
</x-slot>

<div class="py-12">
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

    <div class="mb-4">
        <a href="{{ route('tasks.index') }}" class="text-indigo-600 hover:underline">&larr; Back to Tasks</a>
    </div>

    <div class="bg-white shadow rounded p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Add Task</h2>

        <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2">
                    @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label>Deadline <span class="text-red-500">*</span></label>
                    <input type="date" name="deadline" value="{{ old('deadline') }}" class="w-full border rounded px-3 py-2">
                    @error('deadline') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label>Priority <span class="text-red-500">*</span></label>
                    <select name="priority" class="w-full border rounded px-3 py-2">
                        <option value="low" {{ old('priority')=='low'?'selected':'' }}>Low</option>
                        <option value="medium" {{ old('priority')=='medium'?'selected':'' }}>Medium</option>
                        <option value="high" {{ old('priority')=='high'?'selected':'' }}>High</option>
                    </select>
                    @error('priority') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label>Status <span class="text-red-500">*</span></label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <option value="pending" {{ old('status')=='pending'?'selected':'' }}>Pending</option>
                        <option value="completed" {{ old('status')=='completed'?'selected':'' }}>Completed</option>
                    </select>
                    @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="col-span-2">
                    <label>Description <span class="text-red-500">*</span></label>
                    <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="col-span-2">
                    <label>Attach Documents</label>
                    <input type="file" name="documents[]" multiple class="w-full border rounded px-3 py-2">
                    @error('documents.*') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Task</button>
        </form>
    </div>

</div>
</div>

@if(session('success'))
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: "{{ session('success') }}",
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif
</x-app-layout>
