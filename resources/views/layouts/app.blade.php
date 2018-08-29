<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @section('head')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ksmithdev.com') }}</title>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

        <script src="{{ asset('js/app.js') }}"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/xs_styles.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sm_styles.css') }}" rel="stylesheet">
        <link href="{{ asset('css/md_styles.css') }}" rel="stylesheet">
        <link href="{{ asset('css/lg_styles.css') }}" rel="stylesheet">
    @show
</head>
<body>
    @section('navigation')
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo" src="{{ asset('img/brand/ks_logo.png') }}"  data-toggle="tooltip" data-html="true" title="ksmithdev.com">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

                    <form class="form-inline" method="post" action="{{ url('/search') }}" style="margin-left: 10px;">
                        {{ csrf_field() }}
                        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
                    </form>

                </div>

            </div>
        </nav>

        @if(isset($page_title))
            <div id="page-title">
                <h1 class="text-center">{{ $page_title }}</h1>
            </div>
        @endif

        @if(isset($navigations))
            <nav class="nav navbar-dark bg-dark navigation">
                @foreach($navigations as $navigation)
                    @if(Request::url() === url('/') . '/' . $navigation->title)
                        <a class="nav-item nav-link active" href="{{ url('/') . '/' . $navigation->title }}">{{ strtoupper($navigation->title) }}</a>
                    @else
                        <a class="nav-item nav-link" href="{{ url('/') . '/' . $navigation->title }}">{{ strtoupper($navigation->title) }}</a>
                    @endif
                @endforeach
            </nav>
        @endif
    @show

    <div id="content-container" class="container-fluid">

        <!-- Alert Message Switch -->
        @if( Session::has('alerts') )
            <div style="height: 20px;"></div>
            @foreach(Session::get('alerts') as $alert)
                @switch($alert->type)
                    @case('success')
                    <div class="alert alert-success" role="alert" style="margin: 0; border-radius: 0;">
                        <span>
                        @if(!empty( $alert->heading ))
                                <b>{{ $alert->heading }} - </b>
                            @endif
                            {{ $alert->message }}</span>
                    </div>
                    @break

                    @case('warning')
                    <div class="alert alert-warning" role="alert" style="margin: 0; border-radius: 0;">
                        <span>
                        @if(!empty( $alert->heading ))
                            <b>{{ $alert->heading }} - </b>
                        @endif
                        {{ $alert->message }}</span>
                    </div>
                    @break

                    @case('danger')
                    <div class="alert alert-danger" role="alert" style="margin: 0; border-radius: 0;">
                        <span>
                        @if(!empty( $alert->heading ))
                                <b>input {{ $alert->heading }} - </b>
                            @endif
                            {{ $alert->message }}</span>
                    </div>
                    @break

                    @case('info')
                    <div class="alert alert-info" role="alert" style="margin: 0; border-radius: 0;">
                        <span>
                        @if(!empty( $alert->heading ))
                                <b>input {{ $alert->heading }} - </b>
                            @endif
                            {{ $alert->message }}</span>
                    </div>
                    @break

                    @default
                    <div class="alert alert-warning" role="alert" style="margin: 0; padding: 10px 0; border-radius: 0;">
                        @if(!empty( $error ))
                            <span class="container">Warning! - {{ $error }}</span>
                        @endif
                    </div>
                    @break

                @endswitch
            @endforeach
            <div style="height: 20px;"></div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>

    </div>
    @section('footer')
        <nav id="footer" class="navbar navbar-dark bg-dark">
            <div id="copyright">kevin smith &copy; 2018</div>
            <div class="row">
                <div class="col">
                    @if(isset($breadcrumbs))
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-dark">
                                @foreach($breadcrumbs as $breadcrumb)
                                    @if(Request::url() === url('/') . '/' . $breadcrumb->title)
                                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</li>
                                    @elseif ($breadcrumb->title === '/')
                                        <li class="breadcrumb-item"><a href="{{ url('/') }}" data-toggle="tooltip" data-html="true" title="ksmithdev.com"><img src="{{ asset('img/brand/ks_logo.png') }}" style="width: 60px; position: relative; top: -19px;"></a></li>
                                    @else
                                        <li class="breadcrumb-item"><a href="{{ url('/') . '/' . $breadcrumb->title }}">{{ $breadcrumb->title }}</a></li>
                                    @endif
                                @endforeach
                            </ol>
                        </nav>
                    @endif
                </div>
            </div>
        </nav>
    @show
</body>
</html>
