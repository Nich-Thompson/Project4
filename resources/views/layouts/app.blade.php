<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inspectietool</title>

    <!-- Scripts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
          crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('images/inspectietool.png')}}" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Inspectietool
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @guest

                @else
                    @if(Auth::user()->hasRole('admin'))
                        <ul class="navbar-nav">
                            <a class="nav-link
                            @if(\Illuminate\Support\Facades\Route::current()->getPrefix() == '/customer')
                                activemenu
                            @endif
                                " href="{{ route('getCustomerIndex') }}">Klanten</a>
                        </ul>

                        <ul class="navbar-nav">
                            <a class="nav-link
                            @if(\Illuminate\Support\Facades\Route::current()->getPrefix() == '/inspector')
                                activemenu
                            @endif
                                " href="{{ route('getInspectorIndex') }}">Inspecteurs</a>
                        </ul>

                        <ul class="navbar-nav">
                            <a class="nav-link
                                @if(\Illuminate\Support\Facades\Route::current()->getPrefix() == '/inspectiontype')
                                activemenu
                                @endif
                                " href="{{ route('getInspectionTypeIndex') }}">Inspectietypes</a>
                        </ul>

                        <ul class="navbar-nav">
                            <a class="nav-link
                            @if(\Illuminate\Support\Facades\Route::current()->getPrefix() == '/template')
                                activemenu
                            @endif
                                " href="{{ route('getTemplateIndex') }}">Inspectietemplates</a>
                        </ul>

                        <ul class="navbar-nav dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Lijsten
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('getListCreate') }}">+ Nieuwe lijst</a>
                                <div class="dropdown-divider"></div>
                                @php
                                    $lists = \App\Models\ListModel::all();
                                @endphp
                                @foreach($lists as $list)
                                    <a class="dropdown-item"
                                       href="{{ route('getListEdit', $list->id) }}">{{ $list->name }} {{$list->sublist()->first() == null ? '(Hoofdlijst)':''}}</a>
                                @endforeach
                            </div>
                        </ul>
                    @endif
                    @if(Auth::user()->hasRole('inspecteur'))
                        <ul class="navbar-nav">
                            @if(\Illuminate\Support\Facades\Route::current()->getPrefix() == '/customer')
                                <a class="nav-link activemenu" href="{{ route('getCustomerIndex') }}">Klanten</a>
                            @else
                                <a class="nav-link" href="{{ route('getCustomerIndex') }}">Klanten</a>
                            @endif
                        </ul>
                @endif
            @endguest

            <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->hasRole('inspecteur'))
                                    @include('components.help-inspector')
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('auth.Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>
</div>
</body>
</html>
