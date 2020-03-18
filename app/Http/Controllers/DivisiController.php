<?php

namespace App\Http\Controllers;

use App\divisi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DivisiController extends Controller
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
    public function index()
    {   
        $user = DB::table('users')->get();
        // $divisi = divisi::get();
        $divisi = DB::table('divisi')
        ->join('users', 'divisi.user_id', '=', 'users.id' )
        ->select('divisi.*', 'users.name')
        ->simplePaginate(100);
        return view('divisi/divisiIndex', ['divisi' => $divisi, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = DB::table('users')
        ->whereNotIn('role', [0])
        ->get();
        return view('divisi/addDivisi', [ 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = $request->uid;
        $div = $request->divisi;
        session()->flash('status', 'Data Created!');
        $divisi = divisi::insert([
            'user_id' => $user_id,
            'divisi' => $div,
            ]);
        
        return redirect('/divisi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function show(divisi $divisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('users')
        ->whereNotIn('role', [0])
        ->get();
        $divisi = divisi::find($id);
        return view('divisi/updateDivisi', [ 'r' => $divisi, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $divisi = divisi::find($id);
        $divisi->divisi = $request->divisi;
        session()->flash('status', 'Data Updated!');
        $divisi->save();
        
        return redirect('/divisi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $divisi = divisi::find($id);
        $divisi->delete();
        session()->flash('status', 'Data Deleted!');
        return redirect('/divisi');
        
    }
}
