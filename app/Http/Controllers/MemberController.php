<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Auth;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $nama_project = DB::table('tasks')
        ->join('project', 'project.id', 'tasks.project_id')
        ->select('project.id','project.nama_project')
        ->where('tasks.user_id',$user_id)
        ->groupBy('project.id')
        ->get();
        // $project = DB::table('project')
        // where('id',$nama_project)
        // ->get();
        // dd($nama_project);
        return view("anggota/indexProject",['project' => $nama_project]);
    }

    public function indexGeser($id){
        $user_id = Auth::user()->id;
        $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;

        $task = DB::table('tasks')
        ->leftJoin('users','users.id','tasks.user_id')
        ->select('tasks.id','tasks.title','tasks.keterangan','tasks.priority','tasks.position','users.name')
        ->whereRaw('tasks.project_id = ? and tasks.user_id = ?',[$id, $user_id])
        ->orderBy('tasks.position')
        ->get();
        
        return view("anggota/task", ['task' => $task, 'user' => $nama_orang]);
    }

    public function indexproject(){

        $user_id = Auth::user()->id;
        $nama_project = DB::table('tasks')
        ->join('project', 'project.id', 'tasks.project_id')
        ->select('project.id','project.nama_project')
        ->where('tasks.user_id',$user_id)
        ->groupBy('project.id')
        ->get();
        // $project = DB::table('project')
        // where('id',$nama_project)
        // ->get();
        // dd($nama_project);
        return view("anggota/indexProject",['project' => $nama_project]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function detail($id)
    {
        $task = DB::table('tasks')
        ->join('divisi', 'divisi.id', 'tasks.divisi_id')
        ->join('users','users.id','tasks.user_id')
        ->select('tasks.*','users.name','divisi.divisi')
        ->where('tasks.id',$id)
        ->get();
            
        $comment = DB::table('comment')
        ->join('tasks','tasks.id','comment.task_id')
        ->join('users','users.id','comment.user_id')
        ->select('comment.*', 'users.name')
        ->where('tasks.id',$id)
        ->get();
        return view("anggota/taskDetail", ['task' => $task, 'komentar' => $comment]);
    }
}
