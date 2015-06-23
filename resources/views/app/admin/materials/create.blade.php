@extends('appadmin')

@section('side-center')
<div class="col-sm-6 col-md-8">
<center><h3> Agregando nuevo material </h3></center>
            @include('app.admin.partials.errormessages')
            {!! Form::open(['route' => 'admin.materials.create', 'method' => 'POST', 'class' => 'form-horizontal', 'role'=> 'form', 'id' => 'createevent', 'files' => 'true']) !!}
            <div class="form-group">                         
                {!! Form::label('club_id', trans('validation.attributes.club_id').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">

                {!! Form::select('club_id', $clubsselect ,  null , ['class' => 'form-control','type' =>'select', 'required']) !!}
                {!! Form::text('user_id', $user_id ,  ['type' =>'text','hidden']) !!}
                </div>
            </div>
            <div class="form-group" >                         
                {!! Form::label('type_id', trans('validation.attributes.type_id').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6" >
                {!! Form::select('type_id', $typesselect ,  null , ['class' => 'form-control','type' =>'select', 'required','id' => 'material_type']) !!}
                </div>
            </div>
            <div class="form-group">                         
                {!! Form::label('topic_id', trans('validation.attributes.topic_id').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::select('topic_id', $topicsselect ,  null , ['class' => 'form-control','type' =>'select', 'required']) !!}
                </div>
            </div>         
            <div class="form-group">
                {!! Form::label('title', trans('validation.attributes.file').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6" id="file-div">
                    <input id="input-file-new" name="file" value="" type="file" >
                    <input name="video" type="text" class="form-control" id="input-video" placeholder="URL de youtube.com" style="display:none">
                </div>
            </div>

            <div class="form-group" style="display:none" id="logo-input">
                {!! Form::label('insignia', trans('validation.attributes.insignia').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6" id="file-div">
                    <input id="input-image-new" name="logo" type="file" >
                </div>
            </div>

            <div class="form-group">                         
                {!! Form::label('name', trans('validation.attributes.name').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('name', null, ['class' => 'form-control','type' => 'text']) !!}
                </div>
            </div>

            <div class="form-group">                         
                {!! Form::label('description', trans('validation.attributes.description').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::textarea('description', null, ['class' => 'form-control','type' => 'textarea']) !!}
                </div>
            </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i>Agregar Material
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
</div>
@endsection 

