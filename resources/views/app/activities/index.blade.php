@extends('layout')

@section('content')
<div class="container pagination-div">        
    @if($Activities->total() > 0)
        @foreach($Activities as $activity)
        <hr>
            <div class="row" style="padding:10px">
                <div class="col-md-3">
                    <a href="">
                        <center><img class="img-responsive img-max-list img-shadow " src= 
                            @if ($activity->poster == '')
                                'http://placehold.it/300x200'
                            @else
                                '/images/posters/{{$activity->poster}}'
                            @endif
                        ></center>                            
                    </a>
                </div>
                <div class="col-md-9 no-padding">
                <div class="col-md-12 no-padding">
                    <div class="col-md-8 no-padding"><h4 id='id' class="no-padding" style="margin-top: 0px;">{{ $activity->title }}</h4></div>
                    <div class="col-md-1 no-padding" style="color:#959595"> 
                            <img src="/images/logos/{{$activity->club->logo}}"  height="40" width="40">
                    </div>
                    <div class="col-md-3 no-padding" style="color:#959595"> <h4  class="defaultCountdown"  style="margin-top: 0px;  "><?php
                        $datetime1 = new DateTime($activity->datetime_end);
                        $datetime2 = new DateTime('now');
                        $interval = $datetime2->diff($datetime1);
                        $days = $interval->format('%R%a días y %H horas');
                         if($days < 0 ){
                            echo $interval->format('Hace %a días');
                        }                         
                    ?></h4>
                    </div>
                </div>

                    <div class="col-md-12 no-padding">
                        <div class="col-md-9 no-padding">
                            <h5 style="margin-top: 3px; margin-bottom:3px; font-style: oblique;">{{ $activity->address }}</h5> <div style="color:#00A6FF;">  Del {{ $activity->date_between }}</div>                                    
                            <p>{!! str_limit($activity->description, $limit = 200, $end = '...') !!}</p>
                        </div>
                    </div>
                    <a class="btn btn-primary" href={{ route('activities.show', $activity->id) }}><i class="fa fa-bars"></i>Detalles</a>
                    <a class="btn btn-success" href={{ route('activities.multimedias.show', $activity->id) }}><i class="fa fa-play"></i>Ver multimedia</a>
                    <button  class="btn btn-default button-share" value={{ route('activities.show', $activity->id) }}><i class="fa fa-share-alt"></i>Compartir</button>
                </div>
            </div>
        @endforeach
            <center>{!! $Activities->render() !!}
            <div style="float:right;"> Hay {{ $Activities->total() }} registros</div>
            </center>
    @else
        <center><h3>No hay actividades</h3></center>
    @endif
</div>
    
@endsection
