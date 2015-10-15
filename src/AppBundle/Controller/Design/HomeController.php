<?php

namespace AppBundle\Controller\Design;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Utility\Design\DesignFactory;
use AppBundle\Utility\Check\CheckString;

class HomeController extends Controller
{
  public function indexAction( $name )
  {
    $log = "log:";

    $test = DesignFactory::getInstance($name);
    $log = $test->runTest();
    return $this->render('design/index.html.twig', array( 'log' => CheckString::check( $log ) ) );
  }
}
