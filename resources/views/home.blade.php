@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <div class="panel-body">
                      <h1>Student</h1>
                      <p class="lead">You can add new student, edit student details, delete student, view student details and student resultz by search.</p>

                      <a href="Student" class="btn btn-info">Go Student Section</a>
                    </div>
                    <hr>
                    <div class="panel-body">
                      <h1>Lecturer</h1>
                      <p class="lead">You ca add new lecturer, edit lecturer details, delete lecturer and view lecturer details.</p>
                      
                      <a href="Lecturer" class="btn btn-info">Go Lecturer Section</a>
                    </div>
                    <hr>
                    <div class="panel-body">
                      <h1>Course & Marks</h1>
                      <p class="lead">You ca add new lecturer, edit lecturer details, delete lecturer and view lecturer details.</p>
                      
                      <a href="Course" class="btn btn-info">Go Course & Marks Section</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
