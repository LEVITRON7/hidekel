<div style="float:right;"> Hay {{ $ideals->total() }} registros</div>        
<hr>
<center><h3>Ideales de club</h3></center>
    <table class="table table-striped">
            <thead>
                <td class="col-md-3">Nombre</td>
                <td>Contenido</td>
                <td>Acciones</td>
            </thead>
        @foreach($ideals as $ideal)
            <tr id='{{$ideal->id}}'>
                <td id='id'>{{ $ideal->name }} <h4><small  >({{ $ideal->club->Full }})</small></h4>
                </td>
                <td>{!!  str_limit($ideal->value, $limit = 50, $end = '...')   !!}</td>
                <td class="col-md-5">
                <a href={{ route('admin.clubs.ideals.show',$ideal->id )}} class="btn btn-primary btn-sm"><i class="fa fa-bars"></i>Detalles</a> 
                <a href={{ route('admin.clubs.ideals.edit',$ideal->id )}} class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i>Editar</a> 
                <button href={{ route('admin.clubs.ideals.delete',$ideal->id )}} class="btn btn-danger btn-sm" value={{$ideal->id}}><i class="fa fa-trash-o"></i>Eliminar </button>            
                </td>
            </tr>
        @endforeach                
    </table>
    <center>{!! $ideals->render() !!} </center>