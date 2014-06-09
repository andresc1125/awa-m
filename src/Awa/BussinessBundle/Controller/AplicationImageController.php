<?php

namespace Awa\BussinessBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Awa\BussinessBundle\Entity\AplicationImage;
use Awa\BussinessBundle\Form\AplicationImageType;

/**
 * AplicationImage controller.
 *
 * @Route("/aplication_image")
 */
class AplicationImageController extends Controller
{

    /**
     * Lists all AplicationImage entities.
     *
     * @Route("/", name="aplication_image")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AwaBussinessBundle:AplicationImage')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new AplicationImage entity.
     *
     * @Route("/", name="aplication_image_create")
     * @Method("POST")
     * @Template("AwaBussinessBundle:AplicationImage:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new AplicationImage();
        $form = $this->createForm(new AplicationImageType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->upload();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('aplication_image_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new AplicationImage entity.
     *
     * @Route("/new", name="aplication_image_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AplicationImage();
        $form   = $this->createForm(new AplicationImageType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AplicationImage entity.
     *
     * @Route("/{id}", name="aplication_image_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:AplicationImage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AplicationImage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AplicationImage entity.
     *
     * @Route("/{id}/edit", name="aplication_image_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:AplicationImage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AplicationImage entity.');
        }

        $editForm = $this->createForm(new AplicationImageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing AplicationImage entity.
     *
     * @Route("/{id}", name="aplication_image_update")
     * @Method("PUT")
     * @Template("AwaBussinessBundle:AplicationImage:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:AplicationImage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AplicationImage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AplicationImageType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('aplication_image_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AplicationImage entity.
     *
     * @Route("/{id}", name="aplication_image_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AwaBussinessBundle:AplicationImage')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AplicationImage entity.');
            }
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('aplication_image'));
    }

    /**
     * Creates a form to delete a AplicationImage entity by id.
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
