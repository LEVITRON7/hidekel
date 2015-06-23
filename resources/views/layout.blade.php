<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title or 'Default'}}</title>
    <!-- Bootstrap Core CSS -->
        {!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::style('css/bootstrap-social.css') !!}

        {!! Html::style('http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css') !!}
        {!! Html::style('css/bootstrap-image-gallery.min.css') !!}
    <!-- Custom CSS -->
        <link rel="shortcut icon" type="image/png" href="{{ asset('images/icons/logo-hidekel-sm.png') }}"/>
        {!! Html::style('css/carousel.css') !!}
        {!! Html::style('css/countDown.css') !!}
        
        {!! Html::style('css/fileinput.min.css') !!}

    <!-- Custom Fonts -->
        @yield('styles')
        {!! Html::style('http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') !!} 
        {!! Html::style('css/styles.css') !!}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
      <div class="container">
        <nav class="navbar navbar-inverse navbar-static-top navbar-fixed-top navbar-custom">
          <div class="container">
            <div class="navbar-header" >
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse "  >                 
              <ul class="nav navbar-nav">
                <li class=""><a class="" href="/"><img src="{{asset('images/icons/logo-hidekel-sm.png') }}" height="20" width="20"> </a></li>
                <li class=""><a href="/">Inicio</a></li>
                <li class="{{ (Request::is('events') ? 'active-nav' : '') }}"><a href="/events">Próximos eventos</a></li>
                <li class="{{ (Request::is('activities') ? 'active-nav' : '') }}"><a href="/activities">Actividades</a></li>
                <li class="{{ (Request::is('activities/multimedias') ? 'active-nav' : '') }}"><a href="/activities/multimedias">Multimedia</a></li>
                <li class="{{ (Request::is('materials') ? 'active-nav ' : '') }}" ><a href="/materials" style="padding-right:0;">Materiales </a></li>
                <li class="dropdown hidden-xs {{ (Request::is('materials') ? 'active-nav' : '') }}">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-caret-down"></i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    <li><a href="/materials"><i class="fa fa-flag fa-fw"></i>&nbsp; Todos </a></li>
                    <li class="divider"></li>
                    @foreach ($materialsmenu as $key => $value)
                      <li><a id="submenu_material_type" href="{{route('materials.all_of_type',$key)}}">{{ $value}}</a></li>
                    @endforeach
                  </ul>
                </li>   
                <li class="{{ (Request::is('home/hidekel') ? 'active-nav' : '') }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nosotros <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level pull-right">
                    <li><a href="{{ route('home.hidekel') }}">Hidekel</a></li>
                    <li class="dropdown-submenu">
                        <a href="{{ route('home.clubs') }}" class="dropdown-toggle" data-toggle="dropdown">Clubes</a>
                        <ul class="dropdown-menu">
                          @foreach ($clubsmenu as $key => $value)
                            <li><a id="submenu_clubs" href="{{route('home.clubs.show',$key)}}">{{ $value}}</a></li>
                          @endforeach
                        </ul>
                    </li>
                    </ul>
                </li>
                        @if (Auth::guest())
                            <li class="{{ (Request::is('*/conta*') ? 'active-nav' : '') }}"><a href="{{ route('home.contact') }}">Contacto</a></li>
                            <li><a href="/auth/login">Login</a></li>
                        @else
                            <li class="{{ (Request::is('admin/*') ? 'active-nav' : '') }}" ><a href="/admin/welcome">Administrar</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->email }} <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/auth/logout">Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    @yield('menu-user')
              </ul>

            </div>
          </div>
        </nav>
      </div>    
      <div class="content" style=" margin-top:60px;">      
        @yield('content')
      </div>
      <div id="location-browser" style="display:none"></div>
      <br>
       <hr class="featurette-divider">
      <!-- FOOTER -->
      <div class="row" style="width:100%;">
      <footer>
      <center>
        <p>&copy; &nbsp;Copyright 2015 &nbsp; Clubes Hidekel &nbsp; &nbsp; |  &nbsp; &nbsp; By  &nbsp; &nbsp;- &nbsp; &nbsp; <a href="http://www.yomatica.com">yomatica</a> </p>
        </center>
      </footer>
      </div>
    <!-- jQuery -->

    {!! Html::script('js/jquery.js') !!}
    <!-- Bootstrap Core JavaScript -->
    {!! Html::script('js/bootstrap.min.js') !!}   
    
    {!! Html::script('http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js') !!}
    {!! Html::script('js/bootstrap-image-gallery.min.js') !!}
    {!! Html::script('https://blueimp.github.io/Gallery/js/blueimp-gallery-youtube.js') !!}      
    {!! Html::script('http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places') !!}
    @yield('scripts')    
    {!! Html::script('js/jquery.countdown.min.js') !!}
    {!! Html::script('js/bootbox.min.js') !!}
    {!! Html::script('js/main.js') !!}
    {!! Html::script('js/google-maps.js') !!}
</body>

</html>
