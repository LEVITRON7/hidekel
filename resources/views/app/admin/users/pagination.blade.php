<div style="float:right;"> Hay {{ $users->total() }} registros</div>
<hr>
<h3>Usuarios</h3>
    <table class="table table-striped">
            <thead>
                <td>Usuario</td>
                <td>Miembro</td>
                <td>Tipo</td>
                <td>Accciones</td>
            </thead>
        @foreach($users as $user)
            <tr id='{{$user->id}}'>
                <td id='id'>{{ $user->email }}</td>
                <td>{{ $user->member->full_name or "No asignado" }}</td>
                <td>{{ $user->type }}</td>
                <td class="col-md-4"> 
                <a href={{ route('admin.users.edit',$user->id )}} class="btn btn-info btn-sm">  <i class="fa fa-pencil-square-o"></i> Editar </a> 
                <button href={{ route('admin.users.delete',$user->id )}} class="btn btn-danger btn-sm" value={{$user->id}}> <i class="fa fa-trash-o"></i> Eliminar </button>            
                </td>
            </tr>
        @endforeach
    </table>
      <center>{!! $users->render() !!} </center>