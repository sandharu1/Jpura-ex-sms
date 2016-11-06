@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <h3>Results</h3>

    <div class="col-md-6 col-sm-6">
    <h4>Insert Results Directly: <a class="btn btn-sm btn-success" href="{{ route('Marks.create', ['type'=>'1'])}}"> Insert Results </a></h4>
    <h4>Insert Results via CSV: <a class="btn btn-sm btn-success" href="{{ route('Marks.create', ['type'=>'2'])}}"> Import Results </a></h4></h4> 
    </div>
    <div class="col-md-6 col-sm-6">
    <h4>Delete Results using Program ID:</h4>
    <h4>Update & Delete Results using Student ID</h4>
    </div>

</div> {{-- end row --}}
<div class="row">
	<h3>Courses</h3>
	<div class="pull-right">
		<a class="btn btn-success" href="{{ route('Course.create')}}"> Add New Course</a>
	</div>
	<table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Program Name</th>
            <th>Program ID</th>
            <th>Credits</th>
            <th>Year Commenced</th>
            <th>Record Created</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($course as $key => $course)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $course->name }}</td>
        <td>{{ $course->program_id }}</td>
        <td>{{ $course->credits }}</td>
        <td>{{ $course->year_commenced }}</td>
        <td>{{ $course->created_at }}</td>
        <td>
            <div class="col-md-6">
            <a class="btn btn-primary btn-block btn-xs" href="{{ route('Course.edit',$course->program_id) }}">Edit</a>
            </div>
            <div class="col-md-6">
            <form method="POST" action="{{ route('Course.destroy', $course->program_id) }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger btn-block btn-xs">DELETE</button>
            </form>
            </div>
        </td>
    </tr>
    @endforeach
    </table>
	</div> {{-- row end --}}
	<div class="row">
	<h3>Modules</h3>
	<div class="pull-right">
		<a class="btn btn-success" href="{{ route('Module.create')}}"> Add New Module</a>
	</div>
        <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Module Name</th>
            <th>Module ID</th>
            <th>Program ID</th>
            <th>Credits</th>
            <th>Year Commenced</th>
            <th>Record Created</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($module as $key => $module)
    <tr>
        <td>{{ ++$ii }}</td>
        <td>{{ $module->name }}</td>
        <td>{{ $module->module_id }}</td>
        <td>{{ $module->programID }}</td>
        <td>{{ $module->credits }}</td>
        <td>{{ $module->year_commenced }}</td>
        <td>{{ $module->created_at }}</td>
        <td>
            <div class="col-md-6">
            <a class="btn btn-primary btn-block btn-xs" href="{{ route('Module.edit',$module->module_id) }}">Edit</a>
            </div>
            <div class="col-md-6">
            <form method="POST" action="{{ route('Module.destroy', $module->module_id) }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger btn-block btn-xs">DELETE</button>
            </form>
            </div>
        </td>
    </tr>
    @endforeach
    </table>
	</div> {{-- module row end --}}

</div>
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