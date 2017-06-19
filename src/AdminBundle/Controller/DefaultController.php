<?php

namespace AdminBundle\Controller;

use AppBundle\Controller\BaseController;
use AppBundle\Datatables\UserDatatable;
use AppBundle\Manager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sg\DatatablesBundle\Datatable\DatatableInterface;
use Symfony\Component\HttpFoundation\Request;

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

            //dump($datatableQueryBuilder->getQb()->getDQL()); die();

            return $responseService->getResponse();
        }

        return $this->render('AdminBundle:Default:index.html.twig', [
            'datatable' => $datatable,
        ]);
    }
}
