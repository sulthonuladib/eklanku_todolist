<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\task;
use App\Events\TaskEvent;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
use Response;
use DateTime;

class LeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSet($id){
        // dd($id);
        $user_id = Auth::user()->id;
        $task = DB::table('tasks')
        ->leftJoin('divisi', 'divisi.id', 'tasks.divisi_id')
        ->leftJoin('users','users.id','tasks.user_id')
        ->join('project','project.id','tasks.project_id')
        ->select('tasks.*','users.name','divisi.divisi','project.nama_project')
        ->where('tasks.project_id',$id)
        ->get();
            
        return view("leader/taskIndex", ['task' => $task, 'project' => $id]);
    }

    public function index(){
        $user = DB::table('users')
        ->whereNotIn('role', [0])
        ->get();
        // $task = DB::table('tasks')->get();
        $user_id = Auth::user()->id;
        $task = DB::table('tasks')
        ->leftJoin('divisi', 'divisi.id', 'tasks.divisi_id')
        ->leftJoin('users','users.id','tasks.user_id')
        ->select('tasks.*','users.name','divisi.divisi')
        ->where('tasks.user_id',$user_id)
        ->get();
            
        return view("leader/task", ['task' => $task, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id){
        // $project =  DB::table('project')->where('id',$id)->get();
        $user = DB::table('users')
        ->whereNotIn('role', [0])
        // ->where('role', '2')
        ->get();
        return view("leader/addTask", [ 'user' => $user, "project" => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $h = $request->h;
        $project_id = $request->project_id;
    
        if ($h == ''){
            session()->flash('error', 'Failed Hour Estimation is null!');
            
        return redirect('/leader/set'.$project_id);
        }else if ($h !== ''){
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
            'project_id' => $request->project_id,
            'priority' => $request->priority,
            ]);

        // dd($divisi);
        return redirect('/leader/set/'.$project_id);
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $user = DB::table('users')
        ->whereNotIn('role', [0])
        ->get();
        $task = DB::table('tasks')
        ->leftJoin('divisi', 'divisi.id', 'tasks.divisi_id')
        ->leftJoin('users','users.id','tasks.user_id')
        ->leftJoin('project','project.id','tasks.project_id')
        ->select('tasks.*','users.name','divisi.divisi','project.nama_project')
        ->where('tasks.id',$id)
        ->get();
        $project =  DB::table('project')->get();
            
        return view("leader/updateTask", ['task' => $task, 'user' => $user, 'project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $est_old = $request->est_old;
        $h = $request->h;
        

        if($h == '' && $est_old != '' ){
            $task = task::find($id);
            $task->user_id = $request->uid;
            $task->divisi_id = $request->divisi_id;
            $task->title = $request->title;
            $task->detail = $request->detail;
            $task->deathline = $request->dt;
            $task->est = $est_old;
            $task->project_id = $request->project_id;
            $task->priority = $request->priority;
            session()->flash('status', 'Data Updated!');
            $task->save();
            
            return redirect('/leader/set/'.$request->project_id);
        }else if ($h !== ''){
            $est = $h;

            $task = task::find($id);
            $task->user_id = $request->uid;
            $task->divisi_id = $request->divisi_id;
            $task->title = $request->title;
            $task->detail = $request->detail;
            $task->deathline = $request->dt;
            $task->est = $est;
            $task->project_id = $request->project_id;
            $task->priority = $request->priority;
            session()->flash('status', 'Data Updated!');
            $task->save();
            
            return redirect('/leader/set/'.$request->project_id);

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $task = task::find($id);
        $task->delete();
        session()->flash('status', 'Data Deleted!');
        // return redirect('/leader/set');
        return back();
    }
    
    
    public function get_subTask($id){
        $user_id = Auth::user()->id;
        $subk = DB::table('tasks')
        ->where('user_id',$user_id)
        ->where('keterangan',$id)
        ->get();   
        return Response::json($subk);
        // dd($subk);
    }
    public function test(Request $request, $id){

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        //Remember to set your credentials below.
        $pusher = new Pusher(
            '347a9f8368ae5c56f4a0',
            'e2212980fc8bde8a300a',
            '928914', $options
        );

        $est = DB::table('tasks')->where('id',$id)->first()->est;
        $updated_at=date("Y-m-d H:i:s");

        // $date=new DateTime();
        // date_modify($date,$est);
        $A = 0;
        $B = 0;
        $C = 0;
        $D = 0;
        $date=new DateTime();
        $tanggal_baru = date_format($date,"H")+1;
        // $hour = explode('+', $est);
        $est_tes = $est;
        // $est_tes = $hour[1][1];
        if( $tanggal_baru < 8){
            
            if($est_tes > 4 && $est_tes <= 8){
                $est_tes = $est_tes+1;
                $jamberakhir = ($est_tes+8);
                $Date_new = date_format($date,"d");
                $Minute = date_format($date,"i");
                $berakhir = ''.date_format($date,"Y-m").'-'.$Date_new.' '.$jamberakhir.':'.$Minute.':00 --> 1';
            }else if($est_tes <=4){
                $jamberakhir = ($est_tes+8);
                $Date_new = date_format($date,"d");
                $Minute = date_format($date,"i");
                $berakhir = ''.date_format($date,"Y-m").'-'.$Date_new.' '.$jamberakhir.':'.$Minute.':00 --> 2';
            }else{
            
            $A = ($est_tes/8);
            $B = round($A);
            $C = $A-$B;
            $D = $C*8;
            
              if($D > 4){
                 $D = $D+1;
                }
                $Date_new = date_format($date,"d")+$B;                
                $Hour_new = date_format($date,"H")+1;
                // $Hour_new = $D+8;
                $Minute = date_format($date,"i");
                $berakhir = ''.date_format($date,"Y-m").'-'.$Date_new.' '.$Hour_new.':'.$Minute.':00 --> 3';

            }
        }
        if($tanggal_baru > 17){

            if($est_tes > 4 && $est_tes <= 8){
                $est_tes = $est_tes+1;
                $jamberakhir = ($est_tes+8);
                $Date_new = date_format($date,"d");
                $Minute = date_format($date,"i");
                $berakhir = ''.date_format($date,"Y-m").'-'.$Date_new.' '.$jamberakhir.':'.$Minute.':00 --> 4';
            }else if($est_tes <=4){
                $jamberakhir = ($est_tes+8);
                $Date_new = date_format($date,"d");
                $Minute = date_format($date,"i");
                $berakhir = ''.date_format($date,"Y-m").'-'.$Date_new.' '.$jamberakhir.':'.$Minute.':00 --> 5';
            }else{

            $A = ($est_tes/8);
            $B = round($A);
            $C = $A-$B;
            $D = $C*8;
            
              if($D > 4){
                 $D = $D+1;
                }
                $Date_new = date_format($date,"d")+$B;

                // $Hour_new = $D+8;
                $Hour_new = date_format($date,"H")+1;
                $Minute = date_format($date,"i");
                $berakhir = ''.date_format($date,"Y-m").'-'.$Date_new.' '.$Hour_new.':'.$Minute.':00 --> 6';
            }
        }
        if($tanggal_baru >= 8 && $tanggal_baru <=17){
        
            if($est_tes > 4 && $est_tes <= 8){
                // $est_tes = $est_tes+1;
                $jamberakhir = ($est_tes+9);
                $Date_new = date_format($date,"d");
                $Minute = date_format($date,"i");
                $berakhir = ''.date_format($date,"Y-m").'-'.$Date_new.' '.$jamberakhir.':'.$Minute.':00 --> 7';
            }else if($est_tes <=4){
                $jamberakhir = ($est_tes+8);
                $Date_new = date_format($date,"d");
                $Minute = date_format($date,"i");
                $berakhir = ''.date_format($date,"Y-m").'-'.$Date_new.' '.$jamberakhir.':'.$Minute.':00 --> 8';
            }else{
            $A = ($est_tes/8);
            $B = round($A);
            $C = $A-$B;
            $D = $C*8;
            
              if($D > 4){
                 $D = $D+1;
                
              }

                $Date_new = date_format($date,"d")+$B;
                // $Hour_new = $D+8;
                $Hour_new = date_format($date,"H");

                $Minute = date_format($date,"i");
                $berakhir = ''.date_format($date,"Y-m").'-'.$Date_new.' '.$Hour_new.':'.$Minute.':00 --> 9';
            }
        }
        
        $ket = $request->id_ket;
        //Update Status
        if($ket=="pl"){
            $ket = 0;
            // $label = 1;
            DB::table('tasks')->where('id',$id)->update([
                'keterangan' => $ket,
                'updated_at' => $updated_at,
                'start_at' => Null,
                'end_at' => Null,
            ]);
            //membuat kalimat
            $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
            $user_id = DB::table('tasks')->where('id',$id)->first()->user_id;
            // $user_id = Auth::user()->id;
            $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
            // $kalimat = $nama_orang." membatalkan task ".$nama_task;
            //Trigger custom event
            // $pusher->trigger('my-channel', 'my-event', $kalimat);
        }else if($ket == "bl"){
            $ket = 1;
            DB::table('tasks')->where('id',$id)->update([
                'keterangan' => $ket,
                'updated_at' => $updated_at,
                'start_at' => $updated_at,
                // 'end_at' => date_format($date,"Y-m-d H:i:s"),
            ]);
            //membuat kalimat
            $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
            $user_id = DB::table('tasks')->where('id',$id)->first()->user_id;
            // $user_id = Auth::user()->id;
            $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
            $kalimat = $nama_orang." telah Mengerjakan Task ".$nama_task;
            //Trigger custom event
            for($i=0; $i<2; $i++){
                $pusher->trigger('my-channel', 'my-event', $kalimat);
                sleep(5);
            }
        }else if($ket == "op"){
            
            $ket = 2;
            DB::table('tasks')->where('id',$id)->update([
                'keterangan' => $ket,
                'updated_at' => $updated_at,
                // 'start_at' => $updated_at,
                'end_at' => date_format($date,"Y-m-d H:i:s"),
            ]);
            //membuat kalimat
            $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
            $user_id = DB::table('tasks')->where('id',$id)->first()->user_id;
            // $user_id = Auth::user()->id;
            $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
            $kalimat = $nama_orang." Mengerjakan Task ".$nama_task;
            //Trigger custom event
            for($i=0; $i<2; $i++){
                $pusher->trigger('my-channel', 'my-event', $kalimat);
                sleep(5);
            }
        }else if($ket == "rr"){
            $ket = 3;
            DB::table('tasks')->where('id',$id)->update([
                'keterangan' => $ket,
                'updated_at' => $updated_at,
                // 'start_at' => $updated_at,
                // 'end_at' => date_format($date,"Y-m-d H:i:s"),
            ]);
            //membuat kalimat
            $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
            $user_id = DB::table('tasks')->where('id',$id)->first()->user_id;
            // $user_id = Auth::user()->id;
            $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
            $kalimat = $nama_orang." siap review task ".$nama_task;
            //Trigger custom event
            for($i=0; $i<2; $i++){
                $pusher->trigger('my-channel', 'my-event', $kalimat);
                sleep(5);
            }
        }else if($ket == "mg"){
            $ket = 4;
            DB::table('tasks')->where('id',$id)->update([
                'keterangan' => $ket,
                'updated_at' => $updated_at,
                // 'start_at' => $updated_at,
                // 'end_at' => date_format($date,"Y-m-d H:i:s"),
            ]);
            //membuat kalimat
            $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
            $user_id = DB::table('tasks')->where('id',$id)->first()->user_id;
            // $user_id = Auth::user()->id;
            $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
            $kalimat = $nama_task." Siap di Merge ";
            //Trigger custom event
            for($i=0; $i<2; $i++){
                $pusher->trigger('my-channel', 'my-event', $kalimat);
                sleep(5);
            }
        }else if($ket == "dn"){
            $ket = 5;
            DB::table('tasks')->where('id',$id)->update([
                'keterangan' => $ket,
                'updated_at' => $updated_at,
                // 'start_at' => $updated_at,
                // 'end_at' => date_format($date,"Y-m-d H:i:s"),
            ]);
            //membuat kalimat
            $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
            $user_id = DB::table('tasks')->where('id',$id)->first()->user_id;
            // $user_id = Auth::user()->id;
            $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
            $kalimat = $nama_orang." Telah menyelesaikan task ".$nama_task;
            //Trigger custom event
            for($i=0; $i<2; $i++){
                $pusher->trigger('my-channel', 'my-event', $kalimat);
                sleep(5);
            }
        }
        
        
        $data = array(
        "A = " => $A,
        "B = " => $B,
        "C = " => $C,
        "D = " => $D,
        "Start" => $tanggal_baru,
        "Estimation" => $est_tes,
        "End " => $berakhir,
        
        );
        return Response::json($data);
        
    }

    public function revision($id){
        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        //Remember to set your credentials below.
        $pusher = new Pusher(
            '347a9f8368ae5c56f4a0',
            'e2212980fc8bde8a300a',
            '928914', $options
        );

        $ket = 0;
        $updated_at=date("Y-m-d H:i:s");
        $label = 1;
        DB::table('tasks')->where('id',$id)->update([
            'keterangan' => $ket,
            'updated_at' => $updated_at,
            'start_at' => Null,
            'label' => $label,
            'end_at' => Null,
        ]);

        //membuat kalimat
        $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
        $user_id = Auth::user()->id;
        $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
        $kalimat = $nama_task." siap untuk direvisi oleh ".$nama_orang;
        //Trigger custom event
        $pusher->trigger('my-channel', 'my-event', $kalimat);
        session()->flash('status', 'Data Updated!');

        // return redirect('/leader/set');
        return back();
    }

    public function done($id){

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        //Remember to set your credentials below.
        $pusher = new Pusher(
            '347a9f8368ae5c56f4a0',
            'e2212980fc8bde8a300a',
            '928914', $options
        );
        $updated_at=date("Y-m-d H:i:s");
        $ket = 5;
        DB::table('tasks')->where('id',$id)->update([
            'keterangan' => $ket,
            'updated_at' => $updated_at,
            // 'start_at' => $updated_at,
            'end_at' => $updated_at,
        ]);
        //membuat kalimat
        $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
        $user_id = Auth::user()->id;
        $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
        $kalimat = $nama_orang." telah menyelesaikan task ".$nama_task;
        //Trigger custom event
        $pusher->trigger('my-channel', 'my-event', $kalimat);
        session()->flash('status', 'Data Updated!');

        // return redirect('/leader/set');
        return back();
    }

    public function pos(Request $request){
        $pos = $request->positions;
        foreach($pos as $ok){
            $index = $ok[0];
            $newPosition = $ok[1];
            DB::table('tasks')->where('id',$index)->update([
                'position' => $newPosition,
            ]);
        }
        $data = array("Id Task e" => $index,
            "Posisi e" => $newPosition,
            );
        return Response::json($data);
    }

    public function test2(Request $request, $id){

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        //Remember to set your credentials below.
        $pusher = new Pusher(
            '347a9f8368ae5c56f4a0',
            'e2212980fc8bde8a300a',
            '928914', $options
        );

        $est_tes = DB::table('tasks')->where('id',$id)->first()->est;
        $updated_at=date("Y-m-d H:i:s");

        // $date=new DateTime();
        // date_modify($date,$est);

        //start date
        // $est = ' + 10 hour, + 0 minute';
        // $est_tes = '10';
        $date=new DateTime();
        $tanggal_baru = date_format($date,"H");
        
        if( $tanggal_baru < 8){
            
            if($est_tes > 4 && $est_tes <= 8){
                $est_tes = $est_tes+1;
                $berakhir = ($est_tes+8);
            }else if($est_tes <=4){
                $berakhir = ($est_tes+8);
            }else{
            
            $A = ($est_tes/8);
            $B = round($A);
            $C = $A-$B;
            $D = $C*8;
            
              if($D > 4){
                 $D = $D+1;
                }
            }
            
            $Date_new = date_format($date,"d")+$B;                
            $Hour_new = $D+8;
            $Minute = date_format($date,"i");
            $berakhir = ''.date_format($date,"Y-m").'-'.$Date_new.' '.$Hour_new.':'.$Minute.':00';
            
        }
        if($tanggal_baru > 17){

            if($est_tes > 4 && $est_tes <= 8){
                $est_tes = $est_tes+1;
                $berakhir = ($est_tes+8);
            }else if($est_tes <=4){
                $berakhir = ($est_tes+8);
            }else{

            $A = ($est_tes/8);
            $B = round($A);
            $C = $A-$B;
            $D = $C*8;
            
              if($D > 4){
                 $D = $D+1;
                }
            }
            $Date_new = date_format($date,"d")+$B;

            $Hour_new = $D+8;
            $Minute = date_format($date,"i");
            $berakhir = ''.date_format($date,"Y-m").'-'.$Date_new.' '.$Hour_new.':'.$Minute.':00';

        }
        if($tanggal_baru > 8 && $tanggal_baru <=17){
        
            if($est_tes > 4 && $est_tes <= 8){
                $est_tes = $est_tes+1;
                $berakhir = ($est_tes+8);
            }else if($est_tes <=4){
                $berakhir = ($est_tes+8);
            }else{
            $A = ($est_tes/8);
            $B = round($A);
            $C = $A-$B;
            $D = $C*8;
            
              if($D > 4){
                 $D = $D+1;
                
              }
            }
            
            $Date_new = date_format($date,"d")+$B;
            $Hour_new = $D+8;
            $Minute = date_format($date,"i");
            $berakhir = ''.date_format($date,"Y-m").'-'.$Date_new.' '.$Hour_new.':'.$Minute.':00';
        }
        //end date 
        
        $ket = $request->id_ket;
        //Update Status
        if($ket=="pl"){
            $ket = 0;
            // $label = 1;
            DB::table('tasks')->where('id',$id)->update([
                'keterangan' => $ket,
                'updated_at' => $updated_at,
                'start_at' => Null,
                'end_at' => Null,
            ]);
            //membuat kalimat
            $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
            $user_id = DB::table('tasks')->where('id',$id)->first()->user_id;
            // $user_id = Auth::user()->id;
            $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
            // $kalimat = $nama_orang." membatalkan task ".$nama_task;
            //Trigger custom event
            // $pusher->trigger('my-channel', 'my-event', $kalimat);
        }else if($ket == "bl"){
            $ket = 1;
            DB::table('tasks')->where('id',$id)->update([
                'keterangan' => $ket,
                'updated_at' => $updated_at,
                'start_at' => $updated_at,
                // 'end_at' => date_format($date,"Y-m-d H:i:s"),
            ]);
            //membuat kalimat
            $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
            $user_id = DB::table('tasks')->where('id',$id)->first()->user_id;
            // $user_id = Auth::user()->id;
            $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
            $kalimat = $nama_orang." telah Mengerjakan Task ".$nama_task;
            //Trigger custom event
            for($i=0; $i<2; $i++){
                // $pusher->trigger('my-channel', 'my-event', $kalimat);
                sleep(5);
            }
        }else if($ket == "op"){
            
            $ket = 2;
            DB::table('tasks')->where('id',$id)->update([
                'keterangan' => $ket,
                'updated_at' => $updated_at,
                // 'start_at' => $updated_at,
                'end_at' => date_format($date,"Y-m-d H:i:s"),
            ]);
            //membuat kalimat
            $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
            $user_id = DB::table('tasks')->where('id',$id)->first()->user_id;
            // $user_id = Auth::user()->id;
            $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
            $kalimat = $nama_orang." Mengerjakan Task ".$nama_task;
            //Trigger custom event
            for($i=0; $i<2; $i++){
                // $pusher->trigger('my-channel', 'my-event', $kalimat);
                sleep(5);
            }
        }else if($ket == "rr"){
            $ket = 3;
            DB::table('tasks')->where('id',$id)->update([
                'keterangan' => $ket,
                'updated_at' => $updated_at,
                // 'start_at' => $updated_at,
                // 'end_at' => date_format($date,"Y-m-d H:i:s"),
            ]);
            //membuat kalimat
            $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
            $user_id = DB::table('tasks')->where('id',$id)->first()->user_id;
            // $user_id = Auth::user()->id;
            $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
            $kalimat = $nama_orang." siap review task ".$nama_task;
            //Trigger custom event
            for($i=0; $i<2; $i++){
                // $pusher->trigger('my-channel', 'my-event', $kalimat);
                sleep(5);
            }
        }else if($ket == "mg"){
            $ket = 4;
            DB::table('tasks')->where('id',$id)->update([
                'keterangan' => $ket,
                'updated_at' => $updated_at,
                // 'start_at' => $updated_at,
                // 'end_at' => date_format($date,"Y-m-d H:i:s"),
            ]);
            //membuat kalimat
            $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
            $user_id = DB::table('tasks')->where('id',$id)->first()->user_id;
            // $user_id = Auth::user()->id;
            $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
            $kalimat = $nama_task." Siap di Merge ";
            //Trigger custom event
            for($i=0; $i<2; $i++){
                // $pusher->trigger('my-channel', 'my-event', $kalimat);
                sleep(5);
            }
        }else if($ket == "dn"){
            $ket = 5;
            DB::table('tasks')->where('id',$id)->update([
                'keterangan' => $ket,
                'updated_at' => $updated_at,
                // 'start_at' => $updated_at,
                // 'end_at' => date_format($date,"Y-m-d H:i:s"),
            ]);
            //membuat kalimat
            $nama_task = DB::table('tasks')->where('id',$id)->first()->title;
            $user_id = DB::table('tasks')->where('id',$id)->first()->user_id;
            // $user_id = Auth::user()->id;
            $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
            $kalimat = $nama_orang." Telah menyelesaikan task ".$nama_task;
            //Trigger custom event
            for($i=0; $i<2; $i++){
                // $pusher->trigger('my-channel', 'my-event', $kalimat);
                sleep(5);
            }
        }
        
        
        // $data = array("Start" => $updated_at,
        // "Estimation" => $est,
        // "End " => date_format($date,"Y-m-d H:i:s"),
        // );
        return Response::json($berakhir);
        
    }

    public function cek(){
        $est_tes = DB::table('tasks')->where('id','72')->first()->est;
        $hour = explode('+', $est_tes);
        dd($hour[2][1]);
        // return view("vtes");

    }

}
