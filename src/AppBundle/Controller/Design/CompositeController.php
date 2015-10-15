<?php

namespace AppBundle\Controller\Design;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Utility\Design\CompositeTest;

class CompositeController extends Controller
{
  public function indexAction()
  {
    $composite = new CompositeTest();
    $log = $composite->getBombardStrength();
    return $this->render('design/composite/index.html.twig', array( 'log' => $log ));
  }
}

