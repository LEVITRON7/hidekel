
@extends('layout')

@section('content')
<div class="container pagination-div" >
    @if ($Events->total()>0)
                @foreach($Events as $event)
                <hr>
                    <div class="row" style="padding:10px" id='{{$event->id}}'>
                        <div class="col-md-3">
                            <a href="">
                                <center><img class="img-responsive img-max-list img-shadow" src=
                                @if($event->poster !='')
                                "/images/posters/{{$event->poster}}"
                                @else
                                'http://placehold.it/300x200'
                                @endif
                                ></center>
                            </a>
                        </div>
                        <div class="col-md-9 no-padding">
                            <div class="col-md-12 no-padding">
                                <div class="col-md-7 no-padding"><h3 id='id' class="no-padding" style="margin-top: 0px;margin-bottom: 5px;">{{ $event->title }}</h3></div>
                                <div class="col-md-1" style="color:#959595">
                                    <img src="/images/logos/{{$event->club->logo}}"  height="35" width="35">
                                </div>
                                <div class="col-md-4 no-padding" style="color:#959595">
                                <div   data-countdown='<?php echo ($event->datetime_start); ?>' class="CountDown"  style="margin-top: 0px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 no-padding">
                                <div class="col-md-9 no-padding">
                                    <h5 style="margin-top: 3px; margin-bottom:3px; font-style: oblique;">{{ $event->address }}</h5> <div style="color:#00A6FF;">  Del {{ $event->date_between }}</div>                                    
                                    <p>{!! str_limit($event->description, $limit = 200, $end = '...') !!}</p>
                                </div>
                            </div>
                            <a class="btn btn-success" href={{ route('events.show', $event->id) }}><i class="fa fa-bars"></i>Detalles</a>
                            <button  class="btn btn-default button-share" value={{ route('events.show', $event->id) }}><i class="fa fa-share-alt"></i>Compartir</button>
                        </div>
                    </div>
                @endforeach

            <center>{!! $Events->render() !!} <div style="float:right;"> Hay {{ $Events->total() }} registros</div></center>
    @else
        <center><h3>No hay eventos próximos</h3></center>
    @endif
</div>

@endsection
 