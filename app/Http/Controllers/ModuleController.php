<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules;
use App\Courses;

use App\Http\Requests;

class ModuleController extends Controller
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
    public function create()
    {
    	$programs = Courses::all(['program_id', 'name']);
        return view('Module.create', compact('programs'));
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
            'module_id' => 'required',
            'programID' => 'required',
            'credits' => 'required',
            'year_commenced' => 'required'
            ]);
        // var_dump($request->all());
        Modules::create($request->all());
        return redirect()->route('Course.index')
        ->with('success', 'Module create successfully');
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
        $moduleTable = Modules::where('module_id', '=', $id)->first();
        $programs = Courses::all(['program_id', 'name']);
        return view('Module.edit', compact('moduleTable', 'programs'));
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
        'module_id' => 'required',
        'programID' => 'required',
        'credits' => 'required',
        'year_commenced' => 'required'
        ]);
      $moduleUpdate = Modules::where('module_id', '=', $id)->first();
      $moduleUpdate->update($request->all());
      return redirect()->route('Course.index')
      ->with('success', 'Module Update successfully');
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $moduleDelete = Modules::where('module_id', '=', $id)->first();
        $moduleDelete->delete();
        return redirect()->route('Course.index')
        ->with('success', 'Module Delete Successfully');
    }
}
