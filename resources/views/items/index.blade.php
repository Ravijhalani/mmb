@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <h1>Items</h1>
    <a href="{{ route('items.create') }}" class="btn btn-primary">Create Item</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td><img src="{{ asset('storage/images/' . basename($item->image)) }}" width="50" alt="image"></td>
                <td>
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline" id="delete-form-{{ $item->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $item->id }})">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $items->links() }}
</div>

<script>
    function confirmDelete(itemId) {
        // Show a confirmation dialog
        if (confirm('Are you sure you want to delete this item?')) {
            // If confirmed, submit the form to delete the item
            document.getElementById('delete-form-' + itemId).submit();
        }
    }
</script>
@endsection
