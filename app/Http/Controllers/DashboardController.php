<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function index()
    {
        // Tasks counts
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'completed')->count();
        $pendingTasks = Task::where('status', 'pending')->count();

        // Total users
        $totalUsers = User::count();

        // Recent tasks
        $recentTasks = Task::orderBy('created_at', 'desc')->take(5)->get();

        // Pass data to blade
        return view('dashboard', compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'totalUsers',
            'recentTasks'
        ));
    }
}
