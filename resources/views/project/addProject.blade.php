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
                <div class="card-header">New Task</div>

                <div class="card-body">
                    <form method="POST" action="{{url('/')}}/project/store" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_project">{{ __('Nama Project') }}</label>
                            <input type="text" class="form-control" name="nama_project" id="nama_project" />
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection