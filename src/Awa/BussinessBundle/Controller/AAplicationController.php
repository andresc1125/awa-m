<?php

namespace Awa\BussinessBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Awa\BussinessBundle\Entity\AAplication;
use Awa\BussinessBundle\Form\AAplicationType;

use Awa\BussinessBundle\Form\Filter\AwaAplicationFilterType;

/**
 * AAplication controller.
 *
 * @Route("/aplication")
 */
class AAplicationController extends Controller
{

    /**
     * Lists all AAplication entities.
     *
     * @Route("/", name="aplication")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AwaBussinessBundle:AAplication')->findAll();

        $form = $this->get('form.factory')->create(new AwaAplicationFilterType());
        if ($this->get('request')->query->has('submit-filter')) {
            // bind values from the request
            $form->bind($this->get('request'));

            // initialize a query builder
            $filterBuilder = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AwaBussinessBundle:AAplication')
                ->createQueryBuilder('e');

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

            $resultQuery = $filterBuilder->getQuery();
            $fiteredEntities = $resultQuery->getArrayResult();

            return array('entities' => $fiteredEntities);
        }

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Displays a form to filter  existing Cars entity.
     *
     * @Route("/filter/", name="aplication_filter")
     * 
     *
     */
    public function baseFilterAction()
    {
        $form = $this->get('form.factory')->create(new AwaAplicationFilterType());
        
        if ($this->get('request')->query->has('submit-filter')) {
            // bind values from the request
            $form->bind($this->get('request'));

            // initialize a query builder
            $filterBuilder = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AwaBussinessBundle:AAplication')
                ->createQueryBuilder('e');

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

            $resultQuery = $filterBuilder->getQuery();
            $fiteredEntities = $resultQuery->getArrayResult();
            return $this->render('AwaBussinessBundle:AAplication:showFilterResults.html.twig', array(
              'entities' => $fiteredEntities,
              ));
        }
        
        return $this->render('AwaBussinessBundle:AAplication:baseFilter.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * Creates a new AAplication entity.
     *
     * @Route("/", name="aplication_create")
     * @Method("POST")
     * @Template("AwaBussinessBundle:AAplication:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new AAplication();
        $form = $this->createForm(new AAplicationType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('aplication_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new AAplication entity.
     *
     * @Route("/new", name="aplication_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AAplication();
        $form   = $this->createForm(new AAplicationType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AAplication entity.
     *
     * @Route("/{id}", name="aplication_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:AAplication')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AAplication entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AAplication entity.
     *
     * @Route("/{id}/edit", name="aplication_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:AAplication')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AAplication entity.');
        }

        $editForm = $this->createForm(new AAplicationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing AAplication entity.
     *
     * @Route("/{id}", name="aplication_update")
     * @Method("PUT")
     * @Template("AwaBussinessBundle:AAplication:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AwaBussinessBundle:AAplication')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AAplication entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AAplicationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('aplication_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AAplication entity.
     *
     * @Route("/{id}", name="aplication_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AwaBussinessBundle:AAplication')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AAplication entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('aplication'));
    }

    /**
     * Creates a form to delete a AAplication entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}