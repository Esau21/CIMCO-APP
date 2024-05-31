@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Todos los <span>| Inventarios</span></h5>
                            <table id="tabla-contenedora"
                                class="table table-borderless datatable table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Operaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventarios as $in)
                                    <tr>
                                        <td>{{ $in->id }}</td>
                                        <td>{{ $in->nombre }}</td>
                                        <td>${{ number_format($in->precio, 2) }}</td>
                                        <td>
                                            <span class="badge bg-success 
                                                        {{ $in->stock >= 20 ? 'bg-success' : 
                                                        ($in->stock >= 10 ? 'bg-info' : 'bg-danger') 
                                                        }}">
                                                {{ $in->stock }}
                                            </span>
                                        </td>
                                        <td>
                                            <a onclick="editarProducto({{ $in->id }})"
                                                class="btn btn-sm btn-outline-info">Editar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3">
        {{ $inventarios->links() }}
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function editarProducto(id) {
        window.location.href = '/productos/' + id + '/edit';
    }


    function deleteProduct(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo!'
        }).then((resultado) => {
            if (resultado.isConfirmed) {
                $.ajax({
                    url: '/productos/' + id,
                    method: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(respuesta) {
                        Swal.fire({
                            title: 'Producto eliminado con exito',
                        })
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }
        });
    }
</script>