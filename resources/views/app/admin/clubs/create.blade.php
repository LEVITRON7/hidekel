@extends('appadmin')

@section('side-center')
<div class="col-sm-6 col-md-8">
<center><h3> Agregando nuevo club </h3></center>
            @include('app.admin.partials.errormessages')
            {!! Form::open(['route' => 'admin.clubs.create', 'method' => 'POST', 'class' => 'form-horizontal', 'role'=> 'form', 'id' => 'createclub', 'files' => 'true']) !!}

            <div class="form-group">
                {!! Form::label('name', trans('validation.attributes.name').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('name',  null, ['class' => 'form-control','type' => 'text']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('type', trans('validation.attributes.type').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('type',  null, ['class' => 'form-control','type' => 'text']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description', trans('validation.attributes.description').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::textarea('description',  null, ['class' => 'form-control','type' => 'text']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('logo', trans('validation.attributes.logo').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6" id="file-div">
                    <input id="input-image-new" name="logo" type="file" >
                </div>
            </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i>Agregar Club
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
</div>

@endsection 

