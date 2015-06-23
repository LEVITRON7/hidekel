@extends('appadmin')
    @section('side-center')
        <div class="col-sm-6 col-md-8">        
            <center>
                <h3>Bienvenido usuario {{Auth::user()->type}}</h3>
            </center>
                <h4>Encontrarás a tu derecha e izquierda las opciones: Agregar, Editar, Eliminar</h4>        
                <h5> Los siguientes elementos:</h5>
                @if (Auth::user()->type == 'admin')
                    <h5> Usuarios del sistema</h5>
                @endif
                <h5> Miembros </h5>
                <h5> Eventos </h5>
                <h5> Actividades y su Multimedia </h5>
                <h5> Materiales -> Cuadernillos, presentaciones, cursos, manuales, etc.</h5>
                <h5> Clubes -> Clases y roles de club</h5>
                <h5> Multimedia -> Fotos y Videos</h5>
                <h5> Slides -> Imagenes del slide principal</h5>
        </div>
    @endsection