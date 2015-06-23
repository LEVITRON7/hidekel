@extends('appadmin')
    @section('side-center')
        <div class="col-sm-6 col-md-8">
<!-- Team Members -->
        <div class="row"> 
            <div class="col-md-12 text-center">
                <div class="col-md-12 text-center ">
                    <img class="img-max-list" src=
                        @if ($ideal->club->logo == '')
                            'http://placehold.it/300x200'
                        @else
                            '/images/logos/{{$ideal->club->logo}}'
                        @endif
                    alt="">
                </div>
                <div class="col-md-12 row-centered">
                    <div class="col-md-12 col-centered">
                    <center>
                        <h2>{{$ideal->name}}</h2>
                    </center>
                    </div>
                    <div class="col-md-6 col-centered" style="text-align:center">
                        <p>{!!$ideal->value!!}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        </div>
    @endsection