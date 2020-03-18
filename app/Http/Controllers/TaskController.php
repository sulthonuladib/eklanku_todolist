<?php

namespace App\Http\Controllers;

use App\task;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $task = DB::table('tasks')
    //     ->join('divisi', 'divisi.id', 'tasks.divisi_id')
    //     ->join('users','users.id','tasks.user_id')
    //     ->select('tasks.*','users.name','divisi.divisi')
    //     ->get();
            
    //     return view("task/taskIndex", ['task' => $task]);

    //     // dd($task);
    // }
    public function index($id)
    {
        $task = DB::table('tasks')
        ->leftJoin('divisi', 'divisi.id', 'tasks.divisi_id')
        ->leftJoin('users','users.id','tasks.user_id')
        ->select('tasks.*','users.name','divisi.divisi')
        ->whereRaw('tasks.project_id = ? ',[$id])
        ->get();
            
        return view("task/taskIndex", ['task' => $task, 'project' => $id]);

        // dd($task);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = DB::table('users')
        ->whereNotIn('role', [0])
        ->get();
        return view("task/addTask", [ 'user' => $user, 'project' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $h = $request->h;
        $pid = $request->project_id;
    
        if ($h == ''){
            session()->flash('error', 'Failed Hour Estimation is null!');
            
        return redirect('/task/index/'.$pid);
        }else if($h != ''){
            $est = $h;

            $divisi_id = $request->divisi_id;
            session()->flash('status', 'Data Created!');
            $divisi = task::create([
            'user_id' => $request->uid,
            'divisi_id' => $divisi_id,
            'title' => $request->title,
            'keterangan' => '0',
            'detail' => $request->detail,
            'deathline' => $request->dt,
            'est' => $est,
            'project_id' => $pid,
            'priority' => $request->priority,
            ]);

        // dd($divisi);
        return redirect('/task/index/'.$pid);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('users')
        ->whereNotIn('role', [0])
        ->get();
        $task = DB::table('tasks')
        ->leftJoin('divisi', 'divisi.id', 'tasks.divisi_id')
        ->leftJoin('users','users.id','tasks.user_id')
        ->select('tasks.*','users.name','divisi.divisi')
        ->where('tasks.id',$id)
        ->get();
            
        return view("task/updateTask", ['task' => $task, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $est_old = $request->est_old;
        $h = $request->h;
        $pid = $request->project_id;

        if($h == '' && $est_old != ''){
            $task = task::find($id);
            $task->user_id = $request->uid;
            $task->divisi_id = $request->divisi_id;
            $task->title = $request->title;
            $task->detail = $request->detail;
            $task->deathline = $request->dt;
            $task->est = $est_old;
            session()->flash('status', 'Data Updated! 1');
            $task->project_id = $pid;
            $task->priority = $request->priority;
            $task->save();
            
            return redirect('/task/index/'.$pid);
        }else if($h != ''){
            $est = $h;

            $task = task::find($id);
            $task->user_id = $request->uid;
            $task->divisi_id = $request->divisi_id;
            $task->title = $request->title;
            $task->detail = $request->detail;
            $task->deathline = $request->dt;
            $task->est = $est;
            session()->flash('status', 'Data Updated! 2');
            $task->project_id = $pid;
            $task->priority = $request->priority;
            $task->save();
            
            return redirect('/task/index/'.$pid);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = task::find($id);
        $task->delete();
        session()->flash('status', 'Data Deleted!');
        // return redirect('/task');
        return back();
    }

    public function get_sub($id)
    {
        // $subk = DB::table('divisi')->whereRaw('user_id = '.$id)->first();
        $subk = DB::table('divisi')->where('user_id',$id)->get();
        // CREATE AN ARRAY 
        $options = array();      
        foreach ($subk as $arrayForEach) {
                    $options += array($arrayForEach->id => $arrayForEach->divisi);                
                }
        if($id=="kosong"){
            $options += array("" => "Divisi");                
            return Response::json($options);
        }
        return Response::json($options);
        
        // dd($subk);
    }

    public function indexTask()
    {
        // $task = DB::table('tasks')
        // ->join('divisi', 'divisi.id', 'tasks.divisi_id')
        // ->join('users','users.id','tasks.user_id')
        // ->select('tasks.*','users.name','divisi.divisi')
        // ->get();
        $user = DB::table('users')
        ->whereNotIn('role', [0])
        ->get();
        // $divisi = DB::table('divisi')->get();
        $task = DB::table('tasks')->get();

        // return view("task", ['task' => $task]);
        return view("taskdev", ['task' => $task,'user' => $user]);

        // dd($task);
    }

    public function get_subTask($id)
    {
        // $subk = DB::table('divisi')->whereRaw('user_id = '.$id)->first();
        $subk = DB::table('tasks')->where('user_id',$id)->get();
        // CREATE AN ARRAY 
        // $options = array();      
        // foreach ($subk as $arrayForEach) {
        //             $options += array($arrayForEach->id => $arrayForEach->title);                
        //         }
        return Response::json($subk);

        // dd($subk);
    }

    public function see($id){
        $user = DB::table('tasks')
        ->leftJoin('users','users.id','tasks.user_id')
        ->select('tasks.user_id','tasks.project_id','users.name')
        ->where('tasks.project_id',$id)
        ->groupBy('tasks.user_id')
        ->get();
        
        $user_id = Auth::user()->id;
        $task = DB::table('tasks')
        ->leftJoin('users','users.id','tasks.user_id')
        ->select('tasks.id','tasks.title','tasks.keterangan','tasks.priority','tasks.position','users.name')
        ->whereRaw('tasks.project_id = ? ',[$id])
        ->orderBy('tasks.position')
        ->get();
        $links = DB::table('resource')->get();
        $membere = DB::select( DB::raw("select `tasks`.`user_id`, `tasks`.`project_id`, users.`name` from `tasks`, users where tasks.project_id = '$id' AND tasks.user_id = users.id group by `tasks`.`user_id`"));
        
        return view("task/tese2", ['task' => $task, 'user' => $user, 'project' => $id, 'member' => $membere,'link' => $links]);
        // return view("task/seeAllTask", ['task' => $task, 'user' => $user, 'project' => $id, 'member' => $membere,'link' => $links]);
    }

    public function devsee($id){
        $user = DB::table('tasks')
        ->leftJoin('users','users.id','tasks.user_id')
        ->select('tasks.user_id','tasks.project_id','users.name')
        ->where('tasks.project_id',$id)
        ->groupBy('tasks.user_id')
        ->get();
        
        $user_id = Auth::user()->id;
        $task = DB::table('tasks')
        ->leftJoin('users','users.id','tasks.user_id')
        ->select('tasks.id','tasks.title','tasks.keterangan','tasks.priority','tasks.position','users.name')
        ->whereRaw('tasks.project_id = ? ',[$id])
        ->orderBy('tasks.position')
        ->get();
        $links = DB::table('resource')->get();
        $membere = DB::select( DB::raw("select `tasks`.`user_id`, `tasks`.`project_id`, users.`name` from `tasks`, users where tasks.project_id = '$id' AND tasks.user_id = users.id group by `tasks`.`user_id`"));
        // dd($links);
        return view("task/tese1", ['task' => $task, 'user' => $user, 'project' => $id, 'member' => $membere,'link' => $links]);
    }

    public function get_subTaske($pr,$id)
    {
        
        // $subk = DB::table('divisi')->whereRaw('user_id = '.$id)->first();
        $subk = DB::table('tasks')
                ->whereRaw('user_id = ? and project_id = ?',[$id,$pr])->get();
        // CREATE AN ARRAY 
        // $options = array();      
        // foreach ($subk as $arrayForEach) {
        //             $options += array($arrayForEach->id => $arrayForEach->title);                
        //         }
        return Response::json($subk);

        // dd($subk);
    }

    public function getlinks(){
        

    }
    public function destroylinks($id)
    {
        DB::table('resource')->where('id',$id)->delete();
        return back();
    }

    public function addlinks(Request $request){
        DB::table('resource')->insert([
            'links' => $request->links,
            'nama' => $request->nama,
        ]);
        return back();
    }
}
