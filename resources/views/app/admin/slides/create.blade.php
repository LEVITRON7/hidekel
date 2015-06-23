@extends('appadmin')

@section('side-center')
<div class="col-sm-6 col-md-8">
<center><h3> Agregando imagen a Slide </h3></center>
            @include('app.admin.partials.errormessages')
            {!! Form::open(['route' => 'admin.slides.create', 'method' => 'POST', 'class' => 'form-horizontal', 'role'=> 'form', 'id' => 'createslides', 'files' => 'true']) !!}
            <div class="form-group">                         
                {!! Form::label('event_id', trans('validation.attributes.event_id').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::select('event_id', $eventsselect ,  null , ['class' => 'form-control','type' =>'select', 'required']) !!}
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
                {!! Form::label('image', trans('validation.attributes.image').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6" id="file-div">
                    <input id="input-image-new" name="file" type="file" >
                </div>
            </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i>Agregar imagen
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
</div>

@endsection 

