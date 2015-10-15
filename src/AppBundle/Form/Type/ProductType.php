<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', 'text')
      ->add('price', 'text')
      ->add('description', 'text')
      ->add('save', 'submit', array('label' => 'Create Task'))
      ->add('saveAndAdd', 'submit', array('label' => 'Save and Add Task'))
    ;
  }

  public function getName()
  {
    return 'product';
  }
}