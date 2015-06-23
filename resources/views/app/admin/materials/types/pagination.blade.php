<hr>
<div style="float:right;"> Hay {{ $MaterialsTypes->total() }} registros</div>
    <center><h3>Tipos de materiales</h3></center>
    <table class="table table-striped">
            <thead>
                <td>Id</td>
                <td>Nombre</td>
                <td>Accciones</td>
            </thead>
        @foreach($MaterialsTypes as $type)
            <tr id='{{$type->id}}'>
                <td>{{ $type->id }}</td>
                <td id='id'>{{ $type->name }}</td>
                <td class="col-md-3">
                <a href={{ route('admin.materials.types.edit',$type->id )}} class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i>Editar </a>
                <button href={{ route('admin.materials.types.delete',$type->id )}} class="btn btn-danger btn-sm" value={{$type->id}}><i class="fa fa-trash-o"></i> Eliminar </button>            
                </td>
            </tr> 
        @endforeach                
    </table>
    <center>{!! $MaterialsTypes->render() !!} </center>