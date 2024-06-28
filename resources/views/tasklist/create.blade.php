@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Task</h1>
    <form action="{{ route('tasklist.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="task_status">Task Status</label>
            <input type="text" name="task_status" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="field_engineer_id">Field Engineer</label>
            <input type="number" name="field_engineer_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="site_id">Site ID</label>
            <input type="text" name="site_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="task_description">Task Description</label>
            <textarea name="task_description" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
