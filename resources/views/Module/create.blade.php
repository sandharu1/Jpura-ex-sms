@extends('layouts.app')

@section('content')
<div class="container well course-create">
	<h2>Create Module</h2>
    <form action="{{ route('Module.store') }}" method="POST" role="form" enctype="multipart/form-data" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Module Name: </label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Module Name" value="{{ old('name') }}" required autofocus>
        </div>
               <div class="form-inline">

            <label for="module_id">Module ID: </label>
            <input type="text" class="form-control" name="module_id" id="module_id" placeholder="Module ID" value="{{ old('module_id') }}">

            <label for="programID">Program ID: </label>
            <select class="form-control" name="programID">
           @foreach($programs as $row)
            	<option value="{{$row->program_id}}">{{ $row->name}} : {{$row->program_id }}</option>
           @endforeach 
			</select>
			<br>
            <label for="credits">Credits: </label>
            <input type="number" class="form-control" name="credits" id="credits" placeholder="Credits" value="{{ old('credits') }}">

            <label for="year_commenced">Year Commenced: </label>
            <input type="text" class="form-control" name="year_commenced" id="year_commenced" placeholder="Year Commenced" value="{{ old('year_commenced') }}">
        </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>

@endsection