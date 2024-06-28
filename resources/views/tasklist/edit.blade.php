@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Task</h1>
    <form action="{{ route('tasklist.update', $task->task_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="task_status">Task Status</label>
            <input type="text" name="task_status" class="form-control" value="{{ $task->task_status }}" required>
        </div>
        <div class="form-group">
            <label for="field_engineer_id">Field Engineer</label>
            <input type="number" name="field_engineer_id" class="form-control" value="{{ $task->field_engineer_id }}" required>
        </div>
        <div class="form-group">
            <label for="site_id">Site ID</label>
            <input type="text" name="site_id" class="form-control" value="{{ $task->site_id }}" required>
        </div>
        <div class="form-group">
            <label for="task_description">Task Description</label>
            <textarea name="task_description" class="form-control" required>{{ $task->task_description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
