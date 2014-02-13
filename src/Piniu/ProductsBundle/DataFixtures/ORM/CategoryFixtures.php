<?php

namespace Piniu\ProductsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Piniu\ProductsBundle\Entity\Category;

class CategoryFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $category1 = new Category();
        $category1->setName('Silnik');
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName('Zawieszenie');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Karoseria');
        $manager->persist($category3);

        $manager->flush();

        $this->addReference('category-1', $category1);
        $this->addReference('category-2', $category2);
        $this->addReference('category-3', $category3);
    }

    public function getOrder()
    {
        return 1;
    }
}