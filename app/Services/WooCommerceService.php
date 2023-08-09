<?php

// app/Services/WooCommerceService.php

namespace App\Services;

use GuzzleHttp\Client;

class WooCommerceService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getProducts($search, $page = 1, $perPage = 25)
    {
        $response = $this->client->request('GET', 'https://www.maniabikes.com.mx/inicio/wp-json/wc/v3/products', [
            'auth' => ['ck_669c65e13b042664bbf29cc9dd04f86b33b8f568', 'cs_4e770f2fa9f7bc9f5aca5d9bb5c3cda3478fea9a'],
            'query' => [
                'search' => $search,
                'page' => $page,
                'per_page' => $perPage,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Filtrar los datos que no deseas incluir
        $filteredData = array_map(function ($item) {
            return array_diff_key($item, array_flip([
            'slug',
            'type',
             'status',
             'featured',
             'catalog_visibility',
            'short_description',
            'description',
            'date_on_sale_from',
            'date_on_sale_from_gmt',
            'date_on_sale_to',
            'date_on_sale_to_gmt',
            'on_sale',
            'purchasable',
            'virtual',
            'downloadable',
            'downloads',
            'download_limit',
            'yoast_head',
            'etheme_brands',
            'has_options',
            'related_ids',
            'price_html',
            'menu_order',
            'grouped_products',
            'variations',
            'default_attributes',
            'attributes',
            'tags',
            'categories',
            'purchase_note',
            'parent_id',
            'cross_sell_ids',
            'upsell_ids',
            'rating_count',
            'average_rating',
            '_links',
            'yoast_head_json',
            'stock_status',
            'reviews_allowed',
            'shipping_class_id',
            'shipping_class',
            'shipping_taxable',
            'shipping_required',
            'dimensions',
            'weight',
            'sold_individually',
            'low_stock_amount',
            'backordered',
            'backorders',
            'backorders_allowed',
            'manage_stock',
            'tax_class',
            'tax_status',
            'download_expiry',
            'external_url',
            'button_text',
        ]));
        }, $data);

        return $filteredData;
    }


}
