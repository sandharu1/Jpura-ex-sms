@extends('layouts.app')

@section('content')
<div class="container well course-create">
	<h2>Create Program</h2>
    <form action="{{ route('Course.store') }}" method="POST" role="form" enctype="multipart/form-data" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Program Name: </label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Program Name" value="{{ old('name') }}" required autofocus>
        </div>
               <div class="form-inline">

            <label for="program_id">Program ID: </label>
            <input type="text" class="form-control" name="program_id" id="program_id" placeholder="Program ID" value="{{ old('program_id') }}">

            <label for="credits">Credits: </label>
            <input type="number" class="form-control" name="credits" id="credits" placeholder="Credits" value="{{ old('credits') }}">

            <label for="year_commenced">Year Commenced: </label>
            <input type="text" class="form-control" name="year_commenced" id="year_commenced" placeholder="Year Commenced" value="{{ old('year_commenced') }}">
        </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>
@endsection