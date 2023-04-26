<!-- Modal -->
<div class="modal fade" id="modal_creat_product" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Producto</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('product_woo.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="row">

                    <div class="col-12 form-group ">
                        <label for="" class="form-control-label label_form_custom">Nombre del producto</label>
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/llantas.png') }}" alt="">
                        </span>

                        <input class="form-control" type="text"  id="name" name="name" >
                        </div>
                    </div>

                    <div class="col-12 form-group ">
                        <label for="" class="form-control-label label_form_custom">Descripcion</label>
                        <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="col-6 form-group ">
                        <label for="" class="form-control-label label_form_custom" style="margin-bottom: 1rem;">Generar </label> <br>
                        <a id="generateBtn" style="background: #003249; padding: 10px;border-radius: 9px;">
                            <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/sincronizando.png') }}" alt="">
                        </a>
                    </div>

                    <div class="col-6 form-group ">
                        <label for="" class="form-control-label label_form_custom">SKU </label>
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/generate.png') }}" alt="">
                        </span>
                        <input class="form-control" type="number"  id="sku" name="sku" >
                        </div>
                    </div>

                    <div class="col-6 form-group ">
                        <label for="" class="form-control-label label_form_custom">Cantidad </label>
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/cajas.png') }}" alt="">
                        </span>

                        <input class="form-control" type="number"  id="stock_quantity" name="stock_quantity" >
                        </div>
                    </div>

                    <div class="col-6 form-group ">
                        <label for="" class="form-control-label label_form_custom">Precio </label>
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/dolar.png') }}" alt="">
                        </span>

                        <input class="form-control" type="number"  id="regular_price" name="regular_price" >
                        </div>
                    </div>

                    <div class="col-6 form-group ">
                        <label for="" class="form-control-label label_form_custom">ID Proveedor </label>
                        <div class="input-group input-group-alternative mb-4">
                        <input class="form-control" type="text"  id="id_proveedor" name="id_proveedor" >
                        </div>
                    </div>

                    <div class="col-6 form-group ">
                        <label for="" class="form-control-label label_form_custom">Proveedor </label>
                        <div class="input-group input-group-alternative mb-4">
                        <input class="form-control" type="text"  id="nombre_del_proveedor" name="nombre_del_proveedor" >
                        </div>
                    </div>

                    <div class="col-6 form-group ">
                        <label for="" class="form-control-label label_form_custom">Costo </label>
                        <div class="input-group input-group-alternative mb-4">
                        <input class="form-control" type="number"  id="costo" name="costo" >
                        </div>
                    </div>

                    <div class="col-6 form-group ">
                        <label for="" class="form-control-label label_form_custom">Calve Mayoreo </label>
                        <div class="input-group input-group-alternative mb-4">
                        <input class="form-control" type="text"  id="clave_mayorista" name="clave_mayorista" >
                        </div>
                    </div>

                    <div class="col-12 form-group ">
                        <label for="" class="form-control-label label_form_custom">Imagen del producto</label>
                        <div class="input-group input-group-alternative mb-4">
                        <input class="form-control" type="file"  id="image" name="image" >
                        </div>
                    </div>

                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

const generateBtn = document.getElementById('generateBtn');
const sku = document.getElementById('sku');

generateBtn.addEventListener('click', function() {
  const code = generateCode(8);
  sku.value = code;
});

function generateCode(length) {
  let result = '';
  const characters = '0123456789';
  const charactersLength = characters.length;
  for (let i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}

function handleClick(event) {
  event.preventDefault();
  const sku = document.getElementById('sku');
  sku.value = generateRandomCode();
}

</script>
