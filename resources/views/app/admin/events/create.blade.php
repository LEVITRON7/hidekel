@extends('appadmin')

@section('side-center')
<div class="col-sm-6 col-md-8">
<center><h3> Agregando nuevo evento </h3></center>
            @include('app.admin.partials.errormessages')
            {!! Form::open(['route' => 'admin.events.create', 'method' => 'POST', 'class' => 'form-horizontal', 'role'=> 'form', 'id' => 'createevent', 'files' => 'true']) !!}
            <div class="form-group">                         

                {!! Form::label('club_id', trans('validation.attributes.club_id').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">

                {!! Form::select('club_id', $clubsselect ,  null , ['class' => 'form-control','type' =>'select', 'required']) !!}
                {!! Form::text('user_id', $user_id ,  ['type' =>'text','hidden']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('title', trans('validation.attributes.title').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('title',  null, ['class' => 'form-control','type' => 'text']) !!}
                </div>
            </div>

            <div class="form-group">                         
                {!! Form::label('description', trans('validation.attributes.description').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::textarea('description', null, ['class' => 'form-control','type' => 'textarea']) !!}
                </div>
            </div>

            <div class="form-group">                         
                {!! Form::label('address', trans('validation.attributes.address').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('address', null, ['class' => 'form-control','type' => 'text']) !!}
                </div>
            </div>
            <!-- Inicia input fecha y  hora               
             -->
            <div class="form-group">
              {!! Form::label('start', trans('validation.attributes.datetime_start').' :', ['class' => 'col-md-4 control-label']) !!}

            <div class='input-group date col-md-6' id='datetimestart'>
                {!! Form::text('datetime_start', old('datetime_start'), ['class' => 'form-control','type' => 'text', 'id'=>'datetime_start']) !!}
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div> 
            </div>

            <div class="form-group">
              {!! Form::label('end', trans('validation.attributes.datetime_end').' :', ['class' => 'col-md-4 control-label']) !!}
            <div class='input-group date col-md-6' id='datetimeend'>
                {!! Form::text('datetime_end',  old('datetime_end'), ['class' => 'form-control','type' => 'text', 'id'=>'datetime_end']) !!}
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div> 
            </div>
            <!-- Termina input fecha y  hora -->

            <div class="form-group">                         
                {!! Form::label('location', trans('validation.attributes.location').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::button('Ubicar en Mapa',  ['class' => 'btn btn-success','type' => 'button', 'id' => 'setlocation' , 'data-toggle'=>'modal', 'data-target'=>'#myModal']) !!}
                </div>
            </div>

            <div class="form-group">                         
                {!! Form::label('latitude', trans('validation.attributes.location_latitude').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('location_latitude',  null, ['class' => 'form-control','type' => 'text','id' => 'location_latitude','readonly' ]) !!}
                </div>
            </div>

            <div class="form-group">                         
                {!! Form::label('longitude', trans('validation.attributes.location_longitude').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('location_longitude', null, ['class' => 'form-control','type' => 'text' ,'id' => 'location_longitude','readonly']) !!}
                </div>
            </div>

            <div class="form-group">                         
                {!! Form::label('poster', trans('validation.attributes.poster').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
{{--                     <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="">
                         <span class="btn btn-default btn-file"><span class="fileinput-new">Elegir imagen</span>{!! Form::file('poster', ['class' => 'form-control']) !!}</span>
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 250px; height: auto; float: left;margin-top:15px; padding:5px;display:inline;"></div>
                        </div> 
                    </div>   --}}   

                    <input id="input-image-new" name="poster"  type="file">                            
                </div>
            </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Agregar evento
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
            
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel"> Indica la ubicación del evento en el Mapa</h3>
      </div>
      <div class="modal-body modal-body-map" style="height: 60%;">
        <div id="map_canvas"class="map_event"></div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="location_cancel">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
      </div>
    </div>
  </div>
</div>


@endsection 

