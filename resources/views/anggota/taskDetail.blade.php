@extends('layouts.head')

@section('content')
<link href="{{ asset('css/style-detail.css') }}" rel="stylesheet">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach($task as $tasknya)
                <div class="detailnya">
                    <h3>{{$tasknya->title}}</h3>
                <br>
                <div class="kotak-atas">
                    <b><h5 class="mg-top-bot5" >Status : 
                    @if($tasknya->keterangan==0)
                        Planning
                    @elseif($tasknya->keterangan==1)
                        Back Log
                    @elseif($tasknya->keterangan==2)
                        On Proses
                    @elseif($tasknya->keterangan==3)
                        Ready for Review
                    @elseif($tasknya->keterangan==4)
                        Merge
                    @else
                        Done
                    @endif
                    
                    </h5></b>
                    <b><h5 class="mg-top-bot5" >Deathline : {{$tasknya->deathline}}</h5></b>
                    <b><h5 class="mg-top-bot5" >Berakhir pada : {{$tasknya->end_at}}</h5></b>
                    <b><h5 class="mg-top-bot5" >Priority : 
                    @if($tasknya->priority==0)
                        High
                    @elseif($tasknya->priority==1)
                        Medium
                    @elseif($tasknya->priority==2)
                        Low
                    @endif
                    </h5></b>
                </div>
                <div class="kotak-bawah">
                    {!!$tasknya->detail!!}
                </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-12">
                <div class="card-body bg-light">
                    @foreach($komentar as $komen)
                        <p>{{$komen->name}}<span class="badge badge-pill badge-primary ml-2">{{$komen->created_at}}</span></p>
                        <p>{{$komen->note}}</p>
                    @endforeach
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('/')}}/comment/store">
                        @csrf
                        <input type="hidden" name="task_id" value="{{$tasknya->id}}" />
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="3"></textarea>
                            <input type="submit" value="Kirim" class="btn- btn-sm btn-primary float-right mt-2"/>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>
@endsection
