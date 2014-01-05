<?php

namespace Awa\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Awa\AppBundle\Entity\AwaApp;
use Awa\AppBundle\Form\AwaAppType;

/**
 * AwaApp controller.
 *
 * @Route("/awaapp")
 */
class AwaAppController extends Controller
{

    /**
     * Lists all AwaApp entities.
     *
     * @Route("/", name="awaapp")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AwaAppBundle:AwaApp')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new AwaApp entity.
     *
     * @Route("/", name="awaapp_create")
     * @Method("POST")
     * @Template("AwaAppBundle:AwaApp:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new AwaApp();
        $form = $this->createForm(new AwaAppType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('awaapp_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new AwaApp entity.
     *
     * @Route("/new", name="awaapp_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AwaApp();
        $form   = $this->createForm(new AwaAppType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AwaApp entity.
     *
     * @Route("/{id}", name="awaapp_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaAppBundle:AwaApp')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AwaApp entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AwaApp entity.
     *
     * @Route("/{id}/edit", name="awaapp_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaAppBundle:AwaApp')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AwaApp entity.');
        }

        $editForm = $this->createForm(new AwaAppType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing AwaApp entity.
     *
     * @Route("/{id}", name="awaapp_update")
     * @Method("PUT")
     * @Template("AwaAppBundle:AwaApp:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaAppBundle:AwaApp')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AwaApp entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AwaAppType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('awaapp_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AwaApp entity.
     *
     * @Route("/{id}", name="awaapp_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AwaAppBundle:AwaApp')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AwaApp entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('awaapp'));
    }

    /**
     * Creates a form to delete a AwaApp entity by id.
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
