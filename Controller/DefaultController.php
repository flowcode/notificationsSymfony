<?php

namespace Flowcode\NotificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FlowcodeNotificationBundle:Default:index.html.twig', array('name' => $name));
    }
}
