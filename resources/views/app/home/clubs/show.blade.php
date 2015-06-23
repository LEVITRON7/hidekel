@extends('layout')

@section('content')
  <div class="container" >
      @if (count($club) > 0)
            <div class="col-md-12 text-center  " style="padding-bottom :10px; margin-bottom :10px;">
                <div class="col-md-12 ">
                        <h4><h3>{{ $club->type }}</h3>
                            <h4>{{ $club->name }}</h4>
                        </h4>
                        <div class="col-md-4 col-centered">
                            <img class="img-max-show " src=
                                @if ($club->logo == '')
                                    'http://placehold.it/300x200'
                                @else
                                    '/images/logos/{{$club->logo}}'
                                @endif
                            alt="">
                        </div>
                    <div class="caption" style="margin-top:10px;"> 
                        <div class="col-md-10 col-centered">
                        <p style="text-align:justify">{!! $club->description !!}</p>
                        </div>               
                        <div class="col-md-12 row-centered">
                        @if(count($club->ideals) != 0)
                            <br>
                            <h3>Ideales de club</h3>
                            @foreach ($club->ideals as $ideal)                            
                                <div class="col-md-4">
                               <center> <h4>{{$ideal->name}} </h4></center>
                                    <div class="col-md-12">
                                    <p style="text-align:center;">{!!$ideal->value !!} </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif                        
                        </div>                         
                        <div class="col-md-10 col-centered">
                        @if(count($club->classes) != 0)
                            <br>
                            <h3>Clases de club</h3>
                            @foreach ($club->classes as $class)                           
                                <div class="col-md-4">
                                <center> <h4>{{$class->name}} </h4></center>
                                    <div class="col-md-10 col-centered" >
                                            <img class="img-max-show"  src=
                                                @if ($class->logo == '')
                                                    'http://placehold.it/300x200'
                                                @else
                                                    '/images/logos/{{$class->logo}}'
                                                @endif
                                            alt="">
                                    </div>
                                </div>  
                            @endforeach
                        @endif 
                        </div>                      
                    </div>
                </div>
                <br>
            </div>
          <br>
      @endif
  </div>
@endsection
