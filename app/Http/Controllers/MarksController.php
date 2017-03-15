<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Marks;
use App\Modules;
use App\Student;
use Excel;

class MarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        // var_dump($request->all());
        if ($request->type == '1') {
            $modules = Modules::all(['module_id', 'name']);
            $type = "1";
            return view('Marks.create', compact('modules', 'type'));
        }elseif ($request->type == '2') {
            $type = "2";
            return view('Marks.create', compact('modules', 'type'));
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->type == "1") {


            $this->validate($request, [
                'nic' => 'required',
                'student_id' => 'required',
                'moduleID' => 'required',
                'mark' => 'required',
                'year' => 'required'
                ]);
            // var_dump($this->grade($request->input('mark')));
            // var_dump($request->all());
            $request->merge($this->grade($request->input('mark')));
            // var_dump($request->all());
            //Add attempt Count
            $calAttempt = Marks::where('student_id', '=', $request->student_id)
            ->where('nic', '=', $request->nic)
            ->where('moduleID', '=', $request->moduleID)
            ->count();
            // var_dump($calAttempt);
            $request->merge(['attempt' => ++$calAttempt]);
            //save recodes validating
            if (Marks::create($request->all())) {
                return redirect()->route('Course.index') 
                ->with('success', 'Student marks insert successfully');
            }else{
                return redirect()->route('Course.index')
                ->with('unsuccess', 'Error: Student marks insert unsuccessfully');
            }

        }elseif ($request->type == "2") {

    /**
     * Import data from data sheet and store to database.
     *
     * **/

    if(Input::hasFile('import_file')){
        $path = Input::file('import_file')->getRealPath();
        $data = Excel::load($path, function($reader) {
        })->get();
        //var_dump($data);
        if(!empty($data) && $data->count()){
            foreach ($data as $key => $value) {
                $calAttempt = Marks::where('student_id', '=', $value->student_id)
                ->where('nic', '=', $value->nic)
                ->where('moduleID', '=', $value->moduleid)
                ->count();
                $arraydata = collect(array('nic' => $value->nic, 'student_id' => $value->student_id, 'moduleID' => $value->moduleid, 'mark' => $value->mark, 'attempt' => $calAttempt++, 'year' => $value->stage));
                $functiondata = $this->grade($value->mark); 
                //var_dump($functiondata);
                $finalobject = $arraydata->merge($functiondata);
               // var_dump($finalobject);
                Marks::create($finalobject->toArray());
            }
            // if (Marks::create($finalobject->toArray())) {
            return redirect()->route('Course.index')
            ->with('success', 'Import Data and create marks successfully');
            // }else{
            //   return redirect()->route('Course.index')
            // ->with('unsuccess', 'Error: Import Data and create marks unsuccessfully');  
            // }

        }
    }
    
}elseif ($request->type == "3") {
    $exBatch = $request->batch;
    $exModule = $request->module;
    $exStdList = array(array('nic', 'student_id', 'moduleid', 'mark', 'stage'));
    $exStdData = Student::with('batchs')
    ->where('batch', '=', $exBatch)
    ->orderBy('reg_number','ASC')
    ->get();
    foreach ($exStdData as $key => $value) {
        $exStdList [] = array($value->nic, $value->reg_number, $exModule, '', '');
    }
    // var_dump($exStdList); 
    Excel::create('Filename', function($excel) use($exStdList) {

        $excel->sheet('Sheetname', function($sheet) use($exStdList) {

            $sheet->fromArray($exStdList, null, 'A1', false, false);

        });

    })->export('csv');
}
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Convert marks to grade
     *
     * @param  int  $mark
     * @return \Illuminate\Http\Response
     */
    public function grade($mark){
        // return $te = $mark + 50;
        if ($mark <= 100 && $mark >= 75) {
           return array('grade' => 'A',
               'credit' => '3',
               'gpa' => '4');
       }elseif ($mark <= 74 && $mark >= 60) {
        return array('grade' => 'B',
           'credit' => '3',
           'gpa' => '3');
    }elseif ($mark <= 59 && $mark >= 50) {
        return array('grade' => 'C',
           'credit' => '3',
           'gpa' => '2');
    }elseif ($mark <= 49 && $mark >= 30) {
        return array('grade' => 'D',
           'credit' => '3',
           'gpa' => '1');
    }elseif ($mark <= 29 && $mark >= 00) {
        return array('grade' => 'E',
           'credit' => '0',
           'gpa' => '0');
    }
}
}
