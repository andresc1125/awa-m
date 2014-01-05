<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\StoreBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
    
    /**
     * @Route("/create")
     */
    public function createAction()
	{
		$product = new Product();
		$product->setName('A Foo Bar');
		$product->setPrice('19.99');
		$product->setDescription('Lorem ipsum dolor');
		$em = $this->getDoctrine()->getManager();
		$em->persist($product);
		$em->flush();
		return new Response('Created product id '.$product->getId());
	}
	
	/**
     * @Route("/show/{id}")
     * @Template()
     */
	public function showAction($id)
	{
		$product = $this->getDoctrine()
			->getRepository('AcmeStoreBundle:Product')
			->find($id);
		if (!$product)
		{
			throw $this->createNotFoundException(
				'No product found for id '.$id
			);
		}		
		//$categoryName = $product->getCategory()->getName();
		
		//de esta forma se recuperan todos los productos que tengan dicha categoria
		// $category = $this->getDoctrine()
		//	->getRepository('AcmeStoreBundle:Category')
		//	->find($id);

		//$products = $category->getProducts();
		
		//uso de metodos declarados en la clase repositorio de product
		// $product = $this->getDoctrine()
		//	->getRepository('AcmeStoreBundle:Product')
		//	 ->findOneByIdJoinedToCategory($id);
		// $category = $product->getCategory();


		return array('product' => $product);
	}
	
	/*	public function showAction($id)
	{
		$product = $this->getDoctrine()
			->getRepository('AcmeStoreBundle:Product')
			->find($id);
		if (!$product)
		{
			throw $this->createNotFoundException(
				'No product found for id '.$id
			);
		}		
		//$categoryName = $product->getCategory()->getName();
		
		//de esta forma se recuperan todos los productos que tengan dicha categoria
		// $category = $this->getDoctrine()
		//	->getRepository('AcmeStoreBundle:Category')
		//	->find($id);

		//$products = $category->getProducts();
		
		//uso de metodos declarados en la clase repositorio de product
		// $product = $this->getDoctrine()
		//	->getRepository('AcmeStoreBundle:Product')
		//	 ->findOneByIdJoinedToCategory($id);
		// $category = $product->getCategory();


		return array('product' => $product);
	}*/
	
	/**
    * @Route("/update/{id}")
    * 
    */
	public function updateAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$product = $em->getRepository('AcmeStoreBundle:Product')->find($id);
		if (!$product) {
		throw $this->createNotFoundException(
		'No product found for id '.$id
		);
		}
		$product->setName('New product name!');
		$em->flush();
		return $this->redirect($this->generateUrl('homepage'));
	}


}
