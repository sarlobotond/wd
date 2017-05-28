<?php

use PHPUnit\Framework\TestCase;
use components\store\Stores;

include 'config.php';

final class StoresTest extends TestCase
{

  protected function createStores()
  {
    $stores = new Stores();
    $stores->addStore(Config::get('store1'))
        ->addStore(Config::get('store2'));
    return $stores;
  }

  // létrehoz	2	raktárat,	felvesz	x	terméket,	kikér	y	terméket,	
  public function testAllOk()
  {
    echo "\nlétrehoz 2 raktárat, felvesz x terméket, kikér y terméket\n";
    $addProduct = 3; // less than store capacity
    $removeProduct = 1;
    $stores = $this->createStores();
    $shoe1 = Config::get('product1');
    $shoe2 = Config::get('product2');
    $shoe2->setColor('fekete');

    echo "Add: $addProduct $shoe1 " . PHP_EOL;
    $stores->addProduct($shoe1, $addProduct);
    echo $stores;
    echo "Add: 1 $shoe2 " . PHP_EOL;
    $stores->addProduct($shoe2, 1);
    echo $stores;

    echo "Remove:  $shoe1" . PHP_EOL;
    $stores->removeProduct($shoe1, $removeProduct);
    $stockpile = $stores->getStoreByName(Config::get('store1')->getName())->getStockpile($shoe1);

    $this->assertEquals($stockpile, $addProduct - $removeProduct);
    echo $stores;
  }

  // létrehoz	2	raktárat,	felvesz	x	terméket,	de	nincs	elég	hely	a	raktárakban,	
  public function testnotEnoughStorage()
  {
    echo "\nlétrehoz 2 raktárat, felvesz x terméket, de nincs elég hely a raktárakban\n";
    $this->expectException(\components\store\NotEnoughStorageException::class);

    $stores = $this->createStores();
    $shoe1 = Config::get('product1');
    $shoe2 = Config::get('product2');

    $stores->addProduct($shoe1, 6);
    $stores->addProduct($shoe2, 6);
  }

  // létrehoz	2	raktárat,	felvesz	x	terméket,	majd	kikér	többet,	mint	amennyi	elérhető.	
  public function testnotEnoughProduct()
  {
    echo "\nlétrehoz 2 raktárat, felvesz x terméket, majd kikér többet, mint amennyi elérhető";
    $this->expectException(\components\store\NotEnoughProductException::class);

    $addProduct = 6;
    $removeProduct = 7;

    $stores = $this->createStores();
    $shoe1 = Config::get('product1');

    $stores->addProduct($shoe1, $addProduct);
    $stores->removeProduct($shoe1, $removeProduct);
  }
}
