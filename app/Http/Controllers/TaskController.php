<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return Inertia::render('SidebarMenu/ToDoList', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'status' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Task::create([
            'name' => $request->name,
            'status' => $request->status,
            'user_id' => auth()->user()->id,
            'category_id' => 5,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:20', // Add validation as needed
        ]);

        $task->update($request->all());

        return redirect()->back();
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }
}
