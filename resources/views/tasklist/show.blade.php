@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Task Details</h1>
    <div class="form-group">
        <label for="task_status">Task Status</label>
        <p>{{ $task->task_status }}</p>
    </div>
    <div class="form-group">
        <label for="field_engineer_id">Field Engineer</label>
        <p>{{ $task->fieldEngineer->username }}</p>
    </div>
    <div class="form-group">
        <label for="site_id">Site ID</label>
        <p>{{ $task->site_id }}</p>
    </div>
    <div class="form-group">
        <label for="task_description">Task Description</label>
        <p>{{ $task->task_description }}</p>
    </div>
    <a href="{{ route('tasklist.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
