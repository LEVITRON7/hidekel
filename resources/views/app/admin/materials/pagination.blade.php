<div  id="results">        
@if(count($materials) !== 0)
<hr>
<div style="float:right;"> Hay {{$materials->total() }} registros</div>
    <table class="table table-striped">
            <thead>
                <td>Material</td>
                <td>Tipo</td>
                <td>Accciones</td>
            </thead>
            @foreach($materials as $material)
                <tr id = '{{ $material->id }}' >
                    <td > <h4 id="id" style="margin-top:5;margin-bottom:0;">{{ $material->name }}</h4>
                        @if(($material->file!='') and ($material->extension != 'youtube.com'))
                        <a href="/files/materials/{{ $material->file }}">Descargar</a>
                        @elseif($material->extension == 'youtube.com')
                        <small>Es un video </small>
                        @else
                        <small>No hay archivo </small>
                        @endif
                    </td>
                    <td>{{ $material->type->name }} <br>{{ $material->topic->name }} </td>
                    <td class="col-md-5"> 
                    <a href={{ route('admin.materials.show',$material->id )}} class="btn btn-primary btn-sm"><i class="fa fa-bars"></i>Detalles</a> 
                    <a href={{ route('admin.materials.edit',$material->id )}} class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i>  Editar </a>  
                    <button href={{ route('admin.materials.delete',$material->id )}} class="btn btn-danger btn-sm" value={{$material->id}}> <i class="fa fa-trash-o"></i> Eliminar </button>            
                    </td>
                </tr>
            @endforeach
    </table>
@else
    <h3>No se encontró ningun resultado</h3>
@endif
    <center>{!! $materials->render() !!} </center>
</div>