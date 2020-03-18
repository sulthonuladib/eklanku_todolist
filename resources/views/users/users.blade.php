@extends('layouts.head')

  @section('content')
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col margin-kanan-kiri30">
        <h3 align='center' class='m-5'>Data Users</h3>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
        <a href="{{url('/')}}/users/addusers" class="btn btn-success"><i class="fa fa-plus mr-2"></i>Add
          Users</a><br/><br/>
        <table  id="dataTables" class="table table-striped">
          <thead class="bg-dark text-white">
            <tr>
              <th>NO</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Role</th>
              <th>Created At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=0; ?>
            @foreach($users as $users)
            <?php $no++; ?>
            <tr>
              <th>{{$no}}</th>
              <td>{{$users->name}}</td>
              <td>{{$users->email}}</td>
              <td>
                @if($users->role==0)
                Admin
                @elseif($users->role==1)
                Leader
                @elseif($users->role==2)
                Member
                @elseif($users->role==3)
                Developers
                @else
                Designer
                @endif
              </td>
              <td>{{$users->created_at}}</td>
              <td class='p-0'>
                <a href="/users/edit/{{$users->id}}" class="btn btn-primary ml-2 mt-1"><i class="fa fa-pencil"></i></a>
                <a href="{{url('/')}}/users/hapus/{{$users->id}}" class="btn btn-danger mt-1"><i
                    class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endsection