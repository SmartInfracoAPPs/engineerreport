@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Checklist Item for Task: {{ $task->task_description }}</h1>
    <form action="{{ route('checklist.store', $task->task_id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="checklist_item">Checklist Item</label>
            <textarea name="checklist_item" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
