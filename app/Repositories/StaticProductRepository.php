<?php

namespace App\Repositories;

use App\Entities\Product;

class StaticProductRepository implements ProductRepository {

    /**
     * @var array
     */
    private $productData;

    /**
     * StaticNodeRepository constructor.
     */
    public function __construct()
    {
        $this->productData = [];

        if (($handle = fopen(storage_path('app/products.csv'), "r")) !== FALSE) {

            while (($data = fgetcsv($handle, null, ",")) !== FALSE) {
                $this->productData[$data[0]] = new Product($data[0], $data[2], $data[1]);
            }

            fclose($handle);
        }
    }

    /**
     * @return Node[]
     */
    public function all()
    {
        return collect($this->productData);
    }

    /**
     * @param $id
     * @return Node
     */
    public function findById($id)
    {
        return array_key_exists($id, $this->productData) ? $this->productData[$id] : null;
    }

    /**
     * @param $manufacturer
     * @return array|ø
     */
    public function findByManufacturer($manufacturer)
    {
       return array_filter($this->all(), function(Product $product) use ($manufacturer) {
           return $product->manufacturer() == $manufacturer;
       });
    }
}