@extends('appadmin')

@section('side-center')
<div class="col-sm-6 col-md-8">
<center><h3> Editando tipo de material </h3></center>
            @include('app.admin.partials.errormessages')
            {!! Form::model($type,['route' => ['admin.materials.types.edit',$type->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'role'=> 'form', 'id' => 'editmaterialtype']) !!}            
            <div class="form-group">                         
                {!! Form::label('name', trans('validation.attributes.name').' :', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                {!! Form::text('name', $type->name, ['class' => 'form-control','type' => 'text']) !!}
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

