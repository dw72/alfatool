<?php

namespace Piniu\ProductsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Piniu\ProductsBundle\Entity\Product;

class ProductFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $product1 = new Product();
        $product1->setName('Pompa Paliwa');
        $product1->setDescription('Producent SIDAT');
        $product1->setImage('pompa-paliwa.jpg');
        $product1->setPrice(250);
        $product1->setCategory($manager->merge($this->getReference('category-1')));
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('Panewki wału korbowego');
        $product2->setDescription('Producent AE');
        $product2->setPrice(145);
        $product2->setCategory($manager->merge($this->getReference('category-1')));
        $manager->persist($product2);

        $product3 = new Product();
        $product3->setName('Zestaw śrub głowicy cylindrów');
        $product3->setDescription('Producent AJUSA');
        $product3->setPrice(90);
        $product3->setCategory($manager->merge($this->getReference('category-1')));
        $manager->persist($product3);

        $product4 = new Product();
        $product4->setName('Amortyzator');
        $product4->setDescription('Producent KAMOKA');
        $product4->setPrice(109);
        $product4->setCategory($manager->merge($this->getReference('category-2')));
        $manager->persist($product4);

        $product5 = new Product();
        $product5->setName('Amortyzator');
        $product5->setDescription('Producent OPTIMAL');
        $product5->setPrice(130);
        $product5->setCategory($manager->merge($this->getReference('category-2')));
        $manager->persist($product5);

        $product6 = new Product();
        $product6->setName('Błotnik');
        $product6->setDescription('Producent PRASCO');
        $product6->setImage('blotnik.jpg');
        $product6->setPrice(421);
        $product6->setCategory($manager->merge($this->getReference('category-3')));
        $manager->persist($product6);

        $product7 = new Product();
        $product7->setName('Kratka wentylacyjna zderzaka');
        $product7->setDescription('Producent KLOKKERHOLM');
        $product7->setImage('kratka-wentylacyjna.jpg');
        $product7->setPrice(131);
        $product7->setCategory($manager->merge($this->getReference('category-3')));
        $manager->persist($product7);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}