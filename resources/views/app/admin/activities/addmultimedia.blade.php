@extends('appadmin')

@section('side-center')
<div class=" col-sm-6 col-md-8">
    @include('app.admin.partials.errormessages')
        <ul class="nav nav-tabs" role="tablist" id="myTab">
            <li role="presentation" class="active"><a href="#multimedia-fotos" aria-controls="multimedia-fotos" role="tab" data-toggle="tab">Agregar Fotos</a></li>
            <li role="presentation"><a href="#multimedia-videos" aria-controls="multimedia-videos" role="tab" data-toggle="tab">Agregar Videos</a></li>
        </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="multimedia-fotos">
            <div class="col-md-12" style=" display: block;">
                <center><h3> Agregando fotos a {{$Event->title}} </h3></center>
           {!! Form::open(['route'      => 'admin.uploadfiles', 
                            'method'    => 'POST', 
                            'class'     => 'form-horizontal', 
                            'role'      => 'form', 
                            'id'        => 'add-foto' ]) !!}

                <input id="preview" value="{{$fotos}}" hidden>
                <input id="event-id" value="{{$Event->id}}" hidden >
                <input id="input-files" name="files[]" value="{{$Event->id}}" type="file" multiple class="file-loading">           

            {!! Form::close() !!}
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="multimedia-videos">
            <div class="col-md-12" style=" display: block;">
            <center><h3> Agregando videos a {{$Event->title}}</h3></center>
           {!! Form::open(['route'      => 'admin.uploadvideos', 
                            'method'    => 'POST', 
                            'class'     => 'form-inline', 
                            'role'      => 'form', 
                            'id'        => 'add-foto' ]) !!}
              <div class="form-group col-md-5" style="padding-left:5px;padding-right:5px;" >
                <input type="text" class="form-control" style="width:100%" id="input-video" placeholder="URL de youtube.com" required>                
              </div>
              <div class="form-group col-md-5" style="padding-left:5px;padding-right:5px;">
                <input type="text" class="form-control" style="width:100%" id="input-video-title" placeholder="Título de video" required>                
              </div>
              <div class="form-group col-md-1" style="padding-left:5px;padding-right:5px;">
              <a class="btn btn-success" id="submit-video">Agregar</a>
              </div>
            {!! Form::close() !!}
            </div>
            <div class="col-md-12">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Video</th>
                      <th>Título</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody id="preview-videos">
           @if($Videos == '')
                <h3>No hay ningun vídeo</h3>
            @endif
            @foreach($Videos as $video)
            <tr id ='{{$video->id}}'>
                      <th scope ='row' >{{ $video->id }}</th>
                      <td><iframe width="180" height="120" src=

                        <?php echo str_replace("watch?v=", "embed/", $video->file.'?rel=0&fs=1'); ?>
                         frameborder="0" allowfullscreen></iframe></td>
                      <td id='id'>{{ $video->title }}</td>
                      <td><button class="btn btn-danger delete-video" value='{{ $video->id }}'> Eliminar</button>
            </tr>
            @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 