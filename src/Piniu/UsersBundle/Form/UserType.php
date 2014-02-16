<?php
/**
 * Created by PhpStorm.
 * User: milley
 * Date: 14.02.14
 * Time: 16:11
 */

namespace Piniu\UsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text',
            array('label' => 'Użytkownik', 'attr' => array('autofocus' => 'autofocus')));
        $builder->add('firstname', 'text', array('label' => 'Imię', 'required' => false));
        $builder->add('lastname', 'text', array('label' => 'Nazwisko', 'required' => false));
        $builder->add('email', 'email');
        $builder->add('password', 'repeated', array(
            'type' => 'password',
            'first_name' => 'password',
            'second_name' => 'confirm',
            'first_options' => array('label' => 'Hasło'),
            'second_options' => array('label' => 'Powtórz hasło'),
            'invalid_message' => 'Hasła nie są takie same',
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piniu\UsersBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'piniu_users_user';
    }
}