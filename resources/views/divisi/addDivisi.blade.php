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
                <div class="card-header">New Divisi</div>

                <div class="card-body">
                    <form method="POST" action="{{url('/')}}/divisi/store">
                        @csrf
                        
                        <div class="form-group">
                            <label for="uid">{{ __('Nama User') }}</label>
                            <select name="uid" id="uid" class="custom-select">
                                @foreach ($user as $users)
                                <option value="{{ $users->id }}">{{$users->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="divisi">Divisi</label>
                            <input id="divisi" name="divisi" type="text" maxlength="255"
                                class="form-control{{ $errors->has('divisi') ? ' is-invalid' : '' }}"
                                autocomplete="off" />
                            @if ($errors->has('divisi'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('divisi') }}</strong>
                            </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection