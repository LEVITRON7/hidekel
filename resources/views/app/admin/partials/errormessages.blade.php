
@if($errors->any())
	<div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
		<p>Corrige los siguientes errores: </p>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>

			@endforeach
		</ul>
	</div>	
@endif