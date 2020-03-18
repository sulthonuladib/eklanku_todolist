<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $users = DB::table('users')->get();

        return view('users/users',['users' => $users]);
    }
    // AddView
    public function add(){
        return view('users/addusers');
    }
    // AddFunction
    public function store(Request $request){
        
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect('/users');
    }
    // UpdateView
    public function edit($id){
        $users = DB::table('users')->where('id',$id)->get();

        return view('users/editusers',['users' => $users]);
    }
    // UpdateFunction
    public function update(Request $request){
        // dd($request);
        DB::table('users')->where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'updated_at' => $updated_at=date("Y-m-d H:i:s"),
        ]);
        return redirect('/users');
    }
    
    public function hapus($id){
        DB::table('users')->where('id',$id)->delete();
        return redirect('/users');
    }
}
