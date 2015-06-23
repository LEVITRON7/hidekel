<div  class="col-md-12" style="padding:0;">
    <div class="form-group" >                         
        {!! Form::label('club_id', trans('validation.attributes.filter').' :', ['class' => 'col-md-12 control-label']) !!}
        {!! Form::select('filter_club', $clubsselect_filter, null , ['class' => 'form-control','type' =>'select', 'id' => 'select_filter_club']) !!}
    </div>
    <div id="form_filter_type" style="display:none;" class="form-group">
        {!! Form::select('filter_type', array(0 => 'Todos', 1 => 'Tópico', 2 => 'Tipo', -1 => '@Ninguno filtro'), -1 , ['class' => 'form-control','type' =>'select', 'id' => 'select_filter_type']) !!}
    </div>
    <div id="form_filter2" >
    </div>
</div>