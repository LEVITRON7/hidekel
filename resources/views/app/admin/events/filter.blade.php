<div  class="col-md-12" style="padding:0;">
    <div class="form-group" >                         
        {!! Form::label('club_id', trans('validation.attributes.filter').' :', ['class' => 'col-md-12 control-label']) !!}
        <div class="col-md-12 no-padding">
        {!! Form::select('filter_club', $clubsselect_filter, null , ['class' => 'form-control','type' =>'select', 'id' => 'select_filter_club_search']) !!}
        </div>
    </div>
</div>
