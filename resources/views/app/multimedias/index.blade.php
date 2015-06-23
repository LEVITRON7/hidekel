@extends('layout')

@section('content')
<div class="container pagination-div" >
<!-- Team Members -->
    @if((count($Activities) != 0))
        @foreach($Activities as $activity)                 
            <?php $videos=[]; ?>
            @if(count($activity->multimedias)!= 0) 
                <div class="col-md-12 text-center">
                <h3 style="color:#00A6FF">{{$activity->title}}</h3>  
                <div class="row col-md-12" style=" margin: 0 auto;">
                        <div id="links" >
                        @if(count($activity->multimedias)!=0)
                        <h3> Fotos</h3>
                            @foreach($activity->multimedias as $multimedia)
                                @if(($multimedia->type == 'Foto') and ($multimedia->file != ''))
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
                    <hr style=" margin: 0 auto;  border-top: 3px solid #ddd;">
                </div>
                
            @else
            @endif                    
        @endforeach
    @else
    <br>
        <center><h3>No hay actividades</h3></center>
    <br>
    @endif

    @if(count($multimedias) == 0 )
    <br>
        <center><h3>No hay multimedia en las actividades</h3></center>
    <br>
    @endif

</div>
@endsection

