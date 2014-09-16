<?php

namespace Awa\BussinessBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Awa\BussinessBundle\Entity\ReferedAplication;
use Awa\BussinessBundle\Form\ReferedAplicationType;

/**
 * ReferedAplication controller.
 *
 * @Route("/referedaplication")
 */
class ReferedAplicationController extends Controller
{

    /**
     * Lists all ReferedAplication entities.
     *
     * @Route("/", name="referedaplication")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AwaBussinessBundle:ReferedAplication')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ReferedAplication entity.
     *
     * @Route("/", name="referedaplication_create")
     * @Method("POST")
     * @Template("AwaBussinessBundle:ReferedAplication:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new ReferedAplication();
        $form = $this->createForm(new ReferedAplicationType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('referedaplication_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new ReferedAplication entity.
     *
     * @Route("/new", name="referedaplication_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ReferedAplication();
        $form   = $this->createForm(new ReferedAplicationType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ReferedAplication entity.
     *
     * @Route("/{id}", name="referedaplication_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:ReferedAplication')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ReferedAplication entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ReferedAplication entity.
     *
     * @Route("/{id}/edit", name="referedaplication_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:ReferedAplication')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ReferedAplication entity.');
        }

        $editForm = $this->createForm(new ReferedAplicationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ReferedAplication entity.
     *
     * @Route("/{id}", name="referedaplication_update")
     * @Method("PUT")
     * @Template("AwaBussinessBundle:ReferedAplication:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:ReferedAplication')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ReferedAplication entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ReferedAplicationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('referedaplication_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ReferedAplication entity.
     *
     * @Route("/{id}", name="referedaplication_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AwaBussinessBundle:ReferedAplication')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ReferedAplication entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('referedaplication'));
    }

    /**
     * Creates a form to delete a ReferedAplication entity by id.
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
