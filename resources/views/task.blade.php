<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <title>Todo Task</title>
    <!-- Styles -->
    <style>
        html,
        body {
            /* background-color: #d8c1ab; */
            background-color:#1e728b;
            color: #636b6f;
            font-family: 'Montserrat', sans-serif;
            /* font-family: 'Nunito', sans-serif; */
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
        .warna-card{
            background-color:#f4f4f4;
        }
        .warna-isi{
            background-color:#ffffff;
        }
    </style>
    <script>
        function Ok($id) {
            $.getJSON("/task/get_sub/" + $id, function (data, status) {
                dataType: 'application/json';
                // alert("Data: " + data[0].title + "\nStatus: " + status);
                // console.log(data);
                $.each(data, function (i, field) {
                    if (data[i].keterangan == '0') {
                        $("#div" + $id).append('<div class="alert warna-isi" role="alert">' + data[i].title + '</div><hr>');
                    } else if (data[i].keterangan == '1') {
                        $("#div" + $id).append('<div class="alert  warna-isi" role="alert">' + data[i].title + '</div><hr>');
                    } else if (data[i].keterangan == '2') {
                        $("#div" + $id).append('<div class="alert  warna-isi" role="alert">' + data[i].title + '</div><hr>');
                    } else {
                        $("#div" + $id).append('<div class="alert  warna-isi" role="alert">' + data[i].title + '</div><hr>');
                    }
                });
            });
        }
    </script>
</head>

<body>
    <div id="top"></div>
    @if (Route::has('login'))
    <div class="top-right links">
        @auth
        @if (Auth::user()->role==0)
        <a href="{{ url('/admin') }}">Home</a>
        @elseif (Auth::user()->role==1)
        <a href="{{ url('/leader') }}">Home</a>
        @else
        <a href="{{ url('/member') }}">Home</a>
        @endif
        @else
        <a href="{{ route('login') }}">Login</a>

        @if (Route::has('register'))
        <!-- <a href="{{ route('register') }}">Register</a> -->
        @endif
        @endauth
    </div>
    @endif
</body>
<br>
<br>
<div class="container-fluid">
    <main class="py-4">
        
            <!-- <div class="card-header">Task </div> -->
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        @foreach($user as $tasknya)
                        <div class="col">
                            <div class="card text-dark warna-card mb-3">
                            <!-- <div class="card text-dark bg-warning mb-3"> -->
                                <div class="uid card-header text-dark">{{$tasknya->name}}</br></div>
                                <script>Ok('{{$tasknya->id}}')</script>

                                <div id="div{{$tasknya->id}}" class="card-body">

                                </div>
                            </div>
                        </div>
                        @endforeach
                        <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
                    </div>
                </div>
            </div>
        
    </main>
</div>

<div id="bottom"></div>
<!-- <script type="text/javascript" src="{{asset ('/js/tasknyaa.js')}}"></script> -->
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

// (function($){
//     $.fn.downAndUp = function(time, repeat){
//         var elem = this;
//         (function dap(){
//             elem.animate({scrollLeft:elem.outerWidth()}, time, function(){
//                 elem.animate({scrollLeft:0}, time, function(){
//                     if(--repeat) dap();
//                 });
//             });
//         })();
//     }
// })(jQuery);
// $("html").downAndUp(2000, 5)
</script>
</html>