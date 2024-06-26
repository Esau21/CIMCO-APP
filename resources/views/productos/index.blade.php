@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Todos los <span>| Productos</span></h5>
                            <p><a href="{{ route('createproducto') }}" class="btn btn-sm btn-success">agregar</a></p>
                            <table id="tabla-contenedora"
                                class="table table-borderless datatable table-bordered table-sm">
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
                                    @foreach ($productos as $p)
                                    <tr>
                                        <td>{{ $p->id }}</td>
                                        <td>{{ $p->nombre }}</td>
                                        <td>{{ $p->descripcion }}</td>
                                        <td>${{ number_format($p->precio, 2) }}</td>
                                        <td>
                                            <span class="badge bg-success 
                                                        {{ $p->stock >= 20 ? 'bg-success' : 
                                                        ($p->stock >= 10 ? 'bg-info' : 'bg-danger') 
                                                        }}">
                                                {{ $p->stock }}
                                            </span>
                                        </td>
                                        <td>
                                            <a onclick="editarProducto({{ $p->id }})"
                                                class="btn btn-sm btn-outline-info">Editar</a>
                                            <a onclick="deleteProduct({{ $p->id }})"
                                                class="btn btn-sm btn-outline-danger">Eliminar</a>
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
        {{ $productos->links() }}
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