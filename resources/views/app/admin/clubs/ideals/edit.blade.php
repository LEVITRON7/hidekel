@extends('appadmin')

@section('side-center')
<div class="col-sm-6 col-md-8">
<center><h3> Agregando nueva clase de club </h3></center>
            @include('app.admin.partials.errormessages')
            {!! Form::model($ideal,['route' => ['admin.clubs.ideals.update',$ideal->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'role'=> 'form', 'id' => 'editideal']) !!}         

            <div class="form-group">                         
                {!! Form::label('club_id', trans('validation.attributes.club_id').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::select('club_id',  $clubsselect, null , ['class' => 'form-control','type' =>'select', 'id' => 'select_club']) !!}
                </div>
            </div>

            <div class="form-group">                         
                {!! Form::label('name', trans('validation.attributes.name').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('name', null, ['class' => 'form-control','type' => 'text']) !!}
                </div>
            </div>

            <div class="form-group">                         
                {!! Form::label('value', trans('validation.attributes.value').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::textarea('value', null, ['class' => 'form-control','type' => 'textarea']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i>Guardar cambios
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
</div>
@endsection 

