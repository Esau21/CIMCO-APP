@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Todos los <span>| Productos</span></h5>
                            <p><a href="{{ route('create') }}" class="btn btn-sm btn-success">agregar</a></p>
                            <table id="tabla-contenedora" class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Operaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3">
        {{ $productos->links() }}
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        console.log('Hola');
        principal();
    });

    function principal()
    {
        cargar_todos_los_productos();
    }

    function cargar_todos_los_productos()
    {
        $.ajax({
            url: '/productos',
            method: 'POST',
            data: {
                id: 1,
                _token: $('input[name="_token"]').val(),
            },
            success: function(respuesta) {
                console.log(respuesta);
                dibujar_tabla(respuesta);
            },
            error: function(e){
                console.log(e);
            }
        });
    }

    function dibujar_tabla(respuesta) {
    $("#tabla-contenedora tbody").empty();
    if (respuesta && respuesta.data) { 
        for (var i = 0; i < respuesta.data.length; i++) { 
            var fila = $("<tr>");
            fila.append($("<td>").html(respuesta.data[i].id));
            fila.append($("<td>").html(respuesta.data[i].nombre));
            fila.append($("<td>").html(respuesta.data[i].descripcion));
            fila.append($("<td>").html('$' + respuesta.data[i].precio));
            fila.append($("<td>").html(respuesta.data[i].stock));
            fila.append(
                $("<td>").html(
                    '<button class="btn btn-sm btn-rounded btn-danger mr-2" onclick="deleteProduct(' + respuesta.data[i].id + ')">Eliminar</button>' +
                    '<button class="btn btn-sm btn-rounded btn-primary" onclick="editarProducto(' + respuesta.data[i].id + ')">Editar</button>'
                )
            );
            
            $("#tabla-contenedora tbody").append(fila); 
        }
    } else {
        console.log('La respuesta no contiene datos o la propiedad "data" está indefinida.');
    }
}


function editarProducto(id)
{
    window.location.href = '/productos/' + id + '/edit';
}


function deleteProduct(id)
{
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!'
    }).then((resultado) => {
        if(resultado.isConfirmed){
            $.ajax({
                url: '/productos/' + id,
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(respuesta){
                    Swal.fire({
                        title: 'Producto eliminado con exito',
                    })
                    cargar_todos_los_productos();
                },
                error: function(e){
                    console.log(e);
                }
            });
        }
    });
}


</script>