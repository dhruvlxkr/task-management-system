<?php

namespace App\Http\Controllers;

use App\Models\TaskDocument;
use Illuminate\Support\Facades\Storage;

class TaskDocumentController extends Controller
{
    // Download single document
    public function download(TaskDocument $taskDocument)
    {
        return Storage::disk('public')->download(
            'tasks/' . $taskDocument->file_name,
            $taskDocument->original_name
        );
    }

    // Delete single document
    public function destroy(TaskDocument $taskDocument)
    {
        Storage::disk('public')->delete('tasks/' . $taskDocument->file_name);
        $taskDocument->delete();

        return back()->with('success', 'Document deleted successfully.');
    }
}
