<?php

namespace Awa\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/store")
 * 
 */
class StoreController extends Controller
{

     /**
     * Lists all AAplication entities.
     *
     * @Route("/", name="store")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AwaBussinessBundle:AAplication')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Lists all AAplication entities.
     *
     * @Route("/app/{id}", name="store_show_app")
     * @Method("GET")
     * @Template()
     */
    public function showAppsAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:AAplication')->find($id);

        return array(
            'entity' => $entity,
        );
    }

    /**
     * Lists all AAplication entities.
     *
     * @Route("/user", name="store_show_user")
     * @Method("GET")
     * @Template()
     */
    public function showUserAction()
    {
        return $this->redirect($this->generateUrl('user_show'));
    }

}
