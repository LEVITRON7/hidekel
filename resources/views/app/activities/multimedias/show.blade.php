@extends('layout')
    @section('content')
        <div class="container">        
<!-- Team Members -->
        <div class="row"> 
                <div class="col-md-12" style=" margin: 0 auto;  ">
                <div class="absolute"><a class="btn btn btn-default" href="{{ URL::previous() }}"> <i class="fa fa-arrow-left"></i> Atras</a></div>
                <h3 class="text-center" style="color:#00A6FF">{{$activity->title}}</h3>
                <div class="row col-md-12 text-center" style=" margin: 0 auto;">
                        <div id="links" >
                        @if(count($activity->multimedias)!=0)
                        <h3> Fotos</h3>
                            @foreach($activity->multimedias as $multimedia)
                                @if($multimedia->type == 'Foto')                                
                                <a href=/images/multimedia/{{$multimedia->file}}  data-gallery>
                                    <img  class='img-responsive img-same-size'  src=/images/multimedia/{{$multimedia->file}} alt=>
                                </a>
                                @else                            
                                <?php $videos[] = $multimedia->file;?>
                                @endif
                            @endforeach
                        @else
                        <h3> No hay videos ni fotos para mostrar</h3>
                        @endif
                        </div>
                        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-use-bootstrap-modal="false">
                            <div class="slides"></div>
                            <h3 class="title"></h3>
                            <a class="prev">‹</a>
                            <a class="next">›</a>
                            <a class="close">×</a>
                            <a class="play-pause"></a>
                            <ol class="indicator"></ol>
                        </div>
                </div>
                <div class=" row col-md-12 " style=" margin: 0 auto;">

                @if(!empty($videos))
                    <h3 style=" margin-bottom: 0px;"> Videos</h3>
                    <?php if(!empty($videos)){ echo implode("", $videos); } ?>
                @else
                    
                @endif                
                </div>
                </div>

        </div>
        <!-- /.row -->
        </div>
    @endsection
