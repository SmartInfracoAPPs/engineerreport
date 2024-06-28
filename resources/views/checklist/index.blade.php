@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checklist for Task: {{ $task->task_description }}</h1>
    <a href="{{ route('checklist.create', $task->task_id) }}" class="btn btn-primary">Add Checklist Item</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($checklists as $checklist)
                <tr>
                    <td>{{ $checklist->checklist_id }}</td>
                    <td>{{ $checklist->checklist_item }}</td>
                    <td>{{ $checklist->status }}</td>
                    <td>
                        <a href="{{ route('checklist.edit', [$task->task_id, $checklist->checklist_id]) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('checklist.destroy', [$task->task_id, $checklist->checklist_id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
