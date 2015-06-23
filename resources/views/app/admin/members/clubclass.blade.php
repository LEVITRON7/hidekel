{!! Form::label('class_id', trans('validation.attributes.clubclass_id').' :', ['class' => 'col-md-4 control-label']) !!}
<div class="col-md-6">
{!! Form::select('class_id',$select, null ,['class' => 'form-control','type' =>'select']) !!}
</div>