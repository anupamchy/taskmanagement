@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f4f7fb;
    }

    .edit-task-wrapper {
        min-height: 100vh;
    }

    .edit-card {
        border: none;
        border-radius: 28px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        box-shadow:
            0 15px 40px rgba(0, 0, 0, 0.08);
    }

    .edit-header {
        background: linear-gradient(135deg,
                #4f46e5,
                #7c3aed);
        padding: 30px;
        color: white;
        position: relative;
    }

    .edit-header::before {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        top: -80px;
        right: -50px;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 5px;
        position: relative;
        z-index: 2;
    }

    .page-subtitle {
        opacity: 0.9;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    .form-wrapper {
        padding: 35px;
    }

    .custom-input {
        height: 54px;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        padding: 0 18px;
        transition: 0.3s ease;
        font-size: 15px;
    }

    textarea.custom-input {
        min-height: 130px;
        padding-top: 14px;
    }

    .custom-input:focus {
        border-color: #6366f1;
        box-shadow:
            0 0 0 5px rgba(99, 102, 241, 0.12);
    }

    .form-label {
        font-weight: 700;
        margin-bottom: 10px;
        color: #111827;
    }

    .modern-btn {
        border: none;
        border-radius: 16px;
        padding: 14px 24px;
        font-weight: 700;
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
            0 12px 24px rgba(79, 70, 229, 0.25);
        color: white;
    }

    .btn-light-modern {
        background: #eef2ff;
        color: #4f46e5;
    }

    .btn-light-modern:hover {
        background: #dbeafe;
        color: #4338ca;
    }

    .form-section {
        background: #f8fafc;
        border-radius: 20px;
        padding: 25px;
        border: 1px solid #eef2f7;
    }

    .top-icon {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        font-size: 28px;
    }
</style>

<div class="container py-5 edit-task-wrapper">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="edit-card">

                <!-- HEADER -->
                <div class="edit-header">

                    <div class="top-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>

                    <h1 class="page-title">
                        Edit Task
                    </h1>

                    <p class="page-subtitle">
                        Update your task details and keep your workflow organized.
                    </p>

                </div>

<!-- BODY -->
                <div class="form-wrapper">

<div class="form-section">

<form action="{{ route('tasks.update',$task) }}" method="POST">

@csrf
                            @method('PUT')

@include('tasks.form')

<!-- BUTTONS -->
                            <div class="d-flex gap-3 mt-4 flex-wrap">
                            
                                <button type="submit" class="btn modern-btn btn-gradient">
                            
                                    <i class="bi bi-check-circle"></i>
                            
                                    Update Task
                            
                                </button>
                            
                                <a href="{{ route('tasks.index') }}" class="btn modern-btn btn-light-modern">
                            
                                    <i class="bi bi-arrow-left"></i>
                            
                                    Back to Tasks
                            
                                </a>
                            
                            </div>
</form>

</div>
                    
                    </div>
                    
                    </div>
                    
                    </div>
    </div>

</div>

@endsection