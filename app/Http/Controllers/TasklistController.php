<?php

namespace App\Http\Controllers;

use App\Models\Tasklist;
use Illuminate\Http\Request;

class TasklistController extends Controller
{
    public function index()
    {
        $tasks = Tasklist::with('fieldEngineer', 'checklists', 'images')->get();
        return view('tasklist.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasklist.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_status' => 'required|string|max:50',
            'field_engineer_id' => 'required|integer|exists:users,id',
            'site_id' => 'required|string|max:255',
            'task_description' => 'required|string',
        ]);

        Tasklist::create($request->all());
        return redirect()->route('tasklist.index')->with('success', 'Task created successfully.');
    }

    public function show($id)
    {
        $task = Tasklist::with('fieldEngineer', 'checklists', 'images')->findOrFail($id);
        return view('tasklist.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Tasklist::findOrFail($id);
        return view('tasklist.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'task_status' => 'required|string|max:50',
            'field_engineer_id' => 'required|integer|exists:users,id',
            'site_id' => 'required|string|max:255',
            'task_description' => 'required|string',
        ]);

        $task = Tasklist::findOrFail($id);
        $task->update($request->all());
        return redirect()->route('tasklist.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Tasklist::findOrFail($id);
        $task->delete();
        return redirect()->route('tasklist.index')->with('success', 'Task deleted successfully.');
    }
}
