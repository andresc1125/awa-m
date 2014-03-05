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
}