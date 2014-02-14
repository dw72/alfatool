<?php

namespace Piniu\UsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('user', new UserType());
        $builder->add(
            'terms',
            'checkbox',
            array(
                'property_path' => 'termsAccepted',
                'label' => 'Akceptuję regulamin sklepu',
                'required' => true,
            )
        );
    }

    public function getName()
    {
        return 'piniu_users_registration';
    }
}