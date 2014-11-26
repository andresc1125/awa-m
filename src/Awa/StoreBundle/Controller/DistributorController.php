<?php

namespace Awa\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

use Awa\BussinessBundle\Entity\Distributor;
use Awa\BussinessBundle\Form\DistributorUserType;
use Awa\BussinessBundle\Entity\AAplication;
use Awa\BussinessBundle\Form\AAplicationDistributorType;


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
    public function myAppsAction()
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

    /**
     * Displays a form to create a new AAplication entity.
     *
     * @Route("/new_app", name="distributor_aplication_new")
     * @Method("GET")
     * @Template()
     */
    public function newAppAction()
    {
        $entity = new AAplication();
        $form   = $this->createForm(new AAplicationDistributorType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new AAplication entity.
     *
     * @Route("/", name="distributor_aplication_create")
     * @Method("POST")
     * @Template("AwaBussinessBundle:AAplication:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new AAplication();
        $form = $this->createForm(new AAplicationDistributorType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $entity->setAuthorized(0);
            $em->flush();

            return $this->redirect($this->generateUrl('distributor_aplication_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    
    /**
     * Finds and displays a AAplication entity.
     *
     * @Route("/showApp/{id}", name="distributor_aplication_show")
     * @Method("GET")
     * @Template()
     */
    public function showAppAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:AAplication')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aplication entity.');
        }

//         $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
//             'delete_form' => $deleteForm->createView(), 
        );
    }
}
