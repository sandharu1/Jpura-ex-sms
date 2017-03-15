@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
        {{-- <div id="particles-js" class="particles-back"></div> --}}
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
        <table class="table table-responsive table-hover">
            <thead>
                <tr class="info">
                    <th>Programme Code</th>
                    <th>Major</th>
                    <th>Type</th>
                    <th>Number of Years</th>
                    <th>Year Commenced</th>
                    <th>Student Status</th>
                    <th>Award GPA</th>
                    <th>Award Creadits</th>
                    <th>Award Classification</th>
                    <th>Award Date</th>
                </tr>
            </thead>
            <tbody>
            {{-- @foreach($stdProgramme as $key => $proSammary) --}}
                <tr>
                    <td>{{ $stdProgramme->course->program_id }}</td>
                    <td>{{ $stdProgramme->course->name }}</td>
                    <td>{{ $stdProgramme->batchType }}</td>
                    <td>{{ $stdProgramme->noStages }}</td>
                    <td>{{ $stdProgramme->yearCommenced }}</td>
                    <td>{{ $ovrlSummary [3] }}</td>
                    <td>{{ round($ovrlSummary [1],2) }}</td>
                    @if($ovrlSummary [3] == "Complete")
                    <td>{{ $stdProgramme->course->credits }}</td>
                    @else
                    <td>-</td>
                    @endif
                    <td>{{ $ovrlSummary [2] }}</td>
                    @if($ovrlSummary [3] == "Complete")
                    <td>{{ date_format($finalAwardDate->created_at, 'd-m-Y') }}</td>
                    @else
                    <td>-</td>
                    @endif

                </tr>
            {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
</div> {{-- end row --}}
<div class="row">
    <div class="container">
    <h3>Overall Results Summary</h3>
        <table class="table table-responsive table-hover">
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
    @foreach($ovrlSummary [0] as $sammary)
        <tr>
            <td>{{ $sammary['stageAcaYear'] }}</td>
            <td>{{ $stdProgramme->programID }}</td>
            <td>{{ $stdProgramme->course->name }}</td>
            <td>{{ $sammary['stage'] }}</td>
            <td>{{ $sammary['stageStatus'] }}</td>
            <td>{{ round($sammary['stageGpa'],2) }}</td>
            <td>{{ $sammary['awardClassify'] }}</td>
            <td>{{ round($sammary['finalAwardGpa'],2) }}</td>
            <td>-</td>
        </tr>
    @endforeach
    </tbody>
</table>
    </div>
</div> {{-- end second row --}}
<div class="row">
    <div class="container">
        <h3>Module Details</h3>
        <table class="table table-responsive table-hover">
            <thead>
                <tr class="info">
                    <th>Module</th>
                    <th>Title</th>
                    <th>Grade</th>
                    <th>Credit Value</th>
                    <th>GPA</th>
                    <th>Attempt</th>
                    <th>Stage</th>
                    <th>Pro. ID</th>
                </tr>
            </thead>
            <tbody>
            @foreach($moduleMarks as $key => $moduleMarks)
                <tr>
                    <td>{{ $moduleMarks->moduleID }}</td>
                    <td>{{ $moduleMarks->module->name }}</td>
                    <td>{{ $moduleMarks->grade }}</td>
                    <td>{{ $moduleMarks->credit }}</td>
                    <td>{{ $moduleMarks->gpa }}</td>
                    <td>{{ $moduleMarks->attempt }}</td>
                    <td>{{ $moduleMarks->year }}</td>
                    <td>{{ $moduleMarks->module->programID }}</td>
                </tr>
              </tbody>       
            @endforeach

        </table>
    </div>
</div> {{-- end row --}}
</div> {{-- end container --}}

@endsection