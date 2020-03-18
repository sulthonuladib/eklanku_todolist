<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <title>Todo Task</title>
    <!-- Styles -->
    <style>

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

        .warna-card {
            background-color: #f4f4f4;
        }

        .warna-isi {
            background-color: #ffffff;
        }
        .atase{
            /* height: 80px; */
            background-color: #F4F4F4;
            border-radius: 10px 10px 0px 0px;
            text-align: center;
            vertical-align: middle;
            /* line-height: 50px; */
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
        .warna-abu{
            background-color:#F4F4F4;
            padding:10px;
            margin-top:20px;
        }
        .kotak-isitask{
            text-align: center;
            background-color:white;
            box-shadow: 0px 3px 6px #00000029;
            color:black;
            border-radius: 10px;
            padding:5px;
            display:block;
        }
        .bg-putih{
            background-color: white;
        }
        .kotak-container{
            padding:40px;
        }
    </style>
    <script>
        function Ok($id) {
            $.getJSON("/task/get_sub/" + $id, function (data, status) {
                dataType: 'application/json';
                // alert("Data: " + data[0].title + "\nStatus: " + status);
                console.log("heee");
                $.each(data, function (i, field) {
                    $("#div" + $id).append('<div class="alert kotak-isitask" role="alert">' + data[i].title + '</div><hr>');     
                });
            });
        }
    </script>
</head>

<body class="bg-putih">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/AllTask') }}">Task View</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
                </li>
            </ul>
            @if (Route::has('login'))
            @auth
            @if (Auth::user()->role==0)
            <a class="btn btn-sm btn-primary m-2" href="{{ url('/admin') }}">
                <i class="fa fa-cog"></i>
            </a>
            @elseif (Auth::user()->role==1)
            <a class="btn btn-sm btn-primary m-2" href="{{ url('/leader') }}">
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

    <div class="container-fluid kotak-container">
        <div class="row">
            @foreach($user as $namae)
            <script>Ok('{{$namae->id}}')</script>
            <div class="col m-2">
                <div class="atase">
                    <button class="d-inline-block text-white m-2 bunder btn btn-sm m-2">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="d-inline-block m-2 text-dark">{{$namae->name}}</div>
                </div>
                <div class="warna-abu">
                    <div id="div{{$namae->id}}" class="m-2"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('347a9f8368ae5c56f4a0', {
        cluster: 'ap1',
        forceTLS: true
    });
    // <link href="{{ asset('css/yes.css') }}" rel="stylesheet">

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function (data) {
        //   alert(JSON.stringify(data));

        responsiveVoice.setDefaultVoice("Indonesian Female");
        responsiveVoice.speak(data);

        setTimeout(function () { location.reload(); }, 20000);

    });
</script>
<script>
    (function($){
    $.fn.downAndUp = function(time, repeat){
        var elem = this;
        (function dap(){
            elem.animate({scrollTop:elem.outerHeight()}, time, function(){
                elem.animate({scrollTop:0}, time, function(){
                    if(--repeat) dap();
                });
            });
        })();
    }
})(jQuery);
$("html").downAndUp(7500, 5000)
</script>
</body>

</html>