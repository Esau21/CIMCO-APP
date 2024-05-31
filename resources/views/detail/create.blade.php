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
                            <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Ingresa la cantidad">
                        </div>
                        <div class="form-group">
                            <label>Ucc</label>
                            <input type="text" name="UCC" id="UCC" class="form-control" placeholder="Ingresa un UCC de 12" maxlength="12">
                            @error('UCC')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
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
        $("#formulario-detailtransaccion").submit(function(e){
            e.preventDefault();
            agree_data_form();
        });
    });

    function agree_data_form()
    {
        var transaccionId = $("#transaccionId").val();
        var productId = $("#productId").val();
        var quantity = $("#quantity").val();
        var UCC = $("#UCC").val();

        if(UCC.length !== 12)
        {
            Swal.fire('error', 'El UCC debe de tner 12 cararteres y que sea unico y no se repita.', 'error');
            return;
        }

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
            success: function(response){
                Swal.fire('La transaccion del producto fue exitosa las existencias bajaron.', response.message, 'success');
                setTimeout(() => {
                    window.location.href = "{{ route('details') }}"
                }, 3000);
            }, 
            error: function(e){
                if (e.status === 400) {
                    Swal.fire('Error', e.responseJSON.message, 'error');
                } else {
                    Swal.fire('Error', 'Ha ocurrido un error.', 'error');
                }
            }
        });
    }
</script>