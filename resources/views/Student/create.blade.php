@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <h1>Register New Student</h1>

    <form action="{{ route('Student.store') }}" method="POST" role="form" enctype="multipart/form-data" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name: </label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
        </div>
        <div class="form-inline">
            <label for="nic">NIC: </label>
            <input type="text" class="form-control" id="nic" name="nic" placeholder="NIC Number" value="{{ old('nic') }}">
            {{--  </div>
	  <div class="form-inline"> --}}
            <label for="reg_number">Reg. No: </label>
            <input type="text" class="form-control" id="reg_number" name="reg_number" placeholder="Registration Number" value="{{ old('reg-no') }}">
            {{--  </div>
	  <div class="form-inline"> --}}
            <label for="batch">Batch: </label>
            <select class="form-control" id="batch" name="batch" value="{{ old('batch') }}">
                <option>CN13-1</option>
                <option>CS13-1</option>
                <option>MBA-B03</option>
            </select>
        </div>

        <br>
        <div class="form-inline">

            <label for="res_tel">Res. Tel: </label>
            <input type="number" class="form-control" name="res_tel" id="res_tel" placeholder="Residence Telephone" value="{{ old('res-tel') }}">

            <label for="mobile_tel">Mobile Tel: </label>
            <input type="number" class="form-control" name="mobile_tel" id="mobile_tel" placeholder="Mobile Telephone" value="{{ old('mobile-tel') }}">

            <label for="email">Email: </label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}">
        </div>
        <br>
        <div class="form-group">
            <label for="address">Address: </label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Permenant Address" value="{{ old('name') }}" required autofocus>
        </div>
        <br>
        <div class="form-group">
            <label for="stdsnap">Student Picture</label>
            <input type="file" class="form-control" name="stdsnap" id="stdsnap">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

</div>
@endsection