@php
             $imageSrc = $item['images'][0]['src'];

             $clave_mayorista = null;
             $nombre_del_proveedor = null;
             $costo = null;
             $id_proveedor = null;


            foreach ($item['meta_data'] as $valor) {
                if ($valor['key'] === 'clave_mayorista') {
                    $clave_mayorista = $valor['value'];
                    break;
                }
            }
            foreach ($item['meta_data'] as $valor) {
                if ($valor['key'] === 'nombre_del_proveedor') {
                    $nombre_del_proveedor = $valor['value'];
                    break;
                }
            }
            foreach ($item['meta_data'] as $valor) {
                if ($valor['key'] === 'id_proveedor') {
                    $id_proveedor = $valor['value'];
                    break;
                }
            }
            foreach ($item['meta_data'] as $valor) {
                if ($valor['key'] === 'costo') {
                    $costo = $valor['value'];
                    break;
                }
            }
@endphp
