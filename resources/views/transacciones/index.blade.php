@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Todas las <span>| Transacciones</span></h5>
                            <p><a href="{{ route('create') }}" class="btn btn-sm btn-success">Agregar</a></p>
                            <table id="example" class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Observaciones</th>
                                        <th scope="col">Proveedor</th>
                                        <th scope="col">Usuario</th>
                                        <th scope="col">Operaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trasaccion as $t)
                                    <tr>
                                        <td>{{$t->id}}</td>
                                        <td>{{$t->fecha}}</td>
                                        <td>{{$t->hora}}</td>
                                        <td>{{$t->tipo}}</td>
                                        <td>{{$t->observaciones}}</td>
                                        <td>{{$t->nombrepro}}</td>
                                        <td>{{$t->nameu}}</td>
                                        <td>
                                            <a class="btn btn-outline-info"
                                                onclick="EditarTransaccion({{ $t->id }})">Editar</a>
                                            <a class="btn btn-outline-danger"
                                                onclick="deleteTransaccion({{ $t->id }})">Eliminar</a>
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
    {{$trasaccion->links()}}
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function EditarTransaccion(id)
    {
        window.location.href = '/transaccion/' + id + '/edit';
    }

    function deleteTransaccion(id) {
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
                url: '/trasaccion/' + id,
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