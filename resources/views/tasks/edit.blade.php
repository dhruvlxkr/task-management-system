<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Task') }}</h2>
</x-slot>

<div class="py-12">
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

    <div class="mb-4">
        <a href="{{ route('tasks.index') }}" class="text-indigo-600 hover:underline">&larr; Back to Tasks</a>
    </div>

    <div class="bg-white shadow rounded p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Edit Task</h2>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <!-- Title -->
                <div>
                    <label>Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $task->title) }}" class="w-full border rounded px-3 py-2">
                    @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Deadline -->
                <div>
                    <label>Deadline <span class="text-red-500">*</span></label>
                    <input type="date" name="deadline" value="{{ old('deadline', $task->deadline) }}" class="w-full border rounded px-3 py-2">
                    @error('deadline') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Priority -->
                <div>
                    <label>Priority <span class="text-red-500">*</span></label>
                    <select name="priority" class="w-full border rounded px-3 py-2">
                        <option value="low" {{ $task->priority=='low'?'selected':'' }}>Low</option>
                        <option value="medium" {{ $task->priority=='medium'?'selected':'' }}>Medium</option>
                        <option value="high" {{ $task->priority=='high'?'selected':'' }}>High</option>
                    </select>
                    @error('priority') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div>
                    <label>Status <span class="text-red-500">*</span></label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <option value="pending" {{ $task->status=='pending'?'selected':'' }}>Pending</option>
                        <option value="completed" {{ $task->status=='completed'?'selected':'' }}>Completed</option>
                    </select>
                    @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <label>Description <span class="text-red-500">*</span></label>
                    <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $task->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Upload documents -->
                <div class="col-span-2">
                    <label>Upload New Documents</label>
                    <input type="file" name="documents[]" multiple class="w-full border rounded px-3 py-2">
                    @error('documents.*') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Existing documents -->
                <div class="col-span-2 mt-4">
                    <h3 class="font-semibold mb-2">Existing Documents</h3>
                    <div id="documents-container">
                        @forelse($task->documents as $doc)
                            <div class="flex justify-between items-center border p-2 mb-2 rounded" id="doc-{{ $doc->id }}">
                                <a href="{{ route('task-documents.download', $doc->id) }}" class="text-blue-600">{{ $doc->original_name }}</a>
                                <button 
                                    class="text-red-600 hover:underline delete-document" 
                                    data-id="{{ $doc->id }}" 
                                    data-url="{{ route('task-documents.destroy', $doc->id) }}"
                                >Delete</button>
                            </div>
                        @empty
                            <p class="text-gray-500">No documents attached</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Task</button>
        </form>
    </div>

</div>
</div>

<!-- JS Section -->
<script src="//cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function(){

  $('#documents-container').on('click', '.delete-document', function(e){
    e.preventDefault();
    let docId = $(this).data('id');
    let url = $(this).data('url');
    let token = '{{ csrf_token() }}';

    Swal.fire({
        title: 'Are you sure?',
        text: "This document will be deleted permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if(result.isConfirmed){
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {_token: token},
                dataType: 'json',
                success: function(response){
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: response.success,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        // Page reload after deletion
                        location.reload();
                    });
                },
                error: function(xhr){
                    Swal.fire('Error!', 'Something went wrong!', 'error');
                }
            });
        }
    });
});
});
</script>
</x-app-layout>
