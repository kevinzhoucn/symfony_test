<?php

namespace AppBundle\Controller\Design;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Utility\Design\CommsManager;

class FactoryController extends Controller
{
  public function indexAction()
  {
    $commManager = new CommsManager( CommsManager::BLOGGS );
    $appt = $commManager->getApptEncoder();
    $log = $appt->encode();
    return $this->render('design/factory/index.html.twig', array( 'log' => $log ));
  }
}

