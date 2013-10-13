<?php

namespace Awa\TryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AwaTryBundle:Default:index.html.twig', array('name' => $name));
    }
}
