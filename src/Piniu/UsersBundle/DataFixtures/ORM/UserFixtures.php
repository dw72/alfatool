<?php
namespace Piniu\UsersBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Piniu\UsersBundle\Entity\User;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        var_dump('getting container here');
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername("admin");
        $user1->setFirstname("Zbigniew");
        $user1->setLastname("Kostka");
        $user1->setSalt(md5(uniqid()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user1);
        $user1->setPassword($encoder->encodePassword('piniu', $user1->getSalt()));
        $user1->setEmail("zkostka@gostyn.pl");
        $user1->setRole($manager->merge($this->getReference('role-1')));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername("user");
        $user2->setFirstname("Dariusz");
        $user2->setLastname("Włodarczyk");
        $user2->setSalt(md5(uniqid()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user2);
        $user2->setPassword($encoder->encodePassword('milley', $user2->getSalt()));
        $user2->setEmail("milley@krotoszyn.pl");
        $user2->setRole($manager->merge($this->getReference('role-2')));
        $manager->persist($user2);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    function getOrder()
    {
        return 2;
    }
}