@extends('layouts.head')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col margin-kanan-kiri30">
            <h3 align='center' class='m-5'>Divisi</h3>
            <a href="{{url('/')}}/divisi/create" class="btn btn-success"><i class="fa fa-plus mr-2"></i>Add Divisi</a><br/><br/>
            <table  id="dataTables" class="table table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Divisi</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=0; ?>
                    @foreach($divisi as $divisi)
                    <?php $no++; ?>

                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$divisi->name}}</td>
                        <td>{{$divisi->divisi}}</td>
                        <td>
                            <a href="{{url('/')}}/divisi/edit/{{$divisi->id}}" class="btn btn-primary ml-2 mt-1"><i
                                    class="fa fa-pencil"></i></a>
                            <a href="{{url('/')}}/divisi/delete/{{$divisi->id}}" class="btn btn-danger ml-2 mt-1"><i
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