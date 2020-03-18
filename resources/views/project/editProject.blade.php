@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="card card-new-task">
                <div class="card-header">Edit Project</div>
                @foreach($project as $projectnya)
                <div class="card-body">
                    <form method="POST" action="{{url('/')}}/project/update/{{$projectnya->id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_project">{{ __('Nama Project') }}</label>
                            <input type="text" class="form-control" name="nama_project" id="nama_project" value="{{$projectnya->nama_project}}"/>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection