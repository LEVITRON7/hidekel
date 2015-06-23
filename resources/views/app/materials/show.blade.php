@extends('layout')

@section('content')
<div class="container border-right border-left">
       <!-- Page Features -->
            <div class="col-md-12 text-center ">            
            <div class="absolute"><a class="btn btn btn-default" href="{{ URL::previous() }}"> <i class="fa fa-arrow-left"></i>  Atras</a></div>
                <div class="col-md-9 col-centered" >                
                    <div class="col-md-12">
                    <?php  echo ($preview_material);?>
                    </div>            
                    <div class="col-md-12">
                        <div class="col-md-10 col-centered"><h3>{{$material->name}}</h3></div>
                        <div class="caption">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <h4>{{ $material->type->name }} &nbsp;<img src="/images/logos/{{$material->club->logo}}"  height="35" width="35"></h4>
                                <h4 class="" style="color:#00A6FF;">({{ $material->topic->name }})
                                <small>{{ $material->extension}}</small>                                
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <h5>Subido por :  {{ $material->user->email or 'Default' }} </h5>
                                @if (($material->extension == 'youtube.com') or ($material->file == ''))
                                <h3></h3>
                                @else
                                <br>
                                    <a class="btn btn btn-success" href="/files/materials/{{$material->file}}"> <i class="fa fa-download"></i>Descargar</a>
                                @endif
                                    <button  class="btn btn-default button-share" value={{ route('materials.show', $material->id) }}><i class="fa fa-share-alt"></i>Compartir</button>
                            </div>
                        </div>
                        </div>
                    </div>                
                </div>
            </div>      
</div>
<br>
@endsection

