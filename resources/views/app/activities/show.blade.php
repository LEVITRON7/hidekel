@extends('layout')
    @section('content')
        <div class="container">
        <!-- Team Members -->
        <div class="absolute"><a class="btn btn btn-default" href="{{ URL::previous() }}"> <i class="fa fa-arrow-left"></i>  Atras</a></div>
        <div class="row row-centered">
            <div class="col-md-4 col-centered" >
            <center class="show-image">
                    <img class="img-max-show img-responsive " src=
                        @if($activity->poster !='')
                        "/images/posters/{{$activity->poster}}"
                        @else
                        'http://placehold.it/400x300'
                        @endif
                     alt="">           
            <a class="btn btn-primary" data-target='#myModalImage' data-toggle='modal' id='a-show-img'  >Ver imagen</a>
            </center>                     
            </div>

            <div class="col-md-12 text-center">
                <div class="col-md-12">
                    <div class="col-md-12">
                            <h3 >{{ $activity->title }}</h3>
                            <h4> {{ $activity->club->type }} &nbsp; {{ $activity->club->name }}</h4>
                            <h5> {{ $activity->address }}</h5>
                            <h5 style="color:#00A6FF;">{{ $activity->date_between }}</h5 >
                    </div>
                    <div class="col-md-10 col-centered">
                    <p>{!! $activity->description !!}</p>
                    </div>
                    <div class="col-md-12">
                    <center>
                        <div class="col-md-3 col-center ">
                                <a class="btn btn-success full-width" href='{{route('activities.multimedias.show',$activity->id)}}'> <i class="fa fa-play"></i> Multimedia</a>
                        </div>

                        <div class="col-md-3 col-center ">
                                <a class="btn btn-primary full-width" data-target='#myModal' data-toggle='modal' > <i class="fa fa-map-marker"></i> Ver mapa</a>
                        </div>
                        <div class="col-md-3 col-center ">
                            <button  class="btn btn-default button-share full-width" value={{ route('activities.show', $activity->id) }}><i class="fa fa-share-alt"></i>Compartir</button>
                        </div>  
                    </center>
                    </div>

            </div>
            <div class="col-md-8">                    
                    <input type="text" id="location_latitude" value="{{$activity->location_latitude}}" hidden>
                    <input type="text" id="location_longitude" value="{{$activity->location_longitude}}" hidden>
            </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Modal for Image-->
            <div class="modal fade" id="myModalImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel">  {{ $activity->title }}</h3>
                  </div>
                  <div class="modal-body-image">
                    <center>
                      <img class="img-responsive img-max-show" src=
                        @if($activity->poster !='')
                        "/images/posters/{{$activity->poster}}"
                        @else
                        'http://placehold.it/400x300'
                        @endif
                       alt="">
                   </center>
                  </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal for Map-->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel"> Ubicación del evento</h3>
                  </div>
                  <div class="modal-body modal-body-map" style="height: 60%;">
                    <div id="map_canvas"class="map_event"></div> 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Como llegar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    @endsection

