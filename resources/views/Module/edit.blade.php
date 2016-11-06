@extends('layouts.app')

@section('content')
<div class="container well course-create">
	<h2>Update Module</h2>
    <form action="{{ route('Module.update', $moduleTable->module_id) }}" method="POST" role="form" enctype="multipart/form-data" accept-charset="UTF-8">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group">
            <label for="name">Module Name: </label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Module Name" value="{{ $moduleTable->name }}" required autofocus>
        </div>
               <div class="form-inline form-group">

            <label for="module_id">Module ID: </label>
            <input type="text" class="form-control" name="module_id" id="module_id" placeholder="Module ID" value="{{ $moduleTable->module_id }}">

            <label for="programID">Program ID: </label>
            <select class="form-control" name="programID">
           @foreach($programs as $row)
            	<option value="{{$row->program_id}}">{{ $row->name}} : {{$row->program_id }}</option>
           @endforeach 
			</select>
            </div>
			<div class="form-inline form-group">
            <label for="credits">Credits: </label>
            <input type="number" class="form-control" name="credits" id="credits" placeholder="Credits" value="{{ $moduleTable->credits }}">

            <label for="year_commenced">Year Commenced: </label>
            <input type="text" class="form-control" name="year_commenced" id="year_commenced" placeholder="Year Commenced" value="{{ $moduleTable->year_commenced }}">
        </div>

                <button type="submit" class="btn btn-warning" style="width: 100px;">Submit</button>
        </form>
</div>

@endsection