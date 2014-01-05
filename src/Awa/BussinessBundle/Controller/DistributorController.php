<?php

namespace Awa\BussinessBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Awa\BussinessBundle\Entity\Distributor;
use Awa\BussinessBundle\Form\DistributorType;

/**
 * Distributor controller.
 *
 * @Route("/distributor")
 */
class DistributorController extends Controller
{

    /**
     * Lists all Distributor entities.
     *
     * @Route("/", name="distributor")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AwaBussinessBundle:Distributor')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Distributor entity.
     *
     * @Route("/", name="distributor_create")
     * @Method("POST")
     * @Template("AwaBussinessBundle:Distributor:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Distributor();
        $form = $this->createForm(new DistributorType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('distributor_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Distributor entity.
     *
     * @Route("/new", name="distributor_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Distributor();
        $form   = $this->createForm(new DistributorType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Distributor entity.
     *
     * @Route("/{id}", name="distributor_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:Distributor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Distributor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Distributor entity.
     *
     * @Route("/{id}/edit", name="distributor_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:Distributor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Distributor entity.');
        }

        $editForm = $this->createForm(new DistributorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Distributor entity.
     *
     * @Route("/{id}", name="distributor_update")
     * @Method("PUT")
     * @Template("AwaBussinessBundle:Distributor:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:Distributor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Distributor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DistributorType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('distributor_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Distributor entity.
     *
     * @Route("/{id}", name="distributor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AwaBussinessBundle:Distributor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Distributor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('distributor'));
    }

    /**
     * Creates a form to delete a Distributor entity by id.
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
