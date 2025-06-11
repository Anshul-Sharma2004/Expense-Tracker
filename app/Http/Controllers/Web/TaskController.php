<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller {
    public function index() {
        $tasks = Task::where('user_id', Auth::id())->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request) {
        $request->validate(['title' => 'required|string']);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title
        ]);

        return redirect()->route('tasks.show', Task::latest()->first()->id);
    }

    public function show($id) {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);
        return view('tasks.show', compact('task'));
    }
}

