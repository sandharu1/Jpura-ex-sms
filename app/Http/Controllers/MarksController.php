<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Marks;
use App\Modules;
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
                'grade' => 'required',
                'attempt' => 'required',
                'year' => 'required'
                ]);
            

            return redirect()->route('Course.index')
            ->with('success', 'Module create successfully');
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
                Marks::create(['nic' => $value->nic, 'student_id' => $value->student_id, 'moduleID' => $value->moduleid, 'mark' => $value->mark, 'attempt' => $value->attempt, 'grade' => $value->grade, 'year' => $value->year]);
            }
            return redirect()->route('Course.index')
            ->with('success', 'Import Data and create marks successfully');
        }
    }
    
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
}
