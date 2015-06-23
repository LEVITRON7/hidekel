@extends('layout')

@section('content')
  <div class="container" >
<div class="col-sm-6 col-md-8 col-centered">
<center><h3> Contactarnos </h3></center>
            @include('app.admin.partials.errormessages')
            @if (Session::has('message'))
                <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="fa fa-check"></i>{{ Session::get('message') }}</div>
            @endif
            {!! Form::open(['route' => 'home.contact', 'method' => 'POST', 'class' => 'form-horizontal', 'role'=> 'form', 'id' => 'sendmessage']) !!}       
            <div class="form-group">                         
                {!! Form::label('name', trans('validation.attributes.name').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">                
                {!! Form::text('name', null, ['class' => 'form-control','type' => 'text']) !!}                
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('email', trans('validation.attributes.email').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('email', null, ['class' => 'form-control','type' => 'text']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('title', trans('validation.attributes.title').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('title', null, ['class' => 'form-control','type' => 'text']) !!}
                </div>
            </div>

            <div class="form-group">                         
                {!! Form::label('menssage', trans('validation.attributes.message').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::textarea('message', null, ['class' => 'form-control','type' => 'textarea']) !!}
                </div>
            </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                                <i class="fa fa-paper-plane"></i>Enviar Mensaje
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
            <div class="col-md-8 col-centered text-center">
            	{{-- <center><h5>Teléfonos</h5></center> --}}
            </div>
</div>
  </div>
@endsection
