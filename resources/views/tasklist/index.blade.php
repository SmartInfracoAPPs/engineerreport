@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Task List</h1>
    <a href="{{ route('tasklist.create') }}" class="btn btn-primary">Create New Task</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Field Engineer</th>
                <th>Site ID</th>
                <th>Task Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->task_id }}</td>
                    <td>{{ $task->task_status }}</td>
                    <td>{{ $task->fieldEngineer->username }}</td>
                    <td>{{ $task->site_id }}</td>
                    <td>{{ $task->task_description }}</td>
                    <td>
                        <a href="{{ route('tasklist.show', $task->task_id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('tasklist.edit', $task->task_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('tasklist.destroy', $task->task_id) }}" method="POST" style="display:inline;">
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
