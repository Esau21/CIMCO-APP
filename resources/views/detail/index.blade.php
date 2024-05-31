@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Detalles <span>| Transacciones</span></h5>
                            <p><a href="{{ route('detailscreate') }}" class="btn btn-sm btn-success">Agregar</a></p>
                            <div class="col-sm-12">
                                <table id="example" class="table table-borderless table-sm datatable table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col" class="text-center">Fecha</th>
                                            <th scope="col" class="text-center">Producto</th>
                                            <th scope="col" class="text-center">Cantidad</th>
                                            <th scope="col" class="text-center">UCC</th>
                                            <th scope="col" class="text-center">Operaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailstrasacciones as $d)
                                        <tr>
                                            <td class="text-center">{{$d->id}}</td>
                                            <td class="text-center">{{$d->date}}</td>
                                            <td class="text-center">{{$d->namepro}}</td>
                                            <td class="text-center">{{$d->quantity}}</td>
                                            <td class="text-center">{{$d->UCC}}</td>
                                            <td class="text-center">
                                                <a class="btn btn-outline-info"
                                                    onclick="editarDetailTransaccion({{ $d->id }})">Editar</a>
                                                <a class="btn btn-outline-danger"
                                                    onclick="deleteDetailsTransaccion({{ $d->id }})">Eliminar</a>
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
    </div>
    {{$detailstrasacciones->links()}}
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function editarDetailTransaccion(id)
    {
        window.location.href = '/detail/' + id + '/edit';
    }

    function deleteDetailsTransaccion(id)
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
                    url : '/detailtransaccion/' + id,
                    method: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(respuesta)
                    {
                        Swal.fire({
                            title: 'Se elimino la transaccion',
                            icon: 'success'
                        });
                        setTimeout(() => {
                           location.reload() 
                        }, 1000);
                    },
                    error: function(e)
                    {
                        Swal.fire('error', 'No se puede eliminar el detalle de la transaccion', 'error');
                    }
                });
            }
        });
    }
</script>