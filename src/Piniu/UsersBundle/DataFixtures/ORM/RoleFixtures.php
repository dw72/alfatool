<?php

namespace Piniu\UsersBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Piniu\UsersBundle\Entity\Role;

class RoleFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $role1 = new Role();
        $role1->setName('Administrator');
        $role1->setRole('ROLE_ADMIN');
        $manager->persist($role1);

        $role2 = new Role();
        $role2->setName('Klient');
        $role2->setRole('ROLE_USER');
        $manager->persist($role2);

        $manager->flush();

        $this->addReference('role-1', $role1);
        $this->addReference('role-2', $role2);
    }

    /**
     * {@inheritDoc}
     */
    function getOrder()
    {
        return 1;
    }
}