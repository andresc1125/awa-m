<?php

namespace Awa\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Awa\BussinessBundle\Entity\ReferedAplicationRepository;
use Awa\BussinessBundle\Entity\BussinessCategory;

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
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
//         $entities = $em->getRepository('AwaBussinessBundle:AAplication')->findAll();
        $plan = $em->getRepository('AwaBussinessBundle:BussinessCategory')->findOneBy(array('name'=>"Gold"));
        $refered = new ReferedAplicationRepository($em);
  
        
         $entities = $refered->findAppsReferedBy($plan);
//         $entities = $em->getRepository('AwaBussinessBundle:ReferedAplication')->findAppsReferedBy($plan);
        return array(
            'entities' => $entities,
            'user' => $user,
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
        $entity->setAmountVisits($entity->getAmountVisits()+1);
        $em->flush($entity);

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
        return $this->render('AwaStoreBundle:Store:showUser.html.twig');
    }

}
