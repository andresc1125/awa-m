<?php

namespace Awa\BussinessBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Awa\BussinessBundle\Entity\BussinessCategory;
use Awa\BussinessBundle\Form\BussinessCategoryType;

/**
 * BussinessCategory controller.
 *
 * @Route("/bussinesscategory")
 */
class BussinessCategoryController extends Controller
{

    /**
     * Lists all BussinessCategory entities.
     *
     * @Route("/", name="bussinesscategory")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AwaBussinessBundle:BussinessCategory')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new BussinessCategory entity.
     *
     * @Route("/", name="bussinesscategory_create")
     * @Method("POST")
     * @Template("AwaBussinessBundle:BussinessCategory:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new BussinessCategory();
        $form = $this->createForm(new BussinessCategoryType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bussinesscategory_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new BussinessCategory entity.
     *
     * @Route("/new", name="bussinesscategory_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new BussinessCategory();
        $form   = $this->createForm(new BussinessCategoryType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a BussinessCategory entity.
     *
     * @Route("/{id}", name="bussinesscategory_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:BussinessCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BussinessCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing BussinessCategory entity.
     *
     * @Route("/{id}/edit", name="bussinesscategory_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:BussinessCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BussinessCategory entity.');
        }

        $editForm = $this->createForm(new BussinessCategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing BussinessCategory entity.
     *
     * @Route("/{id}", name="bussinesscategory_update")
     * @Method("PUT")
     * @Template("AwaBussinessBundle:BussinessCategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:BussinessCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BussinessCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new BussinessCategoryType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bussinesscategory_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a BussinessCategory entity.
     *
     * @Route("/{id}", name="bussinesscategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AwaBussinessBundle:BussinessCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BussinessCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bussinesscategory'));
    }

    /**
     * Creates a form to delete a BussinessCategory entity by id.
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
}
