@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Agregar nueva <span>| Transaccion</span></h5>
                    <form action="{{ route('updatedetailT', $detailT->id) }}" id="formulario-detailtransaccion" method="POST">
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
                            <input type="text" name="quantity" id="quantity" class="form-control"
                                placeholder="Ingresa la cantidad" value="{{$detailT->quantity}}">
                        </div>
                        <div class="form-group">
                            <label>Ucc</label>
                            <input type="text" name="UCC" id="UCC" class="form-control"
                                placeholder="Ingresa un UCC de 12" value="{{$detailT->UCC}}" maxlength="12">
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
    $(document).ready(function(){
        console.log('Hola');
        $("#formulario-detailtransaccion").submit(function(e){
            e.preventDefault();
            update_data_form();
        })
    });

    function update_data_form()
    {
        var id = {{$detailT->id}};
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
            url: '/detailt/' + id,
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                _method: 'PUT',
                transaccionId: transaccionId,
                productId: productId,
                quantity: quantity,
                UCC: UCC,
            },
            success: function(respuesta){
                Swal.fire('Transaccion actualizada correctamente subieron las existencias de los productos.');
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