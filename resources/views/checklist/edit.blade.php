@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Checklist Item for Task: {{ $task->task_description }}</h1>
    <form action="{{ route('checklist.update', [$task->task_id, $checklist->checklist_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="checklist_item">Checklist Item</label>
            <textarea name="checklist_item" class="form-control" required>{{ $checklist->checklist_item }}</textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" value="{{ $checklist->status }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
