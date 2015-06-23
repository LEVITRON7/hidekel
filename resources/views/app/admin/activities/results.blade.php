    @if(count($activities)> 0)
    <div style="float:right;"> Hay {{ count($activities) }} registros</div>
        @foreach($activities as $activity)
        <hr>
            <div class="row" style="padding:10px" id='{{$activity->id}}'>
                <div class="col-md-3">
                    <a href="">
                        <center><img class="img-responsive img-max-list img-shadow" src= 
                            @if ($activity->poster == '')
                                'http://placehold.it/300x200'
                            @else
                                '/images/posters/{{$activity->poster}}'
                            @endif
                        ></center>                            
                    </a>
                </div>
                <div class="col-md-9 no-padding">
                <div class="col-md-12 no-padding">
                    <div class="col-md-8 no-padding"><h4 id='id' class="no-padding" style="margin-top: 0px;">{{ $activity->title }}</h4></div>
                    <div class="col-md-1 no-padding" style="color:#959595"> 
                        <img src="/images/logos/{{$activity->club->logo}}"  height="35" width="35">
                    </div>
                    <div class="col-md-3 no-padding" style="color:#959595"> <h4  class="defaultCountdown"  style="margin-top: 0px;  "><?php
                           $datetime1 = new DateTime($activity->datetime_end);
                            $datetime2 = new DateTime('now');
                            $interval = $datetime2->diff($datetime1);
                             if($datetime2 > $datetime1 ){
                                echo $interval->format('Hace %a días');
                            }else{
                                echo  'En curso...';
                            }                      
                    ?></h4>
                    </div>
                </div>
                    <h5 style="margin-top: 3px; margin-bottom:3px; font-style: oblique;">{{ $activity->address }}</h5> <div style="color:#00A6FF;">  Del {{ $activity->date_between }}</div>
                    <p>{!! str_limit($activity->description, $limit = 100, $end = '...')  !!}</p>
                    <a class="btn btn-primary" href={{ route('admin.activities.show', $activity->id) }}><i class="fa fa-bars"></i>Detalles</a>
                    <a class="btn btn-success btn-sm" href={{ route('admin.activities.multimedias.show', $activity->id) }}><i class="fa fa-play"></i> Ver Multimedia</a>
                    <a class="btn btn-info btn-sm" href={{ route('admin.activities.add_multimedia', $activity->id) }}><i class="fa fa-pencil-square-o"></i> Editar Multimedia</a>
                    <a class="btn btn-info btn-sm" href={{ route('admin.activities.edit', $activity->id) }}> <i class="fa fa-pencil-square-o"></i> Editar </a>
                    <button class="btn btn-danger btn-sm" href={{ route('admin.activities.delete', $activity->id) }} value={{$activity->id}}> <i class="fa fa-trash"></i> Eliminar </button>
                </div>
            </div>
        @endforeach
    @else
        <h3>No se encontraron actividades <i class="fa fa-exclamation-circle"></i></h3>
    @endif