@extends('layout')

@section('content')
<div class="container" >
       <!-- Page Features -->
        <div class="col-md-12" style="margin-top:10px;">
        @if(count($Materials) != 0)
            <div class="col-md-9 pagination-div" id='results'>
                    @foreach ($Materials as $material)
                        <div class="col-md-6 col-sm-6">
                            <div class="thumbnail">                                
                                <div class="caption">
                                <div class="col-md-12  no-padding">
                                    <h4 class="col-md-10  no-padding">{{$material->name}} </h4> <div class="col-md-2"><img class="img-responsive"  src="/images/logos/{{$material->club->logo}}"  height="30" width="30"></div>
                                </div>
                                    <h5 class="col-md-8 no-padding oblique"  >{{$material->topic->name}} </h5>  
                                    <h5 class="col-md-4 no-padding" style="color:gray ;text-align:right;">{{$material->type->name}}</h5>
                                    <p>{{str_limit($material->description, $limit = 40, $end = '...')}}</p>
                                    <center>
                                    <p>
                                        <a href={{ route('materials.show', $material->id) }} class="btn btn-primary"><i class="fa fa-bars"></i>Detalles</a> 
                                        <button  class="btn btn-default button-share" value={{ route('materials.show', $material->id) }}><i class="fa fa-share-alt"></i>Compartir</button>
                                    </p>
                                    </center>
                                </div>
                            </div>
                        </div>
                    @endforeach

                <div class="col-md-12">
                    <center>{!! $Materials->render() !!} <div style="float:right;"> Hay {{ $Materials->total() }} registros</div></center>
                </div>
            </div>
            <div class="col-md-3">
                @include('app.materials.filter')
            </div>
            @else
                <center><h3>No hay materiales</h3></center>
            @endif
        </div>
</div>
@endsection



