<div style="float:right;"> Hay {{ $slides->total() }} registros</div>
<hr> 
    @foreach($slides as $slide)
        <div class="row" style="padding:10px" id='{{$slide->id}}'>
            <div class="col-md-3">
                <a href="#">
                    <img class="img-responsive" src=
                    @if($slide->file !='')
                    "/images/slides/{{$slide->file}}"
                    @else
                    'http://placehold.it/300x200'
                    @endif
                     >
                </a>
            </div>
            <div class="col-md-8 ">
                <h4 style="margin-top: 0px; margin-bottom:0px;">{{ $slide->title }}</h4>
                <div style="color:#00A6FF;" id ='id'> {{ $slide->event->title or 'No asignado a evento o actividad'}}</div>
                <p>{{ $slide->description }}</p>
                <a class="btn btn-primary" href={{ route('admin.slides.show', $slide->id) }}>  <i class="fa fa-bars"></i>Detalles </a>
                <a class="btn btn-info" href={{ route('admin.slides.edit', $slide->id) }}><i class="fa fa-pencil-square-o"></i>Editar </a>
                <button class="btn btn-danger" href={{ route('admin.slides.delete', $slide->id) }} value={{$slide->id}}> <i class="fa fa-trash-o"></i>Eliminar </button>
            </div>
        </div>
    @endforeach
        <center>{!! $slides->render() !!} </center>

        