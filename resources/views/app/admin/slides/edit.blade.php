@extends('appadmin')

@section('side-center')
<div class="col-sm-6 col-md-8">
<center><h3> Editando imagen de Slide </h3></center>
            @include('app.admin.partials.errormessages')
            {!! Form::model($slide,['route' =>[ 'admin.slides.edit',$slide->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'role'=> 'form', 'id' => 'editslide', 'files' => 'true']) !!}
            <div class="form-group">                         
                {!! Form::label('event_id', trans('validation.attributes.event_id').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::select('event_id', $eventsselect ,  $slide->event_id , ['class' => 'form-control','type' =>'select', 'required']) !!}
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
                {!! Form::textarea('description',  null, ['class' => 'form-control','type' => 'text']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('file', trans('validation.attributes.file').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6" id="file-div">
                    <input id="input-image" name="file" type="file" >
                    <input id="preview-img" value="{{$filejson}}" hidden>
                </div>
            </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-floppy-o"></i>Guardar cambios
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
</div>

@endsection 

