<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends Controller
{

    /**
     * @return User
     */
    protected function getUser(): User {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    public function render($view, array $parameters = array(), Response $response = null)
    {
        // add user has parameter
        /** @var User $user */
        $user = $this->getUser();
        $parameters['user'] = $user;

        return parent::render($view, $parameters, $response);
    }

}