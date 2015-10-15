<?php

// src/Controller/FrontController.php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
// use AppBundle\Utility\Category;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionResolver\OptionResolver;
// use AppBundle\Form\Type\ProductType;

use AppBundle\Utility\ProcessSale;

class ProductController extends Controller
{
  public function indexAction()  
  {
    $products = $this->getDoctrine()
      ->getRepository('AppBundle:Product')
      ->findAll();

    return $this->render('product/index.html.twig', array('products' => $products));
  }

  public function createAction(Request $request)
  {
    $product = new Product();
    // $product->setName('Jane');
    // $product->setPrice('19.99');
    // $product->setDescription('New book coming...');

    // $form = $this->createFormBuilder($product)//, array('validation_groups' => false))//, array('validation_groups' => array('registration')))
    //   ->add('name', 'text')
    //   ->add('price', 'text')
    //   ->add('description', 'text')
    //   ->add('save', 'submit', array('label' => 'Create Task'))
    //   ->add('saveAndAdd', 'submit', array('label' => 'Save and Add Task'))
    //   ->getForm();

    // $form = $this->createForm(new ProductType(), $product);
    $form = $this->createForm('product', $product);

    $form->handleRequest($request);

    if($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($product);
      $em->flush();

      $nextAction = $form->get('saveAndAdd')->isClicked()
        ? 'product_create'
        : 'products';

      return $this->redirectToRoute($nextAction);
    }

    return $this->render('product/new.html.twig', array('form' => $form->createView()));
    // return new Response('Create product Id: ' . $product->getId());
  }

  public function showAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $product = $em->getRepository('AppBundle:Product')
      ->find($id);

    if(!$product) {
      throw $this->createNotFoundException('Product id not found! Id: ' . $id);
    }

    return $this->render('product/show.html.twig', array('product' => $product));
  }

  public function saleAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $product = $em->getRepository('AppBundle:Product')
      ->find($id);

    // $logger = function( $product ) {
    //   return " logging { $product->getName() } \n";
    // };

    $processor = new ProcessSale();
    $processor->registerCallback( array( new Mailer(), "doMail") );
    $log = $processor->sale( $product );
    // $log = "123";

    // $log = $processor->details( $product );

    // $content = new Category("content");
    // $log = $content->getContent();

    // $logger = create_function('$product', 'ehco "logging {{ $product->name }} \n"; ');

    return $this->render('product/sale.html.twig', array('log' => $log));
  }

  public function configureOptions(OptionResolver $resolver)
  {
    // $resolver->setDefaults(array(
    //   'validation_groups' => array('registration'),
    // ));

    $resolver->setDefaults(array(
      'validation_groups' => false,
    ));
  }
}

class Mailer {
  function doMail( $product ) {
    return " mailing ({$product->getName()})";
  }
}

