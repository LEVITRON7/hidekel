@extends('appadmin')

@section('side-center')
<div class="col-sm-6 col-md-8">
<center><h3> Agregando nuevo tópico de material </h3></center>
            @include('app.admin.partials.errormessages')
            {!! Form::open(['route' => 'admin.materials.topics.create', 'method' => 'POST', 'class' => 'form-horizontal', 'role'=> 'form', 'id' => 'creatematerialtopic']) !!}            
            <div class="form-group">                         
                {!! Form::label('name', trans('validation.attributes.name').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('name', null, ['class' => 'form-control','type' => 'text']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Agregar Tópico
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
</div>
@endsection 

