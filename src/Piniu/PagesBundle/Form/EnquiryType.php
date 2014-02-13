<?php

namespace Piniu\PagesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EnquiryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array('label'  => 'Nazwa'));
        $builder->add('email', 'email');
        $builder->add('subject', 'text', array('label'  => 'Temat'));
        $builder->add('body', 'textarea', array('label'  => 'Treść'));
    }

    public function getName()
    {
        return 'piniu_pagesbundle_contact';
    }
}