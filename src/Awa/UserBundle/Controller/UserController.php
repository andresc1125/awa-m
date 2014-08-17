<?php

namespace Awa\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Awa\UserBundle\Entity\User;
use Awa\UserBundle\Entity\Role;
use Awa\UserBundle\Form\UserType;
use Awa\UserBundle\Form\UserEditType;
use Awa\UserBundle\Form\UserRegistrationType;
use Awa\BussinessBundle\Form\DistributorUserType;
use Awa\BussinessBundle\Entity\Distributor;
/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     * @Route("/", name="user")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AwaUserBundle:User')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new User entity.
     *
     * @Route("/", name="user_create")
     * @Method("POST")
     * @Template("AwaUserBundle:User:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity  = new User();
        $user = $this->getUser();
        if($user != null){
            $roles = $user->getRoles();
            $adminRole = null;
            foreach ($roles as $role) {
                if($role->getName() == 'ROLE_ADMIN' || $role->getName() == 'ROLE_SUPER_ADMIN'){
                    $adminRole = $role;
                }
            }
            if($adminRole != null){
                $form   = $this->createForm(new UserType(), $entity);
            }else{
                $role = $em->getRepository('AwaUserBundle:Role')->findOneBy(array('name'=>'ROLE_USER'));
                $entity->addRole($role);
                $form   = $this->createForm(new UserRegistrationType(), $entity);
            }
        }else{
            $role = $em->getRepository('AwaUserBundle:Role')->findOneBy(array('name'=>'ROLE_USER'));
            $entity->addRole($role);
            $form   = $this->createForm(new UserRegistrationType(), $entity);
        }
        $form->bind($request);

        if ($form->isValid()) {
            $this->setSecurePassword($entity);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new User entity.
     *
     * @Route("/new", name="user_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new User();
        $user = $this->getUser();
        if($user != null){
            $roles = $user->getRoles();
            $adminRole = null;
            foreach ($roles as $role) {
                if($role->getName() == 'ROLE_ADMIN' || $role->getName() == 'ROLE_SUPER_ADMIN'){
                    $adminRole = $role;
                }
            }
            if($adminRole != null){
                $form   = $this->createForm(new UserType(), $entity);
            }else{
                $form   = $this->createForm(new UserRegistrationType(), $entity);
            }
        }else{
            $form   = $this->createForm(new UserRegistrationType(), $entity);
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a User entity.
     *
     * @Route("/show", name="user_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->get('security.context')->getToken()->getUser();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        //$deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
           // 'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/edit", name="user_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->get('security.context')->getToken()->getUser();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createForm(new UserEditType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());
        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing User entity.
     *
     * @Route("/", name="user_update")
     * @Method("PUT")
     * @Template("AwaUserBundle:User:edit.html.twig")
     */
    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->get('security.context')->getToken()->getUser();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($entity->getId());
        $editForm = $this->createForm(new UserEditType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $this->setSecurePassword($entity);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_edit'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a User entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AwaUserBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user'));
    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Creates a new Distributor entity.
     *
     * @Route("/destributor/new", name="distributor_user_create")
     * @Method("POST")
     * @Template("")
     */
    public function createDistributorAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $entity  = new Distributor();
        $form = $this->createForm(new DistributorUserType(), $entity);
        $form->bind($request);

        if($user->getDistributor() != null){
            $text = "Usted ya tiene un distribuidor registrado";
            return $this->redirect($this->generateUrl('error_alert', array('text' => $text)));
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $user->setDistributor($entity);
            $entity->setAuthorized(false);
            $em->flush();
            $text = "Su solicitud se ha realizado satisfactoriamente";
            return $this->redirect($this->generateUrl('succesfull_alert', array('text' => $text)));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/distributor", name="ask_distributor")
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
     * Displays a form to edit an existing User entity.
     *
     * @Route("/succesfull/{text}", name="succesfull_alert")
     * @Method("GET")
     * @Template()
     */
    public function alertSuccesfullAction($text){
        

        return array(
            'text' => $text,
        );
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/error/{text}", name="error_alert")
     * @Method("GET")
     * @Template()
     */
    public function alertErrorAction($text){
        

        return array(
            'text' => $text,
        );
    }

    private function setSecurePassword(&$entity) {
        $entity->setSalt(md5(time()));
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha1', false, 1);
        $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
        $entity->setPassword($password);
    }
}

//$user = $this->get('security.context')->getToken()->getUser();