@extends('appadmin')
    @section('side-center')
        <div class="col-sm-6 col-md-8">
        <div class="row">
            <br>
            <div class="col-md-12 row-centered">
                <center>
                <div class="col-md-6 col-centered">
                <center class="show-image">
                        <img class="img-responsive img-shadow member-photo" src=
                            @if($slide->file !='')
                            "/images/slides/{{$slide->file}}"
                            @else
                            'http://placehold.it/600x500'
                            @endif
                         alt="">
                        <a class="btn btn-primary" data-target='#myModalImage' data-toggle='modal' id='a-show-img'  >Ver imagen</a> 
                </center>
                <br>
                </div>
            </center>
            <br>
            <div class="col-md-12">            
                    <div class="caption">
                        <h4><h3>{{ $slide->title }}</h3>
                            <h5>{{ $slide->event->title or 'No asignado a ningun evento o actividad'}}</h5>
                        </h4>
                        <p>{{ $slide->description }}</p>
 
                    </div>
            </div>
            </div>
            <div class="modal fade" id="myModalImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel">  {{ $slide->title }}</h3>
                  </div>
                  <div class="modal-body-image">
                    <center>
                      <img class="img-responsive" src=
                        @if($slide->file =='')
                        'http://placehold.it/600x500'
                        @else                        
                        "/images/slides/{{$slide->file}}"
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
        </div>
        </div>
    @endsection