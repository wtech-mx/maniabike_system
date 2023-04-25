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

                        <input class="form-control" type="text"  id="" name="" >
                        </div>
                    </div>

                    <div class="col-12 form-group ">
                        <label for="" class="form-control-label label_form_custom">Descripcion</label>
                        <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="col-2 form-group ">
                        <label for="" class="form-control-label label_form_custom" style="margin-bottom: 1rem;">Generar </label>
                        <a id="generateBtn" style="background: #003249; padding: 10px;border-radius: 9px;">
                            <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/sincronizando.png') }}" alt="">
                        </a>
                    </div>

                    <div class="col-4 form-group ">
                        <label for="" class="form-control-label label_form_custom">SKU </label>
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/generate.png') }}" alt="">
                        </span>
                        <input class="form-control" type="number"  id="codeInput" name="" >
                        </div>
                    </div>

                    <div class="col-6 form-group ">
                        <label for="" class="form-control-label label_form_custom">Precio </label>
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/dolar.png') }}" alt="">
                        </span>

                        <input class="form-control" type="number"  id="" name="" >
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
const codeInput = document.getElementById('codeInput');

generateBtn.addEventListener('click', function() {
  const code = generateCode(8);
  codeInput.value = code;
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
  const codeInput = document.getElementById('codeInput');
  codeInput.value = generateRandomCode();
}

</script>
