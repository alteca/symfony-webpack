<?php

namespace AppBundle\Controller\Admin;
use AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/admin")
 * Class AdminController
 * @package AdminBundle\Controller
 */
class AdminController extends BaseController
{
    /**
     * @Route("/", name="admin_homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render("admin/admin.html.twig");
    }
}