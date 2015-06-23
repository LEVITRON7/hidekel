
@extends('appadmin')
    @section('side-center')
        <div class="col-sm-6 col-md-8 pagination-div">
        @if($roles->total()>0)
        <div style="float:right;"> Hay {{ $roles->total() }} registros</div>
            <hr>
                <center><h3>Roles de club</h3> </center>
                <table class="table table-striped">
                        <thead>
                            <td>Id</td>
                            <td>Nombre</td>
                            <td>Acciones</td>
                        </thead>
                    @foreach($roles as $role)
                        <tr id='{{$role->id}}'>
                            <td>{{ $role->id }}</td>
                            <td id='id'>{{ $role->name }}</td>
                            <td class="col-md-3">
                            <a href={{ route('admin.clubs.roles.edit',$role->id )}} class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i></i>Editar </a>
                            <button href={{ route('admin.clubs.roles.delete',$role->id )}} class="btn btn-danger btn-sm" value={{$role->id}}><i class="fa fa-trash-o"></i>Eliminar </button>    
                            </td>
                        </tr>
                    @endforeach                
                </table>
                <center>{!! $roles->render() !!} </center>
            @else
             <center><h3>No hay roles de club</h3> </center>
            <br>
            <center><a href="{{route('admin.clubs.roles.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>Agregar rol de club</a></center>
            @endif
        </div>
    @endsection