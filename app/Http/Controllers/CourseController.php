<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courses;
use App\Modules;

use App\Http\Requests;

class CourseController extends Controller
{
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
    public function index(Request $request)
    {
        $course = Courses::orderBy('id','DESC')->paginate(5);
        $module = Modules::orderBy('id','DESC')->paginate(5);
        return view('Course.index', compact('course','module'))
        ->with('i', ($request->input('page', 1) -1) *5)
        ->with('ii', ($request->input('page', 1) -1) *5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'program_id' => 'required',
        'credits' => 'required',
        'year_commenced' => 'required'
        ]);

        Courses::create($request->all());
        return redirect()->route('Course.index')
                            ->with('success', 'Course create successfully');

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
        //var_dump($id);
        $program = Courses::where('program_id', '=', $id)->first();
        // var_dump($program);
        return view('Course.edit', compact('program'));
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
        $this->validate($request, [
        'name' => 'required',
        'program_id' => 'required',
        'credits' => 'required',
        'year_commenced' => 'required'
        ]);
        $programUpdate = Courses::where('program_id', '=', $id)->first();
        $programUpdate->update($request->all());
        return redirect()->route('Course.index')
                            ->with('success', 'Program Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $programDelete = Courses::where('program_id', '=', $id)->first();
        $programDelete->delete();
        return redirect()->route('Course.index')
                            ->with('success', 'Program Delete Successfully');
    }
}
