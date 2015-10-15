<?php

// src/Controller/FrontController.php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FrontController extends Controller
{
  public function indexAction()
  {
    return $this->render('front/index.html.twig');
  }

  public function createAction()
  {
    $product = new Product();
    $product->setName('Jane');
    $product->setPrice('19.99');
    $product->setDescription('New book coming...');

    $em = $this->getDoctrine()->getManager();
    $em->persist($product);
    $em->flush();

    return new Response('Create product Id: ' . $product->getId());
  }

  public function showAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $product = $em->getRepository('AppBundle:Product')
      ->find($id);

    if(!$product) {
      throw $this->createNotFoundException('Product id not found! Id: ' . $id);
    }

    return $this->render('front/product/show.html.twig', array('product' => $product));
  }

  public function productsAction()  
  {
    $products = $this->getDoctrine()
      ->getRepository('AppBundle:Product')
      ->findAll();

    return $this->render('front/product/index.html.twig', array('products' => $products));
  }
}

