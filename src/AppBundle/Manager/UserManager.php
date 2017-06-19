<?php

namespace AppBundle\Manager;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class UserManager extends BaseManager
{
    /**
     * @var UserPasswordEncoder
     */
    private $encoder;

    /**
     * @param UserPasswordEncoder $encoder
     */
    public function __construct(EntityManagerInterface $em, string $repository, UserPasswordEncoder $encoder)
    {
        parent::__construct($em, $repository);
        $this->encoder = $encoder;
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function manageCredentials(User $user)
    {
        $encodedPassword = $this->encoder->encodePassword($user, $user->getPassword());
        $user->setPassword($encodedPassword);

        return $user;
    }
}