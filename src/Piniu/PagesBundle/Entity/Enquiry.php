<?php

namespace Piniu\PagesBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class Enquiry
{
    protected $name;

    protected $email;

    protected $subject;

    protected $body;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());

        $metadata->addPropertyConstraint('email', new Email(array(
            'message' => 'Podaj istniejący adres email')));

        $metadata->addPropertyConstraint('subject', new NotBlank(array(
            'message' => 'Temat nie może być pusty')));
        $metadata->addPropertyConstraint('subject', new Length(array('max' => 50)));

        $metadata->addPropertyConstraint('body', new Length(array('min' => 50)));
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }
}