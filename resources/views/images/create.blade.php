@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upload Image for Task: {{ $task->task_description }}</h1>
    <form action="{{ route('images.store', $task->task_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
