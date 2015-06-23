@extends('appadmin')

@section('side-center')
<div class="col-sm-6 col-md-8">
<center><h3> Agregando nuevo material </h3></center>
            @include('app.admin.partials.errormessages')
            {!! Form::model($material,['route' => ['admin.materials.update',$material->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'role'=> 'form', 'id' => 'creatematerial', 'files' => 'true']) 
            !!}
            <div class="form-group">                         
                {!! Form::label('club_id', trans('validation.attributes.club_id').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">

                {!! Form::select('club_id', $clubsselect ,  $material->club_id , ['class' => 'form-control','type' =>'select', 'required']) !!}
                {!! Form::text('user_id', $material->user_id, ['type' =>'text','hidden']) !!}
                </div>
            </div>
            <div class="form-group">                         
                {!! Form::label('type_id', trans('validation.attributes.type_id').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::select('type_id', $typesselect ,  $material->type_id , ['class' => 'form-control','type' =>'select', 'required', 'id' =>'material_type']) !!}
                </div>
            </div>
            <div class="form-group">                         
                {!! Form::label('topic_id', trans('validation.attributes.topic_id').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::select('topic_id', $topicsselect ,  $material->topic_id, ['class' => 'form-control','type' =>'select', 'required']) !!}
                </div>
            </div>         
            <div class="form-group">
                {!! Form::label('title', trans('validation.attributes.file').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6" id="file-div">
                    <input id="input-file" name="file"  type="file">
                    <input name="video" type="text" class="form-control" id="input-video" placeholder="URL de youtube.com" style="display:none">
                    <input id="preview" value="{{$filejson}}" hidden>
                </div>
            </div>

            <div class="form-group" style="display:none" id="logo-input">                         
                {!! Form::label('insignia', trans('validation.attributes.insignia').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    <input id="input-image" name="logo"  type="file">
                    <input id="preview-img" value="{{$filejson2}}" hidden>
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
                            <i class="fa fa-floppy-o"></i>Guardar cambios
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
</div>
@endsection 


