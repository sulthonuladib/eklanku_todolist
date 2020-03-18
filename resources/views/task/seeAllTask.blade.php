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
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <title>Todo Task</title>
    <!-- Styles -->
    <style>
        html,
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #fff;
            color: #636b6f;

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
            text-align: center;
            /* background-color: #039BE5; */
            /* background-color:#7095a7; */
            background-color:#ffffff;
            display: block;
            /* border-radius: 5px; */
        }

        .list-judule {
            padding: 5px;
            text-align: center;
            /* background-color: #039BE5; */
            /* background-color:#7095a7; */
            background-color:#8e9318;
            display: block;
            color:white;
            /* border-top-left-radius: 5px;
            border-top-right-radius: 5px; */
            margin-bottom:5px;
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

        .linksall>a {
            /* color: #FAFAFA; */
            padding: 5px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        /* Trello */
        .list-cards {
            flex: 1 1 auto;
            margin-bottom: 0;
            overflow-y: auto;
            overflow-x: hidden;
            margin: 0 4px;
            padding: 0 4px;
            z-index: 1;
            min-height: 0;
        }
        .list-card{
            background-color: #fff;
            border-radius: 3px;
            box-shadow: 0 1px 0 rgba(9,30,66,.25);
            cursor: pointer;
            display: block;
            margin-bottom: 8px;
            max-width: 300px;
            min-height: 20px;
            position: relative;
            text-decoration: none;
            z-index: 0;
        }
        .list-card-title{
            clear: both;
            display: block;
            margin: 0 0 4px;
            overflow: hidden;
            text-decoration: none;
            word-wrap: break-word;
            color: #172b4d;
        }
        .list-card-label{
            overflow: auto;
            position: relative;
        }
        /* End Trello */
        .list-card-details {
            overflow: hidden;
            padding: 6px 8px 2px;
            position: relative;
            z-index: 10;
        }
        .bg-col{
            /* background-color:#FFFFE0; */
            background-color:#dddada;
            /* border-radius: 5px; */
        }
        .bg {
            /* background-image: url(/images/bg-3.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover; */
            background-color:#F4F4F4;
        }
        ::-webkit-scrollbar {
            width: 12px;
        }
        
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
        }
        /* CSS Terbaru guys */
        .title-atas{
            /* top: 100px; */
            /* left: 86px; */
            width: 200px;
            background: #FD8003 0% 0% no-repeat padding-box;
            border-radius: 10px;
            opacity: 1;
            /* display: block; */
            /* CSS untuk menengahkan element, sesuaikan line-height dengan height */
            text-align: center;
            vertical-align: middle;
            line-height: 50px;
            height: 50px;
            /* End Css Menengah */
        }
        .margin-kanan-kiri30{
            margin-left:30px;
            margin-right:30px;
        }
        .bunder{
            top: 234px;
            left: 98px;
            width: 37px;
            height: 37px;
            background: #E44A40 0% 0% no-repeat padding-box;
            border-radius: 23px;
            opacity: 1;
        }
        .kotak-isi{
            margin-top:30px;
            background-color:white;
        }
    </style>
</head>

<body class="bg">
    <nav class="navbar navbar-expand-md navbar-primary bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ 'Task Editor' }}
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

                    <a href="{{url('/')}}/task/index/{{$project}}" class="m-1">Pengaturan</a>

                    @elseif (Auth::user()->role==1)
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{url('/')}}/leader/set/{{$project}}" class="navbar-brand">Setting</a>
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
    <!-- <body class="bg-primary"> -->
    
        <br>
        <br>
        <div class="container-fluid">
            <main class="py-4">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-white">
                                <div class="">
                                    <div class="uid list-judule">Planning</div>
                                    <div class="card-body-fluid bg-col">
                                        <div id="pl" class="droppable" style="z-index:-1;">
                                            <div class="sort text-row linksall">
                                            @foreach($task as $tasknyaa)
                                                @if($tasknyaa->keterangan==0)    
                                                <a href="{{url('/')}}/member/detail/{{$tasknyaa->id}}" id="{{$tasknyaa->id}}" class="draggable list m-1">{{$tasknyaa->title}}
                                                <div class="div-nama">
                                                    <span class="ml-2 badge badge-light">{{$tasknyaa->name}}</span>
                                                </div>
                                                </a>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="">
                                <div class="uid list-judule">Back log</div>                                   
                                    <div class="card-body-fluid bg-col">
                                        <div id="bl" class="droppable" style="z-index:-1;">
                                            <div class="sort text-row linksall">
                                            @foreach($task as $tasknyaa)
                                                @if($tasknyaa->keterangan==1)    
                                                <a href="{{url('/')}}/member/detail/{{$tasknyaa->id}}" id="{{$tasknyaa->id}}" class="draggable list m-1">{{$tasknyaa->title}}
                                                <div class="div-nama">
                                                    <span class="ml-2 badge badge-primary">{{$tasknyaa->name}}</span>
                                                </div>
                                                </a>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-white">
                                <div class="">
                                    <div class="uid list-judule">On Proses</div>
                                    <div class="card-body-fluid bg-col">
                                        <div id="op" class="droppable" style="z-index:-1;">
                                            <div class="sort text-row linksall">
                                            @foreach($task as $tasknyaa)
                                                @if($tasknyaa->keterangan==2)    
                                                <a href="{{url('/')}}/member/detail/{{$tasknyaa->id}}" id="{{$tasknyaa->id}}" class="draggable list m-1">{{$tasknyaa->title}}
                                                <div class="div-nama">
                                                    <span class="ml-2 badge badge-primary">{{$tasknyaa->name}}</span>
                                                </div>
                                                </a>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-dark">
                                <div class="">
                                    <div class="uid list-judule">Ready for Review</div>
                                    <div class="card-body-fluid bg-col">
                                        <div id="rr" class="droppable">
                                            <div class="sort text-row linksall">
                                            @foreach($task as $tasknyaa)
                                                @if($tasknyaa->keterangan==3)    
                                                <a href="{{url('/')}}/member/detail/{{$tasknyaa->id}}" id="{{$tasknyaa->id}}" class="draggable list m-1">{{$tasknyaa->title}}
                                                <div class="div-nama">
                                                    <span class="ml-2 badge badge-primary">{{$tasknyaa->name}}</span>
                                                </div>
                                                </a>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-dark">
                                <div class="">
                                    <div class="uid list-judule">Merge</div>
                                    <div class="card-body-fluid bg-col">
                                        <div id="mg" class="droppable">
                                            <div class="sort text-row linksall">
                                            @foreach($task as $tasknyaa)
                                                @if($tasknyaa->keterangan==4)    
                                                <a href="{{url('/')}}/member/detail/{{$tasknyaa->id}}" id="{{$tasknyaa->id}}" class="draggable list m-1">{{$tasknyaa->title}}
                                                <div class="div-nama">
                                                    <span class="ml-2 badge badge-primary">{{$tasknyaa->name}}</span>
                                                </div>
                                                </a>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-dark">
                                <div class="">
                                    <div class="uid list-judule">Done</div>
                                    <div class="card-body-fluid bg-col">
                                        <div id="dn" class="droppable">
                                            <div class="sort text-row linksall">
                                            @foreach($task as $tasknyaa)
                                                @if($tasknyaa->keterangan==5)    
                                                <a href="{{url('/')}}/member/detail/{{$tasknyaa->id}}" id="{{$tasknyaa->id}}" class="draggable list m-1">{{$tasknyaa->title}}
                                                <div class="div-nama">
                                                    <span class="ml-2 badge badge-primary">{{$tasknyaa->name}}</span>
                                                </div>
                                                </a>
                                                @endif
                                            @endforeach
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
            $(function () {
                $(".draggable").draggable({ revert: "invalid", snap: "true", snapMode: "inner" });
                $(".droppable").droppable({
                    drop: function (event, ui) {
                        var task_id = $(ui.helper).attr("id");
                        var id_ket = $(this).attr("id");
                        ui.helper.css('top', '');
                        ui.helper.css('left', '');
                        $(this).find('.sort').prepend(ui.helper);
                        $.ajax({
                            url: "/leader/test/" + task_id,
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                task_id: task_id,
                                id_ket: id_ket,

                            },
                            success: function (data) {
                                // alert('your change successfully saved');
                                // alert(JSON.stringify(data));
                            }
                        })

                    }
                });
            });
        </script>
</body>
</html>