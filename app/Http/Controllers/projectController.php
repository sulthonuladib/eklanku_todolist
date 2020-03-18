<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class projectController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = DB::table('project')->get();
        // dd($project);
        return view("project/indexProject",['project' => $project]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("project/addProject");
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama_project = $request->nama_project;
        $data = array(
            'nama_project' => $nama_project,
        );
        DB::table('project')->insert($data);
        session()->flash('status', 'Data Created!');
        return redirect("/project");
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
        $project = DB::table('project')->where('id',$id)->get();
        // dd($project);
        return view("project/editProject",['project' => $project]);
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
        $nama_project = $request->nama_project;
        session()->flash('status', 'Data Edited!');
        DB::update('update project set nama_project = ? where  id = ? ',[$nama_project, $id]);
        return redirect('/project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('status', 'Data Deleted!');
        DB::delete('delete from project where id = ?',[$id]);
        return redirect('/project');
    }
}
