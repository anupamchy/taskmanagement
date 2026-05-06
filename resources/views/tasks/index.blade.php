@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f4f7fb;
    }

    .task-wrapper {
        min-height: 100vh;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: #111827;
        margin: 0;
    }

    .modern-btn {
        border: none;
        border-radius: 14px;
        padding: 12px 22px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-gradient {
        background: linear-gradient(135deg,
                #4f46e5,
                #7c3aed);
        color: white;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow:
            0 10px 25px rgba(79, 70, 229, 0.25);
        color: white;
    }

    .filter-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 24px;
        padding: 24px;
        box-shadow:
            0 10px 30px rgba(0, 0, 0, 0.06);
        margin-bottom: 30px;
        border: none;
    }

    .custom-input {
        height: 52px;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        padding: 0 16px;
        transition: 0.3s ease;
    }

    .custom-input:focus {
        border-color: #6366f1;
        box-shadow:
            0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .task-table-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow:
            0 10px 30px rgba(0, 0, 0, 0.06);
    }

    .table {
        margin: 0;
    }

    .table thead {
        background: linear-gradient(135deg,
                #111827,
                #1f2937);
        color: white;
    }

    .table thead th {
        border: none;
        padding: 18px;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table tbody td {
        padding: 20px 18px;
        vertical-align: middle;
        border-color: #f1f5f9;
    }

    .table tbody tr {
        transition: 0.3s ease;
    }

    .table tbody tr:hover {
        background: #f8fafc;
    }

    .task-title {
        font-weight: 600;
        color: #111827;
    }

    .status-badge {
        padding: 8px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.15);
        color: #d97706;
    }

    .status-completed {
        background: rgba(34, 197, 94, 0.15);
        color: #16a34a;
    }

    .action-btn {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s ease;
    }

    .edit-btn {
        background: rgba(245, 158, 11, 0.12);
        color: #d97706;
    }

    .edit-btn:hover {
        background: #f59e0b;
        color: white;
        transform: translateY(-2px);
    }

    .delete-btn {
        background: rgba(239, 68, 68, 0.12);
        color: #dc2626;
    }

    .delete-btn:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-2px);
    }

    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state i {
        font-size: 60px;
        color: #cbd5e1;
        margin-bottom: 15px;
    }

    .pagination {
        margin-top: 25px;
        justify-content: center;
    }

    .pagination .page-link {
        border: none;
        margin: 0 4px;
        border-radius: 12px;
        color: #4f46e5;
        font-weight: 600;
    }

    .pagination .active .page-link {
        background: #4f46e5;
        color: white;
    }
</style>

<div class="container py-5 task-wrapper">

    <!-- HEADER -->
    <div class="page-header">

        <div>

            <h1 class="page-title">
                Task Dashboard
            </h1>

            <p class="text-muted mb-0">
                Manage your daily workflow efficiently
            </p>

        </div>

        <a href="{{ route('tasks.create') }}" class="btn modern-btn btn-gradient">

            <i class="bi bi-plus-circle"></i>
            Add New Task

</a>

</div>

<!-- FILTER -->
<div class="filter-card">

    <form method="GET" class="row g-3">

        <div class="col-lg-5">

            <input type="text" name="search" class="form-control custom-input" placeholder="Search tasks...">

</div>

<div class="col-lg-4">

    <select name="status" class="form-select custom-input">

<option value="">
    All Status
</option>

<option value="pending">
    Pending
</option>

<option value="completed">
    Completed
</option>

</select>

</div>

<div class="col-lg-3">

    <button class="btn modern-btn btn-gradient w-100 h-100">

        <i class="bi bi-funnel"></i>
        Apply Filter

    </button>

</div>

</form>

</div>

<!-- TASK TABLE -->
<div class="task-table-card">
<div class="table-responsive">

<table class="table align-middle">

<thead>

<tr>
<th>
    Task Title
</th>

<th>
    Status
</th>

<th>
    Due Date
</th>

<th width="150">
    Actions
</th>

</tr>

</thead>

<tbody>

@forelse($tasks as $task)

<tr>

<td>

    <div class="task-title">
        {{ $task->title }}
    </div>

</td>

<td>
<span class="status-badge
                                {{ $task->status == 'completed'
                                    ? 'status-completed'
                                    : 'status-pending' }}">

    {{ $task->status }}

</span>

</td>

<td>

    <span class="text-muted">

        <i class="bi bi-calendar-event"></i>

        {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}

    </span>

</td>

<td>

<div class="d-flex gap-2">

    <!-- EDIT -->
    <a href="{{ route('tasks.edit',$task) }}" class="action-btn edit-btn">

        <i class="bi bi-pencil-square"></i>

    </a>

<!-- DELETE -->
<form action="{{ route('tasks.destroy',$task) }}" method="POST" class="d-inline">

@csrf
@method('DELETE')

<button class="action-btn delete-btn" onclick="return confirm('Delete this task?')">

    <i class="bi bi-trash"></i>

</button>

</form>

</div>
</td>

</tr>

@empty

<tr>
<td colspan="4">

    <div class="empty-state">

        <i class="bi bi-inboxes"></i>

        <h4 class="fw-bold">
            No Tasks Found
</h4>

<p class="text-muted">
    Start by creating your first task.
</p>

</div>
</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

<!-- PAGINATION -->
<div class="mt-4">
{{ $tasks->links() }}

</div>

</div>
@endsection