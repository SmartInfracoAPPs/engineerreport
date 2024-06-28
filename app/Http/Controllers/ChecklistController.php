<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Tasklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function index($taskId)
    {
        $task = Tasklist::findOrFail($taskId);
        $checklists = Checklist::where('task_id', $taskId)->get();
        return view('checklist.index', compact('task', 'checklists'));
    }

    public function create($taskId)
    {
        $task = Tasklist::findOrFail($taskId);
        return view('checklist.create', compact('task'));
    }

    public function store(Request $request, $taskId)
    {
        $request->validate([
            'checklist_item' => 'required|string',
            'status' => 'required|string|max:50',
        ]);

        $checklist = new Checklist($request->all());
        $checklist->task_id = $taskId;
        $checklist->save();

        return redirect()->route('checklist.index', $taskId)->with('success', 'Checklist item added successfully.');
    }

    public function edit($taskId, $id)
    {
        $task = Tasklist::findOrFail($taskId);
        $checklist = Checklist::findOrFail($id);
        return view('checklist.edit', compact('task', 'checklist'));
    }

    public function update(Request $request, $taskId, $id)
    {
        $request->validate([
            'checklist_item' => 'required|string',
            'status' => 'required|string|max:50',
        ]);

        $checklist = Checklist::findOrFail($id);
        $checklist->update($request->all());

        return redirect()->route('checklist.index', $taskId)->with('success', 'Checklist item updated successfully.');
    }

    public function destroy($taskId, $id)
    {
        $checklist = Checklist::findOrFail($id);
        $checklist->delete();

        return redirect()->route('checklist.index', $taskId)->with('success', 'Checklist item deleted successfully.');
    }
}
