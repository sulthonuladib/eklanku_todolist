@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Task</div>
                    <div class="card-body">
                        <table id="dataTables" class="table table-striped">
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Divisi</td>
                                <td>Task</td>
                                <td>Deathline</td>
                                <td>Estimasi</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        @foreach($task as $tasknya)
                            <tr>
                                <td>{{$tasknya->id}}</td>
                                <td>{{$tasknya->name}}</td>
                                <td>{{$tasknya->divisi}}</td>
                                <td>{{$tasknya->title}}</td>
                                <td>{{$tasknya->deathline}}</td>
                                <td>{{$tasknya->est}}</td>
                                @if($tasknya->keterangan==0)
                                <td class="card-header alert alert-danger" role="alert">Baru</td>
                                @elseif($tasknya->keterangan==1)
                                <td class="card-header alert alert-warning" role="alert">Proses</td>
                                @else
                                <td class="card-header alert alert-success" role="alert">Done</td>
                                @endif
                                <td>
                                    <a href="{{url('/')}}/member/detail/{{$tasknya->id}}" class="btn btn-warning mt-1">
                                    <i class="fa fa-eye"></i></a>
                                    <a href="{{url('/')}}/member/proses/{{$tasknya->id}}" class="btn btn-primary mt-1"><i
                                        class="fa fa-refresh"></i></a>
                                    <a href="{{url('/')}}/member/done/{{$tasknya->id}}" class="btn btn-success mt-1"><i
                                        class="fa fa-check"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
