@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Agregar nuevos <span>| productos</span></h5>
                    <form action="{{ route('update', $productos->id) }}" id="formulario-producto" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresa el nombre del producto" value="{{$productos->nombre}}">
                        </div>
                        <div class="form-group">
                            <label>Descripcion</label>
                            <input name="descripcion" id="descripcion" class="form-control" placeholder="Ingresa la descripcion del producto" value="{{$productos->descripcion}}">
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input type="text" name="precio" id="precio" class="form-control" placeholder="Ingresa el precio del producto" pattern="[0-9]+([,\.][0-9]+)?" value="{{$productos->precio}}" title="Ingrese un valor numérico válido">
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock" id="stock" class="form-control" placeholder="Ingresa el stock del producto" value="{{$productos->stock}}">
                        </div>
                        <div class="text-center pt-2">
                            <button type="submit" class="btn btn-sm btn-success">Actualizar</button>
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
    $(document).ready(function(respuesta) {
        console.log('Cargando');
        $("#formulario-producto").submit(function(e) {
            e.preventDefault();
            update_data_form();
        });
    });


    function update_data_form(id)
    {
        var id = {{ $productos->id }};
        var nombre = $("#nombre").val();
        var descripcion = $("#descripcion").val();
        var precio = $("#precio").val();
        var stock = $("#stock").val();

        $.ajax({
            url: '/productos/' + id,
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                _method: 'PUT',
                nombre: nombre,
                descripcion: descripcion,
                precio: precio,
                stock: stock,
            },
            success: function(respuesta) {
                Swal.fire({
                    title: 'Los datos fueron modificados con exito'
                });
                setTimeout(() => {
                    window.location.href = "{{ route('productos') }}";
                }, 1000);
                
            }, 
            error: function(e) {
                alert('Los datos no se pudieron insertar');
            }
        });
    }
</script>