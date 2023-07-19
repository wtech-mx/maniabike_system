<form id="formulario-pdf" action="{{ route('generar.pdf') }}" method="POST">
    @csrf
    <div class="table-responsive">
        <table class="table table-flush" id="myTable">
            <thead class="text-center">
                <tr class="tr_checkout text-white">
                    <th class="text-center">.</th>
                    <th class="text-center">Imagen</th>
                    <th class="text-left">Proveedor</th>
                    <th class="text-left">Nombre</th>
                    <th class="text-center">Sku</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $item)
                    @php
                        $nombre_del_proveedor = null;
                            foreach ($item->meta_data as $item2) {
                            if ($item2->key === 'nombre_del_proveedor') {
                                $nombre_del_proveedor = $item2->value;
                                break;
                            }
                        }
                        $imageSrc = $item->images[0]->src;
                    @endphp
                    <tr class="text-white">
                        <td class="text-white text-left" style="font-size:11px;">
                            <input type="checkbox" name="productos_seleccionados[]" value="{{ $item->sku }}">
                        </td>
                        <td class="text-white text-center" style="font-size:11px;">
                            <a data-bs-toggle="modal" type="button" data-bs-target="#edit_modal_product{{ $item->id }}" style="font-size:11px;">
                                <img src="{{$imageSrc}}" style="width:50px;"></br>{{ $item->stock_quantity }}
                            </a>
                        </td>
                        <td class="text-white text-left" style="font-size:11px;">{{ $nombre_del_proveedor }}</td>
                        <td class="text-white text-left" style="font-size:11px;">{{ $item->name }}</td>
                        <td class="text-white text-center" style="font-size:11px;">{{ $item->sku }}</td>
                        <td class="text-white text-center" style="font-size:11px;">${{ $item->price }}.0</td>
                        <td class="text-white text-center" style="font-size:11px;">
                            {{-- <form class="row" style="display: inline-block;margin-left: 10px;" method="POST" action="{{ route('scanner_product.delete', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#generarpdf">Generar PDF</button>

    <div class="modal fade" id="generarpdf" tabindex="-1" aria-labelledby="generarpdfLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="generarpdfLabel">Generar PDF</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-12">
                        <label for="">Seleciona a quien va dirigido</label>
                        <select class="form-select" id="tipo" name="tipo">
                            <option selected>Seleciona la opcion</option>
                            <option value="Mayorista">Mayorista</option>
                            <option value="Minorista">Minorista</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="generar-btn" type="submit" class="btn btn-primary">Generar</button>
                    <a id="boton-descargar" target="_blank" class="btn btn-success" style="display: none;">Descargar</a>
                </div>
            </div>
        </div>
    </div>
</form>

@section('select2')

<script>
    $(document).ready(function() {
        $("#formulario-pdf").submit(function(event) {
            event.preventDefault();

            var productosSeleccionados = $("input[name='productos_seleccionados[]']:checked")
                .map(function() {
                    return $(this).val();
                })
                .get();

            if (productosSeleccionados.length === 0) {
                alert("Selecciona al menos un producto para generar el PDF.");
                return;
            }

            var tipoSeleccionado = $("#tipo").val();
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: {
                    productos: productosSeleccionados,
                    tipo: tipoSeleccionado,
                    _token: token
                },
                success: function(response) {
                    console.log(response);
                    // Aquí puedes manejar la respuesta del servidor, por ejemplo, mostrar un mensaje de éxito o redirigir a una página con el PDF generado.
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });

    $(document).ready(function() {
        var selectTipo = $("#tipo");
        var botonDescargar = $("#boton-descargar");
        botonDescargar.hide();
        selectTipo.change(function() {
            if (selectTipo.val() === "Mayorista") {
                botonDescargar.text("Descargar Mayorista");
                botonDescargar.attr("href", "https://taller.maniabikes.com.mx/pdf/productos.pdf");
                botonDescargar.show();
            } else if (selectTipo.val() === "Minorista") {
                botonDescargar.text("Descargar Minorista");
                botonDescargar.attr("href", "https://taller.maniabikes.com.mx/pdf/productos_mayoreo.pdf");
                botonDescargar.show();
            } else {
                botonDescargar.text("");
                botonDescargar.attr("href", "#");
            }
            setTimeout(function() {
                botonDescargar.show();
            }, 10000);
        });
    });
</script>
@endsection
