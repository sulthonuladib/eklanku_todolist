@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="card card-new-task">
                <div class="card-header">Edit Task</div>

                <div class="card-body">
                    @foreach($task as $tasknyaa)
                    <form method="POST" action="{{url('/')}}/task/update/{{ $tasknyaa->id }}">
                        @csrf
                        <input type="hidden" name="project_id" value="{{$tasknyaa->project_id}}"/>
                        <div class="form-group">
                            <label for="uid">{{ __('Nama User') }}</label>
                            <select name="uid" id="uid" class="custom-select">
                                <option value="{{ $tasknyaa->user_id }}">{{$tasknyaa->name}}</option>
                                @foreach ($user as $users)
                                <option value="{{ $users->id }}">{{$users->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Divisi') }}</label>
                            <select class="custom-select" id="sub_kategori" name="divisi_id">
                                <option value="{{$tasknyaa->divisi_id}}" selected>{{$tasknyaa->divisi}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="priority">{{ __('Priority') }}</label>
                            <select class="custom-select" id="priority" name="priority">
                                <option value="{{$tasknyaa->priority}}" selected>
                                    @if($tasknyaa->priority==0)
                                        High
                                    @elseif($tasknyaa->priority==1)
                                        Medium
                                    @elseif($tasknyaa->priority==1)
                                        Low
                                    @endif
                                </option>
                                <option value="0" >High</option>
                                <option value="1" >Medium</option>
                                <option value="2" >Low</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" name="title" type="text" maxlength="255"
                                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                autocomplete="off" value="{{$tasknyaa->title}}"/>
                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="detail">Detail</label>
                            <!-- <textarea id="detail" name="detail" class="form-control ckeditor">{{$tasknyaa->detail}}</textarea> -->
                            <textarea id="my-editor" name="detail" class="form-control">{{$tasknyaa->detail}}</textarea>

                        </div>
                        
                        <div class="form-group">
                            <label for="dt">Deathline</label>
                            <input id="dt" name="dt" type="date" maxlength="255"
                                class="form-control{{ $errors->has('dt') ? ' is-invalid' : '' }}"
                                autocomplete="off" value="{{$tasknyaa->deathline}}"/>
                            @if ($errors->has('dt'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dt') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="est">Estimasi Waktu Penyelesaian</label>
                            <input type="disabled" value="{{$tasknyaa->est}}" name="est_old" class="form-control">
                            <br>Hour : <input type="number" name="h" min="0" class="form-control">
                        </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset ('/js/add_lead.js')}}"></script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
                <script>
                var options = {
                    filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
	                filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                };
                </script>
                <script type="text/javascript">
                    CKEDITOR.replace( 'my-editor', options);
                </script>
@endsection