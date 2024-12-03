<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName('Keyboard');
        $product->setSize(100);
        $product->setDescription('Ergonomic and stylish!');

        $manager->persist($product);

        $product1 = new Product();
        $product1->setName('Mouse');
        $product1->setSize(50);
        $product1->setDescription('Wireless and easy to use!');

        $manager->persist($product1);

        $manager->flush();
    }
}
