<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/yes.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-tese1.css') }}" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Todo Task</title>
    <style>
        .placeholder {
            background-color: #F4F4F4;
            min-height: 100px;
            box-shadow: 5px 10px red;
        }

        .sort {
            min-height: 100px;
        }
    </style>
</head>

<body id="main" class="bg">
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

            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            @elseif (Auth::user()->role==1)

            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
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

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        @auth
        @if (Auth::user()->role==0)
        <a class="btn btn-sm btn-primary m-2" href="{{url('/')}}/task/index/{{$project}}">
            <i class="fa fa-cog m-1 float-left"></i>Project
        </a>
        @elseif (Auth::user()->role==1)
        <a class="btn btn-sm btn-primary m-2" href="{{url('/')}}/leader/set/{{$project}}">
            <i class="fa fa-cog m-1 float-left"></i>Project
        </a>
        @endif
        @endauth
        <div class="container">
            <div class="row">
                <div class="col">
                    @foreach($link as $linke)
                    <div class="kotaklink ">
                        <a class="btn btn-sm btn-primary linke m-2" target="_blank" href="{{$linke->links}}">
                            <i class="fa fa-tag m-1 float-left"></i>{{$linke->links}}
                        </a>
                        <a href="{{url('/')}}/task/destlink/{{$linke->id}}" class="close"><i
                                class="fa fa-times"></i></a>
                    </div>
                    @endforeach
                </div>
            </div>
            <form method="POST" action="{{url('/')}}/task/addlinks">
                @csrf
                <div class="form-group">
                    <input id="nama" name="nama" type="text" placeholder="Add Judul" class="form-control" />
                </div>
                <div class="form-group">
                    <input id="links" name="links" type="text" placeholder="Add Links" class="form-control" />
                </div>
                <div class="form-group">
                    <button class="btn btn-sm btn-primary m-2" type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginRight = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginRight = "0";
        }
    </script>
    <div class="container-fluid">
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

                    @foreach($member as $namae)
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
                            <div class="droppable warna-abu">
                                <div id="pl" class="sort">
                                    @foreach($task as $tasknyaa)
                                    @if($tasknyaa->name == $namae->name)
                                    @if($tasknyaa->keterangan==0)
                                    @if($tasknyaa->priority==0)

                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}"
                                        id="{{$tasknyaa->id}}" class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prh btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @elseif($tasknyaa->priority==1)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}"
                                        id="{{$tasknyaa->id}}" class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prm btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @elseif($tasknyaa->priority==2)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}"
                                        id="{{$tasknyaa->id}}" class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prl btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @endif
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="droppable warna-abu text-center">
                                <div id="bl" class="sort">
                                    @foreach($task as $tasknyaa)
                                    @if($tasknyaa->name == $namae->name)
                                    @if($tasknyaa->keterangan==1)
                                    @if($tasknyaa->priority==0)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}"
                                        id="{{$tasknyaa->id}}" class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prh btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @elseif($tasknyaa->priority==1)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}"
                                        id="{{$tasknyaa->id}}" class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prm btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @elseif($tasknyaa->priority==2)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}"
                                        id="{{$tasknyaa->id}}" class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prl btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @endif
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="droppable warna-abu">
                                <div id="op" class="sort">
                                    @foreach($task as $tasknyaa)
                                    @if($tasknyaa->name == $namae->name)
                                    @if($tasknyaa->keterangan==2)
                                    @if($tasknyaa->priority==0)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}" id="{{$tasknyaa->id}}"
                                        class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prh btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @elseif($tasknyaa->priority==1)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}" id="{{$tasknyaa->id}}"
                                        class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prm btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @elseif($tasknyaa->priority==2)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}" id="{{$tasknyaa->id}}"
                                        class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prl btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @endif
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div id="rr" class="droppable warna-abu text-center">
                                <div id="rr" class="sort">
                                    @foreach($task as $tasknyaa)
                                    @if($tasknyaa->name == $namae->name)
                                    @if($tasknyaa->keterangan==3)
                                    @if($tasknyaa->priority==0)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}" id="{{$tasknyaa->id}}"
                                        class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prh btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @elseif($tasknyaa->priority==1)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}" id="{{$tasknyaa->id}}"
                                        class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prm btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @elseif($tasknyaa->priority==2)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}" id="{{$tasknyaa->id}}"
                                        class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prl btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @endif
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div id="mg" class="droppable warna-abu">
                                <div id="mg"  class="sort">
                                    @foreach($task as $tasknyaa)
                                    @if($tasknyaa->name == $namae->name)
                                    @if($tasknyaa->keterangan==4)
                                    @if($tasknyaa->priority==0)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}" id="{{$tasknyaa->id}}"
                                        class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prh btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @elseif($tasknyaa->priority==1)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}" id="{{$tasknyaa->id}}"
                                        class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prm btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @elseif($tasknyaa->priority==2)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}" id="{{$tasknyaa->id}}"
                                        class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prl btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @endif
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="droppable warna-abu text-center">
                                <div id="dn"  class="sort">
                                    @foreach($task as $tasknyaa)
                                    @if($tasknyaa->name == $namae->name)
                                    @if($tasknyaa->keterangan==5)
                                    @if($tasknyaa->priority==0)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}" id="{{$tasknyaa->id}}"
                                        class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prh btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @elseif($tasknyaa->priority==1)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}" id="{{$tasknyaa->id}}"
                                        class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prm btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @elseif($tasknyaa->priority==2)
                                    <a href="{{url('member/detail/')}}/{{$tasknyaa->id}}" data-index="{{$tasknyaa->position}}" id="{{$tasknyaa->id}}"
                                        class="draggable kotak-isitask m-2 "><button
                                            class="d-inline-block text-white m-2 bunder-prl btn btn-sm m-2"> <i
                                                class="fa fa-tag"></i></button>{{$tasknyaa->title}}</a>
                                    @endif
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $(".sort").sortable({
                connectWith: ".sort",
                update:function(event, ui){
                    // console.log($(this).context.lastChild.dataset);
                    $(this).children().each(function (index){
                        // console.log(index);
                        if ($(this).attr('data-index') != (index+1)){
                            $(this).attr('data-index', (index+1)).addClass('updated');
                        }
                    });
                    saveNewPositions();
                },
                receive: function (event, ui) {
                    var send = ui.sender[0].id;
                    var rec = this.id;
                    var task_id = ui.item[0].id;
                    // var pos = ui.data;
                    console.log("dropped on = " + rec); // Where the item is dropped
                    // console.log("sender = "+ send); // Where it came from
                    console.log("item = " + task_id); //Which item (or ui.item[0].id)
                    // console.log("position = " + [0].lastChild.dataset); //Which item (or ui.item[0].id)

                    $.ajax({
                        url: "/leader/test/" + task_id,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            task_id: task_id,
                            id_ket: rec,

                        },
                        success: function (data) {
                            // alert('your change successfully saved');
                            // alert(JSON.stringify(data));
                        }
                    })
                }

            }).disableSelection();
        });
        function saveNewPositions(){
            var positions = [];
            $('.updated').each(function(){
                positions.push([$(this).attr('id'), $(this).attr('data-index')]);
                $(this).removeClass('updated');
            });
            console.log(positions);
            $.ajax({
                url: "/leader/position",
                type: 'POST',
                dataType:'text',
                data: {
                        "_token": "{{ csrf_token() }}",
                        // update:1,
                        positions:positions,
                    },
                    success: function (data) {
                        // alert('your change successfully saved');
                        // alert(JSON.stringify(data));
                        alert('Sukses');
                    }
            })
        }
    </script>
</body>

</html>