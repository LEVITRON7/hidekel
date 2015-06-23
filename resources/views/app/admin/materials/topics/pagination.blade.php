<hr>
<div style="float:right;"> Hay {{ $MaterialsTopics->total() }} registros</div>
<center><h3>Tópicos de materiales</h3></center>
    <table class="table table-striped">
            <thead>
                <td>Id</td>
                <td>Nombre</td>
                <td>Accciones</td>
            </thead>
        @foreach($MaterialsTopics as $topic)
            <tr id='{{$topic->id}}'>
                <td>{{ $topic->id }}</td>
                <td id='id'>{{ $topic->name }}</td>
                <td class="col-md-3">
                <a href={{ route('admin.materials.topics.edit',$topic->id )}} class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i>Editar </a>
                <button href={{ route('admin.materials.topics.delete',$topic->id )}} class="btn btn-danger btn-sm" value={{$topic->id}}><i class="fa fa-trash-o"></i> Eliminar </button>            
                </td>
            </tr>
        @endforeach                
    </table>
    <center>{!! $MaterialsTopics->render() !!} </center>