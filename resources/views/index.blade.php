@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
@endif

<div class="container">
    <h1>Todos</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todos as $todo)
                <tr>
                    <td>{{ $todo->title }}</td>
                    <td>{{ $todo->completed ? 'Completed' : 'Pending' }}</td>
                    <td>
                        <a href="{{ route('edit', $todo->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="openDeleteConfirmation({{ $todo->id }})">Delete</button>
                        <button class="btn btn-info btn-sm" onclick="openDetailModal('{{ $todo->title }}', '{{ $todo->description }}', '{{ $todo->completed ? 'Completed' : 'Pending' }}')">Show Details</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form method="GET" action="{{ route('create')}}">
        @csrf
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this todo?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirm Deletion</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Todo Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Todo Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Title:</strong> <span id="detailTitle"></span></p>
                <p><strong>Description:</strong> <span id="detailDescription"></span></p>
                <p><strong>Status:</strong> <span id="detailStatus"></span></p>
            </div>
        </div>
    </div>
</div>

<script>
    function openDeleteConfirmation(todoId) {
        var deleteForm = document.getElementById('deleteForm');
        deleteForm.action = '{{ route("destroy", ":id") }}'.replace(':id', todoId);
        $('#deleteConfirmationModal').modal('show');
    }

    function openDetailModal(title, description, status) {
        $('#detailTitle').text(title);
        $('#detailDescription').text(description);
        $('#detailStatus').text(status);
        $('#detailModal').modal('show');
    }
</script>
@endsection
