<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tasklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index($taskId)
    {
        $task = Tasklist::findOrFail($taskId);
        $images = Image::where('task_id', $taskId)->get();
        return view('images.index', compact('task', 'images'));
    }

    public function create($taskId)
    {
        $task = Tasklist::findOrFail($taskId);
        return view('images.create', compact('task'));
    }

    public function store(Request $request, $taskId)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        $image = new Image();
        $image->task_id = $taskId;
        $image->image_url = $path;
        $image->save();

        return redirect()->route('images.index', $taskId)->with('success', 'Image uploaded successfully.');
    }

    public function destroy($taskId, $id)
    {
        $image = Image::findOrFail($id);
        Storage::disk('public')->delete($image->image_url);
        $image->delete();

        return redirect()->route('images.index', $taskId)->with('success', 'Image deleted successfully.');
    }
}
