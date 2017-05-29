<?php

use components\brand\Brand;
use components\product\Product;
use components\product\ColorProduct;
use components\store\Store;

Class Config
{

    static function get($key = null)
    {
        $config = [
            'product1' => new Product('3856', 'Tornacipo', 6000, new Brand('Tisza', 3)),
            'product2' => (new ColorProduct('7253', 'Pumacipo', 14000, new Brand('Puma', 4))),
            'store1' => new Store('Elso Bolt', 'Raday utca 66', 5),
            'store2' => new Store('Masodik bolt', '513. utca 12', 6)
        ];
        return (isset($config[$key])) ? $config[$key] : $config;
    }
}
