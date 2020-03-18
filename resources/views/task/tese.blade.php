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
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
            background-color: #ffffff;
            display: block;
            /* border-radius: 5px; */
        }

        .list-judule {
            padding: 5px;
            text-align: center;
            /* background-color: #039BE5; */
            /* background-color:#7095a7; */
            background-color: #8e9318;
            display: block;
            color: white;
            /* border-top-left-radius: 5px;
            border-top-right-radius: 5px; */
            margin-bottom: 5px;
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

        .list-card {
            background-color: #fff;
            border-radius: 3px;
            box-shadow: 0 1px 0 rgba(9, 30, 66, .25);
            cursor: pointer;
            display: block;
            margin-bottom: 8px;
            max-width: 300px;
            min-height: 20px;
            position: relative;
            text-decoration: none;
            z-index: 0;
        }

        .list-card-title {
            clear: both;
            display: block;
            margin: 0 0 4px;
            overflow: hidden;
            text-decoration: none;
            word-wrap: break-word;
            color: #172b4d;
        }

        .list-card-label {
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

        .bg-col {
            /* background-color:#FFFFE0; */
            background-color: #dddada;
            /* border-radius: 5px; */
        }

        .bg {
            /* background-image: url(/images/bg-3.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover; */
            background-color: #F4F4F4;
        }

        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
        }

        /* CSS Terbaru guys */
        .title-atas {
            color: white;
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

        .margin-kanan-kiri30 {
            margin-left: 30px;
            margin-right: 30px;
        }

        .bunder {
            top: 234px;
            left: 98px;
            width: 37px;
            height: 37px;
            background: #E44A40 0% 0% no-repeat padding-box;
            border-radius: 23px;
            opacity: 1;
        }

        .bunder-prh {
            top: 234px;
            left: 98px;
            width: 37px;
            height: 37px;
            background: #E44A40 0% 0% no-repeat padding-box;
            border-radius: 23px;
            opacity: 1;
        }

        .bunder-prm {
            top: 234px;
            left: 98px;
            width: 37px;
            height: 37px;
            background: #FFEE58 0% 0% no-repeat padding-box;
            border-radius: 23px;
            opacity: 1;
        }

        .bunder-prl {
            top: 234px;
            left: 98px;
            width: 37px;
            height: 37px;
            background: #00E676 0% 0% no-repeat padding-box;
            border-radius: 23px;
            opacity: 1;
        }

        .kotak-isi {
            margin-top: 30px;
            background-color: white;
            padding: 20px;
        }

        .set {
            background-image: url(/images/sret3.svg);
        }

        .menue {
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

        }

        .nama-orang {
            width: 180px;
            height: 40px;
            background: #E44A40 0% 0% no-repeat padding-box;
            box-shadow: 0px 3px 6px #00000029;
            border-radius: 10px;
            opacity: 1;
            text-align: center;
            vertical-align: middle;
            line-height: 40px;
            color: white;
        }

        .warna-abu {
            background-color: #F4F4F4;
            padding: 10px;
            margin-top: 20px;
        }

        .kotak-isitask {

            text-align: center;
            background-color: white;
            box-shadow: 0px 3px 6px #00000029;
            color: black;
            border-radius: 10px;
            padding: 5px;
            display: block;
        }

        .mg-tb2 {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }

    </style>
</head>

<body class="bg">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/AllTask') }}">Task Editor</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <!-- Auth Kiri -->

            @if (Auth::user()->role==0)
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/admin') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/users') }}">Users <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/divisi') }}">Divisi <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/project') }}">Project <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            @elseif (Auth::user()->role==1)
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/admin') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/project') }}">Project <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            @else
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/admin') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/project') }}">Project <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            @endif

            <!-- Auth kanan -->
            @if (Route::has('login'))
            @auth
            @if (Auth::user()->role==0)
            <a class="btn btn-sm btn-primary m-2" href="{{url('/')}}/task/index/{{$project}}">
                <i class="fa fa-cog"></i>
            </a>
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            @elseif (Auth::user()->role==1)
            <a class="btn btn-sm btn-primary m-2" href="{{url('/')}}/leader/set/{{$project}}">
                <i class="fa fa-cog"></i>
            </a>
            @else
            <a class="btn btn-sm btn-primary m-2" href="{{ url('/member') }}">
                <i class="fa fa-cog"></i>
            </a>
            @endif
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <!-- <a href="{{ route('register') }}">Register</a> -->
            @endif
            @endauth
            @endif
        </div>
    </nav>
    <script>
        function Ok($id, $pr) {
            $.getJSON("/task/get_sub/" + $pr + "/" + $id, function (data, status) {
                dataType: 'application/json';
                // alert("Data: " + data[0].title + "\nStatus: " + status);
                // console.log(data);
                $.each(data, function (i, field) {
                    // $("#div"+$id ).append('<div id="'+$id+'" class="alert warna-isi" role="alert">' + data[i].title + '</div><hr>');
                    if (data[i].keterangan == '0') {
                        if(data[i].priority == '0'){
                            $("#divpl" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prh btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }else if (data[i].priority == '1'){
                            $("#divpl" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prm btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }else if (data[i].priority == '2'){
                            $("#divpl" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prl btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }
                    } else if (data[i].keterangan == '1') {
                        $("#divbl" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable ui-draggable ui-draggable-handle kotak-isitask m-2 ">' + data[i].title + '</a><hr>');
                        // if(data[i].priority == '0'){
                        //     $("#divbl" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prh btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        // }else if (data[i].priority == '1'){
                        //     $("#divbl" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prm btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        // }else if (data[i].priority == '2'){
                        //     $("#divbl" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prl btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        // }
                    } else if (data[i].keterangan == '2') {
                        if(data[i].priority == '0'){
                            $("#divop" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prh btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }else if (data[i].priority == '1'){
                            $("#divop" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prm btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }else if (data[i].priority == '2'){
                            $("#divop" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prl btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }
                    } else if (data[i].keterangan == '3') {
                        if(data[i].priority == '0'){
                            $("#divrr" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prh btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }else if (data[i].priority == '1'){
                            $("#divrr" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prm btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }else if (data[i].priority == '2'){
                            $("#divrr" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prl btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }
                    } else if (data[i].keterangan == '4') {
                        if(data[i].priority == '0'){
                            $("#divmg" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prh btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }else if (data[i].priority == '1'){
                            $("#divmg" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prm btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }else if (data[i].priority == '2'){
                            $("#divmg" + $id).append('<a href="{{url('member/detail/')}}/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prl btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }
                    } else {
                        if(data[i].priority == '0'){
                            $("#divdn" + $id).append('<a href="{{url(' / ')}}/member/detail/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prh btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }else if (data[i].priority == '1'){
                            $("#divdn" + $id).append('<a href="{{url(' / ')}}/member/detail/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prm btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }else if (data[i].priority == '2'){
                            $("#divdn" + $id).append('<a href="{{url(' / ')}}/member/detail/' + data[i].id + '" id="' + data[i].id + '" class="draggable kotak-isitask m-2 "><button class="d-inline-block text-white m-2 bunder-prl btn btn-sm m-2"> <i class="fa fa-tag"></i></button>' + data[i].title + '</a><hr>');
                        }
                    }
                });
            });
        }
    </script>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">About</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div>
<script>
    function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    }
    </script>
    <div id="main" class="container-fluid">
        <div class="row justify-content-center">
            <div class="col margin-kanan-kiri30">
                <div class="sticky-top row">
                    <div class="d-inline-block m-2 col title-atas">PLANING</div>
                    <div class="d-inline-block m-2 col title-atas">BACK LOG</div>
                    <div class="d-inline-block m-2 col title-atas">ON PROSES</div>
                    <div class="d-inline-block m-2 col title-atas">READY FOR REVIEW</div>
                    <div class="d-inline-block m-2 col title-atas">MERGE</div>
                    <div class="d-inline-block m-2 col title-atas">DONE</div>
                </div>
                <div class="container-fluid kotak-isi">
                    @foreach($user as $namae)
                    <script>Ok('{{$namae->user_id}}', '{{$project}}')</script>
                    <div class="row mg-tb2">
                        <div class="col">
                            <button class="d-inline-block text-white m-2 bunder btn btn-sm m-2">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="d-inline-block m-2 nama-orang">{{$namae->name}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="pl" class="droppable warna-abu">
                                <div id="divpl{{$namae->user_id}}" class="sort">

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div id="bl" class="droppable warna-abu text-center">
                                <div id="divbl{{$namae->user_id}}" class="sort">

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div id="op" class="droppable warna-abu">
                                <div id="divop{{$namae->user_id}}" class="sort">

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div id="rr" class="droppable warna-abu text-center">
                                <div id="divrr{{$namae->user_id}}" class="sort">

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div id="mg" class="droppable warna-abu">
                                <div id="divmg{{$namae->user_id}}" class="sort">

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div id="dn" class="droppable warna-abu text-center">
                                <div id="divdn{{$namae->user_id}}" class="sort">

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    
    <script src="{{ asset('js/dragg.js') }}" > </script>
</body>

</html>