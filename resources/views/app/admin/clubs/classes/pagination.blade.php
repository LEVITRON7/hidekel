<div style="float:right;"> Hay {{ $classes->total() }} registros</div>
<hr>
<center><h3>Clases de club</h3></center>
    <table class="table table-striped">
            <thead>
                <td>Id</td>
                <td>Nombre</td>
                <td>Logo</td>
                <td>Club</td>
                <td>Acciones</td>
            </thead>
        @foreach($classes as $class)
            <tr id='{{$class->id}}'>
                <td>{{ $class->id }}</td>
                <td id='id'>{{ $class->name }}</td>
                <td>
                    <img class="img-responsive " height="50" width="50" src=
                        @if ($class->logo == '')
                            'http://placehold.it/300x200'
                        @else
                            '/images/logos/{{$class->logo}}'
                        @endif
                    >
                </td>
                <td>{{ $class->club->type }} &nbsp; {{ $class->club->name }}</td>
                <td class="col-md-3">
                <a href={{ route('admin.clubs.classes.edit',$class->id )}} class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i> Editar</a>  
                <button href={{ route('admin.clubs.classes.delete',$class->id )}} class="btn btn-danger btn-sm" value={{$class->id}}><i class="fa fa-trash-o"></i>Eliminar </button>           
                </td>
            </tr>   
        @endforeach                
    </table>
    <center>{!! $classes->render() !!} </center>