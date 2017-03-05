@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="row">
    <div class="container">
        <div class="col-xs-8 col-sm-8 col-md-8">
            {{-- user basic details --}}
            <h2 class="text-center">Basic Info</h2>
            <blockquote>
                <p><strong>Name: </strong>{{ $stdInfo->name }}</p>
                <p><strong>NIC: </strong>{{ $stdInfo->nic }}</p>
                <p><strong>Email: </strong>{{ $stdInfo->email }}</p>
                <p><strong>Batch: </strong>{{ $stdInfo->batch }}</p>
                <p><strong>Register No (ID): </strong>{{ $stdInfo->reg_number }}</p>
                <p><strong>Res. Tel: </strong>{{ $stdInfo->res_tel }}</p>
                <p><strong>Mobile Tel: </strong>{{ $stdInfo->mobile_tel }}</p>
                <p><strong>Permenant Address: </strong>{{ $stdInfo->address }}</p>
                <p><strong>Recode Created: </strong>{{ $stdInfo->created_at }}</p>
            </blockquote>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            {{-- user profile image --}}
            {{-- <h2>Profile pic</h2> --}}
            <br>
            <br>
            <br>
            <br>
            <img src="{{asset('upload/'.$stdInfo->std_pic_name)}}" height="180" width="150" class="img-thumbnail img-responsive center-block"><br><br>
            <a href="{{ route('Student.index') }}" class="btn btn-info btn-block">Back</a>
            <a href="{{route('Student.edit', $stdInfo->nic)}}" class="btn btn-warning btn-block">Update</a>
            <form method="POST" action="{{ route('Student.destroy', $stdInfo->nic) }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                {{-- <input name="_method" type="hidden" value="DELETE"> --}}
                <button type="submit" class="btn btn-danger btn-block">DELETE</button>
            </form>
            {{-- <a href="{{ route('Student.destroy', $id=$stdInfo->nic) }}" class="btn btn-danger btn-block">Delete</a> --}}
        </div>

    </div>
    <hr>
</div> {{-- end first row --}}
<div class="row">
    <div class="container">
    <h3>Programme Summary</h3>
        <table class="table table-responsive">
            <thead>
                <tr class="info">
                    <th>Academic Year</th>
                    <th>Full/Part Time</th>
                    <th>Level Description</th>
                    <th>Student Status</th>
                    <th>Year</th>
                    <th>Programme code</th>
                    <th>Major</th>
                    <th>Award Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div> {{-- end row --}}
<div class="row">
    <div class="container">
    <h3>Overall Results Summary</h3>
        <table class="table table-responsive">
    <thead>
        <tr class="info">
            <th>Accademic Year</th>
            <th>Programme</th>
            <th>Major</th>
            <th>Stage</th>
            <th>Status</th>
            <th>Stage GPA(Current)</th>
            <th>Award Classification</th>
            <th>Award GPA</th>
            <th>Award Date</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td>John</td>
            <td>Carter</td>
            <td>johncarter@mail.com</td>
            <td>1</td>
            <td>John</td>
            <td>Carter</td>
            <td>3.2</td>
            <td>2016-05-20</td>
        </tr>
    </tbody>
</table>
    </div>
</div> {{-- end second row --}}
<div class="row">
    <div class="container">
        <h3>Module Details</h3>
        <table class="table table-responsive">
            <thead>
                <tr class="info">
                    <th>Semester</th>
                    <th>Module</th>
                    <th>Title</th>
                    <th>Credit Value</th>
                    <th>Stage</th>
                    <th>Type</th>
                    <th>Grade</th>
                    <th>Pro. ID</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div> {{-- end row --}}


@endsection