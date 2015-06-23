@extends('appadmin')

@section('side-center')
<div class="col-sm-6 col-md-8">
<center><h3> Editando miembro {{$member->full_name}}</h3></center>
            @include('app.admin.partials.errormessages')
            {!! Form::model($member,['route' => ['admin.members.update',$member->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'role'=> 'form', 'id' => 'createmember', 'files' => 'true']) !!}

            <div class="form-group">                         
                {!! Form::label('club_id', trans('validation.attributes.club_id').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::select('club_id',  $clubsselect, null, ['class' => 'form-control','type' =>'select', 'id' => 'select_club']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('first_name', trans('validation.attributes.first_name').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('first_name',  null, ['class' => 'form-control','type' => 'text']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('last_name', trans('validation.attributes.last_name').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('last_name',  null, ['class' => 'form-control','type' => 'text']) !!}
                </div>
            </div>

            <!-- Inicia input fecha de nacimiento           
             -->
            <div class="form-group">
              {!! Form::label('burn', trans('validation.attributes.burn').' :', ['class' => 'col-md-4 control-label']) !!}

            <div class='input-group date col-md-6' id='burndate'>

            {!! Form::text('burn', null, ['class' => 'form-control','type' => 'text', 'id'=>'burn']) !!}
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>

            </div>
            <!-- Termina input fecha y  hora -->

            <div class="form-group">
                {!! Form::label('sex', trans('validation.attributes.sex').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::select('sex',  $sexselect, $member->sex ,['class' => 'form-control','type' =>'select']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('role_id', trans('validation.attributes.role_id').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">              
                {!! Form::select('role_id',$rolesselect, $member->role->id,['class' => 'form-control','type' =>'select', 'id' => 'select_club_role']) !!}
                </div>
            </div>

            <div class="form-group" id="form_class">
                {!! Form::label('class_id', trans('validation.attributes.clubclass_id').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::select('class_id',$classesselect, null, ['class' => 'form-control','type' =>'select']) !!}

                </div>
            </div>

            <div class="form-group">                         
                {!! Form::label('photo', trans('validation.attributes.photo').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    <input id="input-image" name="photo"  type="file">
                    <input id="preview-img" value="{{$filejson}}" hidden>                  
                </div>
            </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-floppy-o"></i>&nbsp;Guardar cambios
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
</div>

@endsection