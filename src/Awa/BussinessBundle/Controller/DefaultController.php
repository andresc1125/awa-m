<?php

namespace Awa\BussinessBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin_interface")
     * @Template()
     * 
     */
    public function indexAction()
    {
		$options = array();
        return array('name' => $options);
    }
}
