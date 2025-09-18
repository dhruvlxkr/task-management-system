<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tasks') }}</h2>
</x-slot>

<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class="mb-4 flex justify-end">
        <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Add Task</a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <table id="tasks-table" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Deadline</th>
                        <th class="px-6 py-3 text-left">Priority</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Documents</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tasks as $task)
                    <tr id="task-{{ $task->id }}">
                        <td class="px-6 py-4">{{ $task->title }}</td>
                        <td class="px-6 py-4">{{ $task->deadline }}</td>
                        <td class="px-6 py-4 capitalize">{{ $task->priority }}</td>
                        <td class="px-6 py-4 capitalize">{{ $task->status }}</td>
                        <td class="px-6 py-4">
                            @forelse($task->documents as $doc)
                                <a href="{{ route('task-documents.download', $doc->id) }}" target="_blank" class="text-blue-600">{{ $doc->original_name }}</a><br>
                            @empty
                                <span class="text-gray-500">No documents</span>
                            @endforelse
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-green-600 hover:underline">Edit</a> |
                            <button 
                                type="button" 
                                class="text-red-600 hover:underline delete-task" 
                                data-id="{{ $task->id }}"
                                data-url="{{ route('tasks.destroy', $task->id) }}"
                            >Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>

</div>
</div>

<!-- JS -->
<script src="//cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {

    $('.delete-task').click(function(e){
        e.preventDefault();
        let taskId = $(this).data('id');
        let url = $(this).data('url');
        let token = '{{ csrf_token() }}';

        Swal.fire({
            title: 'Are you sure?',
            text: "This task will be deleted permanently!",
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
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#task-' + taskId).remove();
                    },
                    error: function(xhr){
                        Swal.fire('Error!', 'Something went wrong!', 'error');
                    }
                });
            }
        });
    });

    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
    @endif

});
</script>
</x-app-layout>
