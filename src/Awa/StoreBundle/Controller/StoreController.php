<?php

namespace Awa\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

use Awa\BussinessBundle\Entity\ReferedAplicationRepository;
use Awa\BussinessBundle\Entity\BussinessCategory;
use Awa\BussinessBundle\Entity\Distributor;
use Awa\BussinessBundle\Form\DistributorUserType;

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
        $plan_gold = $em->getRepository('AwaBussinessBundle:BussinessCategory')->findOneBy(array('name'=>"Gold"));
        $refered = new ReferedAplicationRepository($em);
        
        $entities = $refered->findAppsReferedBy($plan_gold);
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
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:AAplication')->find($id);
        $entity->setAmountVisits($entity->getAmountVisits() + 1);
        $em->flush($entity);

        return array(
            'entity' => $entity,
            'user' =>$user,
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
      $user = $this->get('security.context')->getToken()->getUser();
      return $this->render('AwaStoreBundle:Store:showUser.html.twig',array('user'=>$user));
    }

}
