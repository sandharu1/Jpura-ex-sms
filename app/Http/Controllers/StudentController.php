<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Student;
use App\Marks;
use App\Courses;
use App\Modules;
use App\Batch;
use App\Perstage;
use File;

class StudentController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('Student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('Student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // var_dump($request->stdsnap);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'stdsnap' => 'required',
            ]);

        $stdNIC = $request->nic;
        $imageName = $stdNIC . '.' . $request->stdsnap->getClientOriginalExtension();
        // var_dump($stdNIC);
        // var_dump($imageName);
        $photo = $request->stdsnap;
        $photo->move(public_path('upload'), $imageName);
        $request->request->add(['std_pic_name' => $imageName]);
        Student::create($request->all());
        return redirect()->route('Student.index')
        ->with('success', 'Student created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
       /*           
        Getting Student Basic Infomation
        */
        $stdInfo = Student::where('nic', '=', $id)->first();
          //var_dump($stdInfo);
        /* 
        Getting Student related module list
        */
        $moduleMarks = Marks::with('module')
        ->where('student_id', '=', $stdInfo->reg_number)
        ->orderBy('year','ASC')
        ->get();
         //var_dump($moduleMarks);
        /* 
        Getting Degree Award Date by DESC oder from create_at.
         */
        $finalAwardDate = Marks::with('module')
        ->where('student_id', '=', $stdInfo->reg_number)
        ->orderBy('created_at','DESC')
        ->first();
        /* 
        Getting programm id, using batchID  //need to change 'first' method to multiple programes.
         */
        $stdProgramme = Batch::with('course')
        ->where('batchID', '=', $stdInfo->batch)
        ->first();
         // var_dump($stdProgramme);
         /*
         Getting all modules related to program
         */
         $listModules = Modules::where('programID', '=', $stdProgramme->programID)
         ->get();
         // var_dump($listModules);

        /*
         Call Overall Summary funtion
         */
         $ovrlSummary = $this->stageOverall($stdInfo->reg_number, $stdInfo->batch, $stdProgramme->noStages);
         // var_dump($ovrlSummary);
         /*
         Pass all data to Student show blade
         */
         if (isset($stdInfo)) {
            return view('Student.show', compact('stdInfo','moduleMarks','stdProgramme', 'ovrlSummary', 'finalAwardDate'));
        } else {
            return redirect()->route('Student.index')
            ->with('unsuccess', 'Student not found. Check NIC agin.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $infoEdit = Student::where('nic', '=', $id)->first();
        return view('Student.edit', compact('infoEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            ]);
        $stdUpdate = Student::where('nic', '=', $id)->first();
        $stdUpdate->update($request->all());
        return redirect()->route('Student.index')
        ->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $stdInfoDelete = Student::where('nic', '=', $id)->first();
        var_dump($stdInfoDelete);
        $filePic = public_path('upload/' . $stdInfoDelete->std_pic_name);
        var_dump($filePic);
        File::delete($filePic);
        File::exists($filePic);
        $stdInfoDelete->delete();
        return redirect()->route('Student.index')
        ->with('success', 'Student deleted successfully');
    }

    //optional requrement method
    //
    public function studentid(Request $request) {
        // var_dump($request->all());
        $this->validate($request, [
            'nic' => 'required',
            ]);
        $nic = $request->nic;
        return $this->show($nic);
    }

    
    public function stageOverall($stdID, $stdBatch, $noStages){
        $sumGpa = 0;
        $i = 0;
        $stageOverall = array();
        $proFinalGpa = "-";
        $proFinalClassify = "-";
        $proFinalStatus = "-";
        $overallStage = Perstage::where('batch_id', '=', $stdBatch)->get();
        // var_dump($overallStage);
        foreach ($overallStage as $key => $value) {
        /*
        Calculate Stage GPA
         */
        $stageGpa = Marks::where('student_id', '=', $stdID)
        ->where('year', '=', $value->stage_no)
        ->avg('gpa');
        /* 
         Calculate Stage Status (complete or pending)
        */
         $stageCredit = Marks::where('student_id', '=', $stdID)
         ->where('year', '=', $value->stage_no)
         ->sum('credit');
        // var_dump($stageCredit);
        // //Get Repeat module count
         $stageRcount = Marks::where('student_id', '=', $stdID)
         ->where('year', '=', $value->stage_no)
         ->where('credit', '=', 0)
         ->count('credit');
         // var_dump($stageRcount);
         $stageTotCredits = Perstage::where('batch_id', '=', $stdBatch)
         ->where('stage_no', '=', $value->stage_no)
         ->first();
        // var_dump($stageTotCredits->totcredits);

         if ($stageCredit == $stageTotCredits->totcredits && $stageRcount == 0 ) {
            $stageStatus = "Complete";
            $i++;
        }elseif($stageCredit == $stageTotCredits->totcredits && $stageRcount >= 1){
            $stageStatus = "Complete(R)";
            $i++;
        }elseif($stageCredit <= $stageTotCredits->totcredits && $stageRcount >= 1){
            $stageStatus = "Pending(R)";
        }else{
            $stageStatus = "Pending";
        }
         /*
          Get Stage academic year
          */
          $stageAcaYear = $stageTotCredits->academicYear;
         /*
         Calculate Award GPA and Award Classification
         */ 
         $sumGpa += $stageGpa;
         if ($i == $noStages ) {
            //Calculate Final Award GPA
            $finalAwardGpa = $sumGpa / $i;
            //Calculate Final Award Classification
            if ($finalAwardGpa >= 3.68) {
                $awardClassify = "First Class Division";
            }elseif ($finalAwardGpa <= 3.67 && $finalAwardGpa >= 2.24) {
                $awardClassify = "Second Class Upper Division";
            }
            elseif ($finalAwardGpa <= 2.23 && $finalAwardGpa >= 1.80) {
                $awardClassify = "Second Class Lower Division";
            }
            elseif ($finalAwardGpa <= 1.79 && $finalAwardGpa >= 1.50) {
                $awardClassify = "Genaral Division";
            }else{
                $awardClassify = "-";
            }
            //Calculation for Programme Summary
            $proFinalGpa = $finalAwardGpa;
            $proFinalClassify = $awardClassify;
            $proFinalStatus = "Complete";
            // var_dump($proFinalGpa, $proFinalClassify); 
        }else{
            $finalAwardGpa = "-";
            $awardClassify = "-";
        }
        $stageOverall [] = array('stageGpa' => $stageGpa,
           'stageStatus' => $stageStatus,
           'stageAcaYear' => $stageAcaYear,
           'finalAwardGpa' => $finalAwardGpa,
           'stage' => $value->stage_no,
           'awardClassify' => $awardClassify);
    }

    return array($stageOverall, $proFinalGpa, $proFinalClassify, $proFinalStatus) ;
}
}
