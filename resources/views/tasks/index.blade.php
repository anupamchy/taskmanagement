@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Tasks</h3>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        Add Task
    </a>
</div>

<form method="GET" class="row mb-3">

    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search">
    </div>

    <div class="col-md-3">
        <select name="status" class="form-control">

            <option value="">All</option>

            <option value="pending">
                Pending
            </option>

            <option value="completed">
                Completed
            </option>

        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-dark w-100">
            Filter
        </button>
    </div>

</form>

<div class="table-responsive">

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Due Date</th>
                <th width="180">Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse($tasks as $task)

            <tr>

                <td>{{ $task->title }}</td>

                <td>
                    <span class="badge bg-success">
                        {{ $task->status }}
                    </span>
                </td>

                <td>{{ $task->due_date }}</td>

                <td>

                    <a href="{{ route('tasks.edit',$task) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('tasks.destroy',$task) }}" method="POST" class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="4" class="text-center">
                    No Tasks Found
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

{{ $tasks->links() }}

@endsection