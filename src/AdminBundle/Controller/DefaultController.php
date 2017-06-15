<?php

namespace AdminBundle\Controller;

use AppBundle\Controller\BaseController;
use AppBundle\Manager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/admin")
 * Class DefaultController
 * @package AdminBundle\Controller
 */
class DefaultController extends BaseController
{
    /**
     * @Route("/", name="admin_homepage")
     */
    public function indexAction()
    {
        $users = $this->get(UserManager::class)->findAll();
        return $this->render('AdminBundle:Default:index.html.twig', [
            'users' => $users,
        ]);
    }
}
