@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Agregar nuevos <span>| proveedores</span></h5>
                    <form action="{{ route('store') }}" id="formulario-proveedor" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control"
                                placeholder="Ingresa el nombre del proveedor">
                        </div>
                        <div class="form-group">
                            <label>Contacto</label>
                            <input name="contacto" id="contacto" class="form-control"
                                placeholder="Ingresa el contacto del proveedor">
                        </div>
                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control"
                                placeholder="Ingresa el telefono del proveedor">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Ingresa el email del proveedor">
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
        $("#formulario-proveedor").submit(function(e){
            e.preventDefault();
            agree_data_form();
        })
    });

    function agree_data_form()
    {
        var nombre = $("#nombre").val();
        var contacto = $("#contacto").val();
        var telefono = $("#telefono").val();
        var email = $("#email").val();

        $.ajax({
            url: '{{ route('store') }}',
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                nombre: nombre,
                contacto: contacto,
                telefono: telefono,
                email: email,
            },
            success: function(respuesta){
                Swal.fire('Datos insertados correctamente.');
                setTimeout(() => {
                    window.location.href = "{{ route('proveedores') }}"
                }, 1000);
            }, 
            error: function(e){
                console.log(e);
            }
        });
    }
</script>