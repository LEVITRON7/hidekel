@extends('appadmin')
    @section('side-center')
        <div class="col-sm-6 col-md-8 pagination-div">
        <div  id="results">
            @if($events->total() > 0)
            @foreach($events as $event)
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
                        <div class="col-md-8 no-padding"><h4 id='id' class="no-padding" style="margin-top: 0px;margin-bottom: 5px;">{{ $event->title }}</h4></div>
                        <div class="col-md-1 no-padding" style="color:#959595">
                            <img src="/images/logos/{{$event->club->logo}}"  height="35" width="35">
                        </div>
                        <div class="col-md-3 no-padding" style="color:#959595">
                        <div   data-countdown='<?php echo ($event->datetime_start); ?>' class="CountDown"  style="margin-top: 0px;font-size:1em;">
                            </div>
                        </div>
                    </div>
                        <h5 style="margin-top: 3px; margin-bottom:3px; font-style: oblique;">{{ $event->address }}</h5> <div style="color:#00A6FF;">  Del {{ $event->date_between }}</div>
                        <p>{!! str_limit($event->description, $limit = 100, $end = '...')  !!}</p>
                        <a class="btn btn-success" href={{ route('admin.events.show', $event->id) }}><i class="fa fa-bars"></i>Detalles</a>
                        <button  class="btn btn-default button-share" value={{ route('events.show', $event->id) }}><i class="fa fa-share-alt"></i>Compartir</button>
                        <a class="btn btn-info" href={{ route('admin.events.edit', $event->id) }}> <i class="fa fa-pencil-square-o"></i>Editar </a>
                        <button class="btn btn-danger" href={{ route('admin.events.delete', $event->id) }} value={{$event->id}}> <i class="fa fa-trash"></i>Eliminar </button>
                    </div>
                </div>
            @endforeach

                <center>{!! $events->render() !!}   <div style="float:right;"> Hay {{ $events->total() }} registros</div> </center>
            @else
                <center><h3>No hay eventos próximos</h3></center>
                <br>
                <center><a href="{{route('admin.events.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>Agregar evento próximo</a></center>
            @endif                
        </div>
        </div>
    @endsection