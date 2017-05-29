<?php

use components\store\Stores;
use components\store\NotEnoughProductException;
use components\store\NotEnoughStorageException;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

include '..' . DIRECTORY_SEPARATOR . 'autoload.php';
include 'config.php';

function allOk($config)
{
    echo "\nLétrehoz 2 raktárat, felvesz x terméket, kikér y terméket\n\n";
    echo "Betesz 2 + 6 kivesz 1\n";
    $stores = new Stores;
    $stores->addStore($config['store1'])
        ->addStore($config['store2'])
        ->addProduct($config['product1'], 2)
        ->addProduct($config['product1'], 6)
        ->removeProduct($config['product1'], 1);
    print_r($stores);
}

function notEnoughStorage($config)
{
    echo "\nLétrehoz 2 raktárat, felvesz x terméket, de nincs elég hely a raktárakban\n\n";
    echo "Raktar 5 + 6, betesz  6 + 6\n";
    $stores = new Stores;
    $stores->addStore($config['store1'])
        ->addStore($config['store2'])
        ->addProduct($config['product1'], 6);

    try {
        $stores->addProduct($config['product2'], 6);
    } catch (NotEnoughStorageException $exc) {
        echo $exc->getMessage();
    }
}

function notEnoughProduct($config)
{
    echo "\nLétrehoz 2 raktárat, felvesz x terméket, majd kikér többet, mint amennyi elérhető\n\n";
    echo "Betesz 6-ot Kivesz 2-t\n";
    $stores = new Stores;
    $stores->addStore($config['store1'])
        ->addStore($config['store2'])
        ->addProduct($config['product1'], 6)
        ->addProduct($config['product2'], 2);
    try {
        $stores->removeProduct($config['product1'], 7);
    } catch (NotEnoughProductException $exc) {
        echo $exc->getMessage();
    }
}
allOk(Config::get());
notEnoughStorage(Config::get());
notEnoughProduct(Config::get());

