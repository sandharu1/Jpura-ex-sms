@extends('layouts.app')

@section('content')
<div class="container well course-create">
	<h2>Update Program</h2>
    <form action="{{ route('Course.update', $program->program_id) }}" method="POST" role="form" enctype="multipart/form-data" accept-charset="UTF-8">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group">
            <label for="name">Program Name: </label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Program Name" value="{{ $program->name }}" required autofocus>
        </div>
               <div class="form-inline form-group">

            <label for="program_id">Program ID: </label>
            <input type="text" class="form-control" name="program_id" id="program_id" placeholder="Program ID" value="{{ $program->program_id }}">

            <label for="credits">Credits: </label>
            <input type="number" class="form-control" name="credits" id="credits" placeholder="Credits" value="{{ $program->credits }}">
            </div>
            <div class="form-inline form-group">
            <label for="year_commenced">Year Commenced: </label>
            <input type="text" class="form-control" name="year_commenced" id="year_commenced" placeholder="Year Commenced" value="{{ $program->year_commenced }}">
        </div>
                <button type="submit" class="btn btn-warning" style="width: 100px;">Update</button>
        </form>
</div>

@endsection