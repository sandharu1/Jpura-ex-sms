<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Student;
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
        $stdInfo = Student::where('nic', '=', $id)->first();
        // var_dump($stdInfo);
        if (isset($stdInfo)) {
            return view('Student.show', compact('stdInfo'));
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

}
