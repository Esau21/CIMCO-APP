@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Todos los <span>| Proveedores</span></h5>
                            <p><a href="{{ route('proveedorcreate') }}" class="btn btn-sm btn-success">Agregar</a></p>
                            <table id="example" class="table table-borderless datatable table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Contacto</th>
                                        <th scope="col">Telefono</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Operaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proveedores as $key => $p)
                                    <tr>
                                        <td>{{$p->id}}</td>
                                        <td>{{$p->nombre}}</td>
                                        <td>{{$p->contacto}}</td>
                                        <td>{{$p->telefono}}</td>
                                        <td>{{$p->email}}</td>
                                        <td>
                                            <a class="btn btn-outline-info"
                                                onclick="editarProveedor({{ $p->id }})">Editar</a>
                                            <a class="btn btn-outline-danger"
                                                onclick="deleteProveedor({{ $p->id }})">Eliminar</a>
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
    {{$proveedores->links()}}
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function editarProveedor(id)
    {
        window.location.href = '/proveedor/' + id + '/edit';
    }

    function deleteProveedor(id) {
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
                url: '/proveedores/' + id,
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(respuesta) {
                    console.log(respuesta);
                    Swal.fire({
                        title: 'Proveedor eliminado con éxito',
                        icon: 'success'
                    });
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