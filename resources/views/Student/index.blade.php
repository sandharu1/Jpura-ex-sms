@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <h1>Student Dash Board</h1>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, possimus, ullam? Deleniti dicta eaque facere, facilis in inventore mollitia officiis porro totam voluptatibus! Adipisci autem cumque enim explicabo, iusto sequi.</p>
</div>
<div class="container">
    <blockquote>
        <p>Register new student on system.</p>
    </blockquote>
    <a href="{{ route('Student.create') }}" class="btn btn-info">Add Student</a>
    <hr>
</div>
<div class="container">
    <blockquote>
        <p>Enter student NIC number to View, Update or Delete info.</p>
    </blockquote>

    <form action="{{ url('/getformdata') }}" method="POST" role="form" enctype="multipart/form-data" accept-charset="UTF-8">
        {{ csrf_field() }}
        <input type="text" name="nic" placeholder="Student NIC" value="{{ old('nic') }}" required>
        <button type="submit" class="btn btn-success btn-sm">View Student Details</button>
        {{-- <a type="submit" value="edit" class="btn btn-warning">Update Student</a>
    <a type="submit" value="delete" class="btn btn-danger">Delete Student</a> --}}
    </form> 
</div>

@if(null !== $id = Session::get('nic'))
{{redirect()->route('Student.show', $id)->send() }}
{{var_dump($id->nic)}}
@endif


{{-- create student sucsess message --}}
@if ($message = Session::get('success'))
<div class="container">
    <div class="alert alert-success" role="alert">
        <p>{{ $message }}</p>
    </div>
</div>
@endif
@if ($message = Session::get('unsuccess'))
<div class="container">
    <div class="alert alert-danger" role="alert">
        <p>{{ $message }}</p>
    </div>
</div>
@endif

@endsection