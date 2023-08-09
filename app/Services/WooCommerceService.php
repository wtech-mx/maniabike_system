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
            return array_diff_key($item, array_flip(['slug', 'type', 'status', 'featured', 'catalog_visibility']));
        }, $data);

        return $filteredData;
    }


}
