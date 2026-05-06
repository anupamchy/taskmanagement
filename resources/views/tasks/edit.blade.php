@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-body">

        <h3>Edit Task</h3>

        <form action="{{ route('tasks.update',$task) }}" method="POST">

            @csrf
            @method('PUT')

            @include('tasks.form')

        </form>

    </div>

</div>

@endsection