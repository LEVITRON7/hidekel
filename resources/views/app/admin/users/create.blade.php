@extends('appadmin')

@section('side-center')
<div class="col-sm-6 col-md-8">
<center><h3> Agregando nuevo usuario </h3></center>
            @include('app.admin.partials.errormessages')
            {!! Form::open(['route' => 'admin.users.create', 'method' => 'POST', 'class' => 'form-horizontal', 'role'=> 'form'])!!}
            <div class="form-group">                         
                {!! Form::label('member', trans('validation.attributes.member').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">

                {!! Form::select('member_id', $membersselect ,  null , ['class' => 'form-control','type' =>'select']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('email', trans('validation.attributes.email').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('email',  null, ['class' => 'form-control','type' => 'email']) !!}
                </div>
            </div>

            <div class="form-group">                         
                {!! Form::label('password', trans('validation.attributes.password').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::password('password', ['class' => 'form-control','type' => 'password']) !!}
                </div>
            </div>

            <div class="form-group">                         
                {!! Form::label('password', trans('validation.attributes.password_confirmation').' :',  ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::password('password_confirmation',['class' => 'form-control','type' => 'password']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('type', 'Tipo de usuario :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::select('type',  $typeselect ,  null, ['class' => 'form-control','type' =>'select']) !!}
                </div>
            </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                                <i class="fa fa-user-plus"></i>&nbsp; Registrar Usuario
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
</div>
@endsection 
