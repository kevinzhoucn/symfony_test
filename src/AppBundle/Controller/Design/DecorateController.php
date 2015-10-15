<?php

namespace AppBundle\Controller\Design;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Utility\Design\DecorateTest;

class DecorateController extends Controller
{
  public function indexAction()
  {
    $decorate = new DecorateTest();
    $log = "Decorate: ";
    $log .= $decorate->getWealthFactor();
    return $this->render('design/index.html.twig', array( 'log' => $log ));
  }
}

