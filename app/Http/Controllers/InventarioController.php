<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Codexshaper\WooCommerce\Facades\WooCommerce;
use Codexshaper\WooCommerce\Facades\Product;
use App\Services\WooCommerceService;

use RealRashid\SweetAlert\Facades\Alert;

class InventarioController extends Controller
{
    public function __construct(WooCommerceService $woocommerceService)
    {
        $this->woocommerceService = $woocommerceService;
    }

    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $page = $request->input('page', 1);
        $perPage = 100;

            // Obtener todos los productos desde la API de WooCommerce
            $products = $this->woocommerceService->getProducts($buscar, $page, $perPage);
            // Filtrar productos sin stock
            $outStockProducts = array_filter($products, function ($product) {
                return isset($product['stock_quantity']) && $product['stock_quantity'] <= 0;
            });

            // Ordenar productos de menor a mayor cantidad de stock
            usort($outStockProducts, function ($a, $b) {
                return $a['stock_quantity'] - $b['stock_quantity'];
            });

            // Filtrar productos con menos stoc
            $lowStockProducts = array_filter($products, function ($product) {
                return $product['stock_quantity'] >= 1 && $product['stock_quantity'] <= 10;
            });

            // Ordenar productos de menor a mayor cantidad de stock
            usort($lowStockProducts, function ($a, $b) {
                return $a['stock_quantity'] - $b['stock_quantity'];
            });

            $middleStockProducts = array_filter($products, function ($product) {
                return $product['stock_quantity'] >= 11 && $product['stock_quantity'] <= 30;
            });

            // Ordenar productos de menor a mayor cantidad de stock
            usort($middleStockProducts, function ($a, $b) {
                return $a['stock_quantity'] - $b['stock_quantity'];
            });

            $altoStockProducts = array_filter($products, function ($product) {
                return $product['stock_quantity'] >= 31 && $product['stock_quantity'] <= 70;
            });
            

            // Ordenar productos de menor a mayor cantidad de stock
            usort($altoStockProducts, function ($a, $b) {
                return $a['stock_quantity'] - $b['stock_quantity'];
            });

            $allStockProducts = array_filter($products, function ($product) {
                return $product['stock_quantity'] >= 71 && $product['stock_quantity'] <= 500;
            });
            

            // Ordenar productos de menor a mayor cantidad de stock
            usort($allStockProducts, function ($a, $b) {
                return $a['stock_quantity'] - $b['stock_quantity'];
            });

        // Si no se aplica el filtro de bajo stock, mostrar todos los productos
        return view('admin.inventario.index', compact('outStockProducts','lowStockProducts','middleStockProducts','altoStockProducts','allStockProducts'));
    }

}
