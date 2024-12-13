@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Item</h1>
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $item->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if ($item->image)
                    <img src="{{ asset('storage/images/' . basename($item->image)) }}" width="50" alt="image"
                        style="width:50%">
                @endif

            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
