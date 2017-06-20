<?php

namespace AdminBundle\Controller;

use AdminBundle\Datatables\UserDatatable;
use AppBundle\Controller\BaseController;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sg\DatatablesBundle\Datatable\DatatableInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
    public function indexAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();
//        $users = $this->get(UserManager::class)->findAll();

        /** @var DatatableInterface $datatable */
        $datatable = $this->get('sg_datatables.factory')->create(UserDatatable::class);
        $datatable->buildDatatable();


        if ($isAjax) {
            $responseService = $this->get('sg_datatables.response');
            $responseService->setDatatable($datatable);

            $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();
            $datatableQueryBuilder->buildQuery();

//            dump($datatableQueryBuilder->getQb()->getDQL()); die();

            return $responseService->getResponse();
        }

        return $this->render('AdminBundle:Default:index.html.twig', [
            'datatable' => $datatable,
        ]);
    }

    /**
     * Finds and displays a User entity.
     *
     * @param User $post
     *
     * @Route("/edit/{id}", name = "user_edit", options = {"expose" = true})
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     *
     * @return Response
     */
    public function editAction()
    {
        $user = null;

        return $this->render('@Admin/user/edit.html.twig', array(
            'user' => $user
        ));
    }
}
