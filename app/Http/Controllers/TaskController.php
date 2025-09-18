<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
   
    public function index()
    {
        $tasks = Task::with('documents')->orderBy('id','desc')->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

   
    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,completed',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048'
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'status' => $request->status,
            'user_id' => auth()->id()
        ]);

    
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $file->storeAs('tasks', $filename, 'public');

                $task->documents()->create([
                    'file_name' => $filename,
                    'original_name' => $file->getClientOriginalName()
                ]);
            }
        }

        return redirect()->route('tasks.index')
                         ->with('success', 'Task created successfully.');
    }

 
    public function edit(Task $task)
    {
        $task->load('documents');
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,completed',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048'
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'status' => $request->status,
        ]);

        // Add new documents if uploaded
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $file->storeAs('tasks', $filename, 'public');

                $task->documents()->create([
                    'file_name' => $filename,
                    'original_name' => $file->getClientOriginalName()
                ]);
            }
        }

        return redirect()->route('tasks.edit', $task->id)
                         ->with('success', 'Task updated successfully.');
    }


   public function destroy(TaskDocument $taskDocument)
{

    Storage::disk('public')->delete('tasks/' . $taskDocument->file_name);
    
 
    $taskDocument->delete();

 
    return response()->json([
        'success' => 'Document deleted successfully.'
    ], 200);
}
}
