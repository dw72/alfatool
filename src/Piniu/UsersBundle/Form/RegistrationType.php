<?php

namespace Piniu\UsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('user', new UserType(), array('label' => ''));
        $builder->add(
            'terms',
            'checkbox',
            array('property_path' => 'termsAccepted', 'label' => 'Akceptuję regulamin sklepu')
        );
    }

    public function getName()
    {
        return 'piniu_users_registration';
    }
}