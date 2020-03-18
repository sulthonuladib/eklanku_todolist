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
</head>
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
            <a class="btn btn-sm btn-primary m-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @elseif (Auth::user()->role==1)
            
            <a class="btn btn-sm btn-primary m-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
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
    <body id="main" class="bg">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col margin-kanan-kiri30">
            <h3 align='center' class='m-5'>Projects</h3>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            <a href="{{url('/')}}/leader/create/{{$project}}" class="btn btn-success"><i class="fa fa-plus mr-2"></i>Add
                Task</a><br /><br />

            <table class="table table-striped">
                <thead  id="dataTables" class="bg-dark text-white">
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Divisi</td>
                        <td>Task</td>
                        <td>Deathline</td>
                        <td>Estimasi</td>
                        <td>Berakhir</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=0; ?>
                    @foreach($task as $tasknya)
                    <?php $no++; ?>
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$tasknya->name}}</td>
                        <td>{{$tasknya->divisi}}</td>
                        <td>{{$tasknya->title}}</td>
                        <td>{{$tasknya->deathline}}</td>
                        <td>{{$tasknya->est}}</td>
                        <td>{{$tasknya->end_at}}</td>
                        @if($tasknya->keterangan==0)
                        <td class="card-header alert alert-danger" role="alert">Baru</td>
                        @elseif($tasknya->keterangan==1)
                        <td class="card-header alert alert-warning" role="alert">Proses</td>
                        @elseif($tasknya->keterangan==2)
                        <td class="card-header alert alert-warning" role="alert">Review</td>
                        @else
                        <td class="card-header alert alert-success" role="alert">Done</td>
                        @endif
                        <td>
                            <a href="{{url('/')}}/leader/edit/{{$tasknya->id}}" class="btn btn-primary ml-2 mt-1"><i
                                    class="fa fa-pencil"></i></a>
                            <a href="{{url('/')}}/leader/delete/{{$tasknya->id}}" class="btn btn-danger ml-2 mt-1"><i
                                    class="fa fa-trash"></i></a>
                            <a href="{{url('/')}}/member/detail/{{$tasknya->id}}" class="btn btn-warning ml-2 mt-1">
                                <i class="fa fa-eye"></i></a>
                            <a href="{{url('/')}}/leader/back/{{$tasknya->id}}" class="btn btn-danger ml-2 mt-1">
                                <i class="fa fa-newspaper-o"></i></a>
                            <!-- <a href="{{url('/')}}/leader/proses/{{$tasknya->id}}" class="btn btn-warning ml-2 mt-1"><i
                                        class="fa fa-refresh"></i></a>
                                    <a href="{{url('/')}}/leader/rev/{{$tasknya->id}}" class="btn btn-primary ml-2 mt-1"><i
                                        class="fa fa-refresh"></i></a> -->
                            <a href="{{url('/')}}/leader/done/{{$tasknya->id}}" class="btn btn-success ml-2 mt-1"><i
                                    class="fa fa-check"></i></a>
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>
</div>
</body></html>