@extends('layout')

@section('content')
<div class="container-fluid" style="margin-top:70px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class=" panel-default">

				<div class="border-left border-right">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Corriga los siguientes errores.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="/auth/login">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							{!! Form::label('email',  trans('validation.attributes.email').' :', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
							{!! Form::text('email',old('email'),['class' => 'form-control','type' => 'email']) !!}
							</div>
						</div>

						<div class="form-group">						 
							{!! Form::label('password', trans('validation.attributes.password').' :', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
							{!! Form::password('password',['class' => 'form-control','type' => 'password']) !!}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										{!! Form::checkbox('remember"',false) !!} Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								{!! Form::submit('Login',['type' => 'submit', 'class' => 'btn btn-primary', 'style '=> 'margin-right: 15px;']) !!}
								<a href="/password/email">Forgot Your Password?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
