<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\User;

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /**
         * @var \AppBundle\Entity\User
         */
        $user = $this->getUser();
        if (in_array('ROLE_ADMIN', $user->getRoles()))
        {
            return $this->redirectToRoute('admin_homepage');
        }

        return $this->redirectToRoute('welcome');
    }

    /**
     * @Route("/welcome", name="welcome")
     */
    public function welcomeAction()
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
