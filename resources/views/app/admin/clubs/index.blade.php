@extends('appadmin')
    @section('side-center')
        <div class="col-sm-6 col-md-8 pagination-div">
        @if($clubs->total()>0)
        <div style="float:right;"> Hay {{ $clubs->total() }} registros</div>
        <hr>
            @foreach($clubs as $club)
                <div class="row" style="padding:10px" id='{{$club->id}}'>
                    <div class="col-md-3">
                        <a href="portfolio-item.html">
                            <img class="img-responsive   " src=
                                @if ($club->logo == '')
                                    'http://placehold.it/300x200'
                                @else
                                    '/images/logos/{{$club->logo}}'
                                @endif
                            >
                        </a>
                    </div>
                    <div class="col-md-9">
                        <h4 style="margin-top: 0px; margin-bottom:0px;" id ='id'>{{ $club->type }}</h4>
                        <h5 style="margin-top: 3px; margin-bottom:3px; font-style: oblique;">{{ $club->name }}   </h5> 
                        <p>{!! str_limit($club->description, $limit = 200, '...' ) !!}</p>
                        <a class="btn btn-primary" href={{ route('admin.clubs.show', $club->id) }}><i class="fa fa-bars"></i>Detalles </a>
                        <a class="btn btn-info" href={{ route('admin.clubs.edit', $club->id) }}><i class="fa fa-pencil-square-o"></i> Editar </a>
                        <button class="btn btn-danger" href={{ route('admin.clubs.delete', $club->id) }} value={{$club->id}}><i class="fa fa-trash-o"></i>Eliminar </button>
                    </div>
                </div>
            @endforeach
                <center>{!! $clubs->render() !!} </center>
        @else
                <center><h3>No hay clubs</h3></center>
                <br>
                <center><a href="{{route('admin.clubs.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>Agregar club</a></center>
        @endif
        </div>
    @endsection