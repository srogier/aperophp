<?php

namespace Aperophp\Form\Participate;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Symfony\Component\Validator\Constraints;

/**
 *  Participate form for anonymous users.
 *
 *  @author Gautier DI FOLCO <gautier.difolco@gmail.com>
 *  @version 1.0 - 12 fev. 2012 - Gautier DI FOLCO <gautier.difolco@gmail.com>
 */
class CreateAnonymousType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder    ->add('drink', 'hidden')
                    ->add('lastname', 'text', array('label' => 'Nom', 'required' => false, 'attr' => array('placeholder' => 'Facultatif.')))
                    ->add('firstname', 'text', array('label' => 'Prénom', 'required' => false, 'attr' => array('placeholder' => 'Facultatif.')))
                    ->add('email', 'email')
                    ->add('percentage', 'text', array('label' => 'Poucentage de participation'))
                    ->add('reminder', 'checkbox', array('label' => 'Me rappeler l\'évènement', 'required' => false));
    }
    
    public function getDefaultOptions(array $options)
    {
        $collectionConstraint = new Constraints\Collection(array(
            'fields' => array(
                'drink'        => new Constraints\NotNull(),
                'lastname'     => new Constraints\MaxLength(array('limit' => 80)),
                'firstname'    => new Constraints\MaxLength(array('limit' => 80)),
                'email'        => array(
                    new Constraints\Email(),
                    new Constraints\NotNull(),
                ),
                'percentage'   => array(
                    new Constraints\Min(array('limit' => 0)),
                    new Constraints\Max(array('limit' => 100))
                )
            ),
            'allowExtraFields'  => false,
        ));
    
        return array('validation_constraint' => $collectionConstraint);
    }
    
    public function getName()
    {
        return 'participate_create_anonymous';
    }
}
