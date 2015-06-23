@extends('appadmin')
    @section('side-center')
        <div class="col-sm-6 col-md-8">
<!-- Team Members -->
        <div class="row">
             <br>
            <div class="col-md-12 row-centered">
                <div class="col-md-6 col-centered">
                    <center class="show-image">
                            <img class="img-responsive img-shadow member-photo" src=
                                        @if ($user->member->photo =='')
                                            'http://placehold.it/500x300'
                                        @else
                                            '/images/photos/{{$member->photo}}'
                                        @endif
                             alt="">
                            <a class="btn btn-primary" data-target='#myModalImage' data-toggle='modal' id='a-show-img'  >Ver imagen</a>
                    </center>
                </div>
                <br>
                <div class="col-md-12">
                    <h3>{{ $user->email }}</h3>
                    <h4>{{ $user->member->full_name or "No asignado" }}</h4>                
                    <h5>{{ $user->type }}</h5>
                </div> 
            </div>
        </div>
        <!-- /.row -->
        </div>
    @endsection