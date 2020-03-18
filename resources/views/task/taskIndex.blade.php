@extends('layouts.head')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col margin-kanan-kiri30">
            <h3 align='center' class='m-5'>Projects</h3>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            <a href="{{url('/')}}/task/create/{{$project}}" class="btn btn-success"><i class="fa fa-plus mr-2"></i>Add
                Task</a><br/><br/>

            <table  id="dataTables" class="table table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Divisi</td>
                        <td>Task</td>
                        <!-- <td>Detail</td> -->
                        <!-- <td>Deathline</td> -->
                        <td>Estimasi</td>
                        <td>Berakhir</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=0; ?>
                    @foreach($task as $tasknya)
                    <?php $no++; ?>
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$tasknya->name}}</td>
                        <td>{{$tasknya->divisi}}</td>
                        <td>{{$tasknya->title}}</td>
                        <!-- <td>{!!$tasknya->detail!!}</td> -->
                        <!-- <td>{{$tasknya->deathline}}</td> -->
                        <td>{{$tasknya->est}}</td>
                        <td>{{$tasknya->end_at}}</td>
                        @if($tasknya->keterangan==0)
                        <td class=" alert alert-primary" role="alert">Planning</td>
                        @elseif($tasknya->keterangan==1)
                        <td class=" alert alert-danger" role="alert">Back Log</td>
                        @elseif($tasknya->keterangan==2)
                        <td class=" alert alert-warning" role="alert">On Proses</td>
                        @elseif($tasknya->keterangan==3)
                        <td class=" alert alert-primary" role="alert">Ready for Review</td>
                        @elseif($tasknya->keterangan==4)
                        <td class=" alert alert-info" role="alert">Merge</td>
                        @else
                        <td class=" alert alert-success" role="alert">Done</td>
                        @endif
                        <td>
                            <a href="{{url('/')}}/task/edit/{{$tasknya->id}}" class="btn btn-primary ml-2 mt-1"><i
                                    class="fa fa-pencil"></i></a>
                            <a href="{{url('/')}}/task/delete/{{$tasknya->id}}" class="btn btn-danger ml-2 mt-1"><i
                                    class="fa fa-trash"></i></a>
                            <a href="{{url('/')}}/member/detail/{{$tasknya->id}}" class="btn btn-warning ml-2 mt-1">
                                <i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>
</div>
@endsection