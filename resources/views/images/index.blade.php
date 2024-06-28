@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Images for Task: {{ $task->task_description }}</h1>
    <a href="{{ route('images.create', $task->task_id) }}" class="btn btn-primary">Upload Image</a>
    <div class="row mt-4">
        @foreach ($images as $image)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $image->image_url) }}" class="card-img-top" alt="Task Image">
                    <div class="card-body">
                        <form action="{{ route('images.destroy', [$task->task_id, $image->image_id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
