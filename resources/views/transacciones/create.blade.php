@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Agregar nueva <span>| Transaccion</span></h5>
                    <form action="{{ route('transaccionstore') }}" id="formulario-transaccion" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="date" name="fecha" id="fecha" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Hora</label>
                            <input type="time" name="hora" id="hora" class="form-control"
                                placeholder="Ingresa el contacto del proveedor">
                        </div>
                        <div class="form-group">
                            <label>Tipo</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="Elegir">Elegir</option>
                                <option value="Salida">Salida</option>
                                <option value="Entrada">Entrada</option>
                                <option value="Ajuste">Ajuste</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="observaciones" id="observaciones" cols="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Usuario</label>
                            <select name="usuarioId" id="usuarioId" class="form-control">
                                <option value="Elegir">Elegir</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u['id'] }}">{{$u->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Proveedor</label>
                            <select name="proveedorId" id="proveedorId" class="form-control">
                                <option value="Elegir">Elegir</option>
                                @foreach ($proveedores as $p)
                                    <option value="{{ $p['id'] }}">{{$p->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center pt-2">
                            <button type="submit" class="btn btn-sm btn-success">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function(){
        console.log('Hola');
        $("#formulario-transaccion").submit(function(e){
            e.preventDefault();
            agree_data_form();
        })
    });

    function agree_data_form()
    {
        var fecha = $("#fecha").val();
        var hora = $("#hora").val();
        var tipo = $("#tipo").val();
        var observaciones = $("#observaciones").val();
        var usuarioId = $("#usuarioId").val();
        var proveedorId = $("#proveedorId").val();

        $.ajax({
            url: '{{ route('transaccionstore') }}',
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                fecha: fecha,
                hora: hora,
                tipo: tipo,
                observaciones: observaciones,
                usuarioId: usuarioId,
                proveedorId: proveedorId,
            },
            success: function(respuesta){
                Swal.fire('Transaccion insertada correctamente.');
                setTimeout(() => {
                    window.location.href = "{{ route('transaccion') }}"
                }, 1000);
            }, 
            error: function(e){
                console.log(e);
            }
        });
    }
</script>