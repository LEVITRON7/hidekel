@extends('appadmin')
    @section('side-center')
        <div class="col-sm-6 col-md-8 pagination-div">
            <div  id="results">
            @if (count($members)!= 0)
            <div style="float:right;"> Hay {{ $members->total() }} registros</div>
            <hr>
                <table class="table table-striped" >
                        <thead>
                            <td>Foto</td>
                            <td>Nombre</td>
                            <td>Rol</td>
                            <td>Accciones</td>
                        </thead>
                    @foreach($members as $member)
                        <tr id = "{{$member->id}}"> 
                            <td class="col-md-2">
                                <img class="img-responsive img-shadow" src=
                                    @if ($member->photo =='')
                                        'http://placehold.it/300x200'
                                    @else
                                        '/images/photos/{{$member->photo}}'
                                    @endif
                                >
                            </td>
                            <td> <h4 id="id" style="margin-top:5;margin-bottom:0;">{{ $member->fullname }}</h4>{{ $member->clubclass->name }} <small>{{ $member->user['email'] }} </td>
                            {{--<td>{{ $member->clubrole->role->name }}, {{ $member->clubrole->club->type }}</td>!--}}
                            <td >{{ $member->role->name }} <br> {{ $member->club->type }}</td>
                            <td class="col-md-5"> 
                            <a href={{ route('admin.members.show',$member->id )}} class="btn btn-primary btn-sm"> <i class="fa fa-bars"></i>&nbsp;Detalles </a>
                            <a href={{ route('admin.members.edit',$member->id )}} class="btn btn-info btn-sm"> <i class="fa fa-pencil-square-o"></i>&nbsp;Editar </a>
                            <button href={{ route('admin.members.delete',$member->id )}} class="btn btn-danger btn-sm" value={{$member->id}}> <i class="fa fa-trash-o"></i>&nbsp;Eliminar </button>            
                            </td>
                        </tr>
                    @endforeach
                </table>        
                  <center>{!! $members->render() !!} </center>
            @else
                <center><h3>No hay miembros registrados</h3></center>
            @endif
            </div>
        </div>
@endsection