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
            <table class="table table-striped">
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
                        <td>
                                {{$projectnya->nama_project}}
                            
                        </td>
                        <td>
                            <a href="{{url('/')}}/member/{{$projectnya->id}}" class="btn btn-success ml-2 mt-1"><i
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