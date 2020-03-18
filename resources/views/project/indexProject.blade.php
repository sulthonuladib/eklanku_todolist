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
            <a href="{{url('/')}}/project/create" class="btn btn-success"><i class="fa fa-plus mr-2"></i>Add
                Project</a><br /><br />
            <table  id="dataTables" class="table table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=0; ?>
                    @foreach($project as $projectnya)
                    <?php $no++; ?>
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$projectnya->nama_project}}</td>
                        <td>
                            <a href="{{url('/')}}/project/edit/{{$projectnya->id}}" class="btn btn-primary ml-2 mt-1"><i
                                    class="fa fa-pencil"></i></a>
                            <a href="{{url('/')}}/project/delete/{{$projectnya->id}}"
                                class="btn btn-danger ml-2 mt-1"><i class="fa fa-trash"></i></a>
                            <a href="{{url('/')}}/task/see/{{$projectnya->id}}" class="btn btn-success ml-2 mt-1"><i
                                    class="fa fa-check"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection