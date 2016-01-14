<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>-->

    <title>Laravel</title>

    <!-- Fonts -->
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>-->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
      <!--<link rel="stylesheet" href="/css/style.css">-->
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">-->
    <!--<link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">-->
    <!--<link href="/css/font-awesome.css" rel="stylesheet">-->
    
    {{ Html::style('css/bootstrap.min.css') }}
    {{ Html::style('/css/font-awesome.css') }}
    {{ Html::style('/css/style.css') }}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="{{ url('/editprofile') }}">Edit Profile</a></li>
                    <li><a href="{{ url('/fileentry') }}">File Upload/Download/Delete</a></li>
                    <li><a>
                          <?php $lang = ['en'=> 'Choose Language'] ?>
                    {{ Form::open(['action' => 'HomeController@postChangeLanguage']) }}
                    {{Form::select('lang',['en'=>'English','ge'=>'Germany'],$lang,['onchange'=>'submit()'])}}
                    {{Form::close()}}
                    </a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
 <!--<script type="text/javascript" src="/js/jquery-1.11.3.js"></script>-->       
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <!--<script type="text/javascript" src="/js/bootstrap.min.js"></script>-->
  <!--<script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.js"></script>-->
  <!--<script src="/js/jquery.validate.js" type="text/javascript"></script>-->
  <!--<script src="/js/theme.js" type="text/javascript"></script>-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
  <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->

  {{ Html::script('js/jquery-1.11.3.js', array('async' => 'async')) }}
  {{ Html::script('js/bootstrap.min.js', array('async' => 'async')) }}
  {{ Html::script('/js/theme.js', array('async' => 'async')) }}
  {{ Html::script('js/jquery.validate.js', array('async' => 'async')) }}
</body>
</html>
