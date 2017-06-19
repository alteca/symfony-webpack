<?php
/**
 * Created by PhpStorm.
 * User: tvandermeersch
 * Date: 19/06/2017
 * Time: 15:21
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use AppBundle\Manager\UserManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var UserManager
         */
        $userManager = $this->container->get(UserManager::class);

        $userAdmin = new User();
        $userAdmin
            ->setEmail('admin@example.com')
            ->setFirstname('admin')
            ->setLastname('user')
            ->setPassword('secure');
        $manager->persist($userManager->manageCredentials($userAdmin));

        $user = new User();
        $user
            ->setEmail('user@example.com')
            ->setFirstname('user')
            ->setLastname('user')
            ->setPassword('secure');
        $manager->persist($userManager->manageCredentials($user));

        $manager->flush();
    }
}