@extends('appadmin')
    @section('side-center')
        <div class="col-sm-6 col-md-8">
<center><h3> Editando usuario </h3></center>
    @include('app.admin.partials.errormessages')
            {!! Form::model($user,['route' => ['admin.users.update',$user->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

                <div class="form-group">                         
                    {!! Form::label('member', trans('validation.attributes.member').' :', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">

                    {!! Form::select('member_id',$membersselect, $user->member->id, ['class' => 'form-control','type' =>'select']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email :', ['class' => 'col-md-4 control-label']) !!}
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
                    {!! Form::label('password',trans('validation.attributes.password_confirmation').' :',  ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::password('password_confirmation',['class' => 'form-control','type' => 'password']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('type', 'Tipo de usuario :', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('type', $typeselect,  $user->type , ['class' => 'form-control','type' =>'select']) !!}
                    </div>
                </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                  <i class="fa fa-floppy-o"></i> Guardar cambios
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}                    
        </div>
    @endsection