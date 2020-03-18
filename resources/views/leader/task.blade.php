<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/yes.css') }}" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <title>Todo Task</title>
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .title {
            font-size: 84px;
        }
        .list {
            padding: 5px;
            background-color: lightblue;
            border: 1px solid gray;
            text-align: center;
            display: block;
            border-radius: 10px;
        }
        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if (Route::has('login'))
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
    
                </ul>
    
                <div class="top links">
                    @auth
                    @if (Auth::user()->role==0)
                    <a href="{{ url('/admin') }}">Setting</a>
                    @elseif (Auth::user()->role==1)
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="navbar-brand" href="{{ url('/project/') }}">Project</a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand" href="{{ url('/leader/set') }}">Pengaturan</a>
                        </li>
                        <li class="nav-item">
    
                            <a class="navbar-brand" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
    
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="navbar-brand" href="{{ url('/member') }}">Home</a>
                        </li>
                        <li class="nav-item">
    
                            <a class="navbar-brand" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
    
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    @endif
    
                    @else
                    <a href="{{ route('login') }}">Login</a>
    
                    @if (Route::has('register'))
                    <!-- <a href="{{ route('register') }}">Register</a> -->
                    @endif
    
                    @endauth
            </div>
                @endif
        </div>
    </nav>
</body>
<br>
<br>
    <div class="container">
        <main class="py-4">
            <div class="card">
                <div class="card-header">Task</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                <div class="uid card-header">Back log</div>                                   
                                    <div class="card-body">
                                        <div id="bl" class="droppable">
                                            <div class="sort text-row">
                                            @foreach($task as $tasknyaa)
                                                @if($tasknyaa->keterangan==0)    
                                                <a href="{{url('/')}}/member/detail/{{$tasknyaa->id}}" id="{{$tasknyaa->id}}" class="draggable list">{{$tasknyaa->title}}</a>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="uid card-header">On Proses</div>                   
                                    <div class="card-body">
                                        <div id="op" class="droppable">
                                            <div class="sort text-row">
                                                @foreach($task as $tasknyaa)
                                                    @if($tasknyaa->keterangan==1)
                                                    <a href="{{url('/')}}/member/detail/{{$tasknyaa->id}}" id="{{$tasknyaa->id}}" class="draggable list">{{$tasknyaa->title}}</a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="uid card-header">Ready for Review</div>                   
                                    <div class="card-body">
                                        <div id="rr" class="droppable">
                                            <div class="sort text-row">
                                                @foreach($task as $tasknyaa)
                                                    @if($tasknyaa->keterangan==2)
                                                    <a href="{{url('/')}}/member/detail/{{$tasknyaa->id}}" id="{{$tasknyaa->id}}" class="draggable list">{{$tasknyaa->title}}</a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="uid card-header">Done</div>                   
                                        <div class=" card-body">
                                            <div id="do" class="droppable">
                                                <div class="text-row">
                                                    @foreach($task as $tasknyaa)
                                                        @if($tasknyaa->keterangan==3)
                                                        <a href="{{url('/')}}/member/detail/{{$tasknyaa->id}}" id="{{$tasknyaa->id}}" class="list">{{$tasknyaa->title}}</a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<script>
  $( function() {
    $(".draggable").draggable({ revert: "invalid", snap: "true", snapMode: "inner" });
    $(".droppable").droppable({
        drop: function( event, ui ) {
            var task_id = $(ui.helper).attr("id");
            var id_ket = $(this).attr("id");
            ui.helper.css('top','');
            ui.helper.css('left','');
            $(this).find('.sort').prepend(ui.helper);
            $.ajax({
                url:"/leader/test/"+task_id,
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    task_id:task_id,
                    id_ket:id_ket,
                
                },
                success:function(data){
                    // alert('your change successfully saved');
                    alert(JSON.stringify(data));
                }
            })

        }
    });  
  });
  </script>

</html>