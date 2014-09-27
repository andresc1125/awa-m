<?php

namespace Awa\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

use Awa\BussinessBundle\Entity\Distributor;
use Awa\BussinessBundle\Form\DistributorUserType;


/**
 * AAplication controller.
 *
 * @Route("/distributor")
 */
class DistributorController extends Controller
{
    /**
     * @Route("/myapps", name="myapps")
     * @Template()
     */
    public function myAppsAction($name)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();
        $distributor = $user->getDistributor();
        $apps = $distributor->getAplications();

        return array(
            'entities'      => $apps,
        );
    }
    
    /**
     * Shows the user's dristributor
     *
     * @Route("/", name="distributor_user")
     * @Method("GET")
     * @Template()
     */
    public function distributorUserAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();

        if($user->getDistributor() != null){
            $text = $this->get('translator')->trans('Usted ya tiene un distribuidor registrado');
            return array('distributor' => $user->getDistributor());
        }else
        {
          return $this->redirect($this->generateUrl('ask_for_distributor'));
        }
    }
    
      /**
     * Lists all AAplication entities.
     *
     * @Route("/distributor_user", name="distributor_user_create")
     * @Method("POST")
     * @Template()
     */
    public function distributorUserCreateAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        if($user->getDistributor() != null){
            $text = $this->get('translator')->trans('Usted ya tiene un distribuidor registrado');
            return array('distributor' => $user->getDistributor());
        }

        $entity  = new Distributor();
        $form = $this->createForm(new DistributorUserType(), $entity);
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $user->setDistributor($entity);
            $entity->setAuthorized(false);
            $em->flush();
            return $this->redirect($this->generateUrl('distributor_user'));
        }
        
        return $this->redirect($this->generateUrl('ask_distributor'));
    }
    
        /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/ask_for_distributor", name="ask_for_distributor")
     * @Method("GET")
     * @Template()
     */
    public function askDistributorAction(){
        $entity = new Distributor();
        $form   = $this->createForm(new DistributorUserType(), $entity);
        
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
}
