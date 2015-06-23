@extends('layout')

@section('content')
<div class="container-fluid" style="margin-top:60px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="/auth/register">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							{!! Form::label('email', 'Name :', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
							{!! Form::text('name',old('name'), ['class' => 'form-control','type' => 'text']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('email', 'Email :', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
							{!! Form::text('email',old('email'), ['class' => 'form-control','type' => 'email']) !!}
							</div>
						</div>

						<div class="form-group">						 
							{!! Form::label('password', 'Password :', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
							{!! Form::password('password', ['class' => 'form-control','type' => 'password']) !!}
							</div>
						</div>

						<div class="form-group">						 
							{!! Form::label('password', 'Confirm Password :', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
							{!! Form::password('password_confirmation',['class' => 'form-control','type' => 'password']) !!}
							</div>
						</div>


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
