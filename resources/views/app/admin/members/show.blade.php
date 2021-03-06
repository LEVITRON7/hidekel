@extends('appadmin')
    @section('side-center')
        <div class="col-sm-6 col-md-8 pagination-div">
<!-- Team Members -->
        <div class="row">
            <br>
            <div class="col-md-12 row-centered">
                <center>
                <div class="col-md-6 col-centered">
                <center class="show-image">
                        <img class="img-responsive img-shadow img-max-show" src=
                                    @if ($member->photo =='')
                                        'http://placehold.it/500x300'
                                    @else
                                        '/images/photos/{{$member->photo}}'
                                    @endif
                         alt="">
                        <a class="btn btn-primary" data-target='#myModalImage' data-toggle='modal' id='a-show-img'  >Ver imagen</a> 
                </center>
                <br>
                </div>
            </center>
            <br>
            <div class="col-md-12">            
                    <h2>{{ $member->full_name }}</h2>                                
                    <h4>{{ $member->clubclass->club->type}}</h4>                
                    <h5>({{$member->clubclass->name}})</h5>
                    <h5><i class="fa fa-gift"></i> &nbsp;<?php $burn =  new Date(strtotime($member->burn)); echo $burn->format('j \d\e F \d\e Y'); ?></h5>
                    <h5><?php $burn =  new Date(strtotime($member->burn)); 
                        $date = new Date('now');
                        $interval = $burn->diff($date);
                    echo $interval->format('%Y años'); ?></h5>
                    <h5>{{$member->user['email']}}</h5>
                    <h5>Actualizado: <?php $updated =  new Datetime(($member->updated_at)); echo $updated->format('j \d\e M \d\e Y  \a \l\a\s h:i:s'); ?></h5>
            </div>
            </div>
            <div class="modal fade" id="myModalImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel">  {{ $member->full_name }}</h3>
                  </div>
                  <div class="modal-body-image">
                    <center>
                      <img class="img-responsive img-max-show" src=
                        @if($member->photo =='')
                        'http://placehold.it/500x300'
                        @else                        
                        "/images/photos/{{$member->photo}}"
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
        <!-- /.row -->
        </div>
    @endsection