@extends('layouts.app')

@section('content')

{{-- ==== Insert Resultz Directly===== --}}
@if( $type == '1')
<div class="container well course-create">
	<h2 class="text-center">Insert Marks</h2>
  <br>
  <form action="{{ route('Marks.store', ['type'=>'1']) }}" method="POST" role="form" enctype="multipart/form-data" accept-charset="UTF-8">
    {{ csrf_field() }}
    <div class="form-group form-inline">
      <label>Student NIC: </label>
      <input type="text" class="form-control" name="nic" placeholder="Student NIC" value="{{ old('nic') }}" required autofocus>
      <label for="student_id">Student ID: </label>
      <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Student ID" value="{{ old('student_id') }}" required autofocus>
    </div>
    <div class="form-group form-inline">
      <label for="moduleID">Module: </label>
      <select class="form-control" name="moduleID">
       @foreach($modules as $row)
       <option value="{{$row->module_id}}">{{ $row->name}} : {{$row->module_id }}</option>
       @endforeach 
     </select>
     <label for="mark">Marks: </label>
     <input type="number" class="form-control" id="mark" name="mark" placeholder="Module Marks" value="{{ old('mark') }}" required autofocus>
    </div>
    <div class="form-group form-inline">
      <label for="grade">Grade: </label>
      <input type="grade" class="form-control" id="grade" name="grade" placeholder="Student Grade" value="{{ old('grade') }}" required autofocus>
      <label for="attempt">Attempt: </label>
      <input type="number" class="form-control" id="attempt" name="attempt" placeholder="Attempt" value="{{ old('attempt') }}" required autofocus>
      <label for="year">Year: </label>
      <input type="number" class="form-control" id="year" name="year" placeholder=Year" value="{{ old('year') }}" required autofocus>
    </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

{{-- ====Import results from Data sheet===== --}}

@elseif($type = '2')
<div class="container">
  <div class="row">
    <div class="container well course-create">
      <h3>Import Results From Data Sheet</h3><small>(.xmls and .csv files)</small>
      <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('Marks.store', ['type'=>'2']) }}" class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
        {{ csrf_field() }}
        <input type="file" name="import_file" />
        <button class="btn btn-primary">Import File</button>
      </form>
    </div>
  </div>
</div>
@endif
@endsection