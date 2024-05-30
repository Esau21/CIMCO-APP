@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Agregar nueva <span>| Transaccion</span></h5>
                    <form action="{{ route('detailtransaccion') }}" id="formulario-detailtransaccion" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Transaccion</label>
                            <select name="transaccionId" id="transaccionId" class="form-control">
                                <option value="Elegir">Elegir</option>
                                @foreach ($transaccion as $t)
                                    <option value="{{ $t['id'] }}">{{$t->fecha}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Producto</label>
                            <select name="productId" id="productId" class="form-control">
                                <option value="Elegir">Elegir</option>
                                @foreach ($productos as $p)
                                    <option value="{{ $p['id'] }}">{{$p->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cantidad</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Ingresa la cantidad">
                        </div>
                        <div class="form-group">
                            <label>Ucc</label>
                            <input type="text" name="UCC" id="UCC" class="form-control" placeholder="Ingresa un UCC de 12">
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
        $("#formulario-detailtransaccion").submit(function(e){
            e.preventDefault();
            agree_data_form();
        })
    });

    function agree_data_form()
    {
        var transaccionId = $("#transaccionId").val();
        var productId = $("#productId").val();
        var quantity = $("#quantity").val();
        var UCC = $("#UCC").val();

        $.ajax({
            url: '{{ route('detailtransaccion') }}',
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                transaccionId: transaccionId,
                productId: productId,
                quantity: quantity,
                UCC: UCC,
            },
            success: function(respuesta){
                Swal.fire('Transaccion insertada correctamente bajaron las existencias de los productos.');
                setTimeout(() => {
                    window.location.href = "{{ route('details') }}"
                }, 1000);
            }, 
            error: function(e){
                console.log(e);
            }
        });
    }
</script>