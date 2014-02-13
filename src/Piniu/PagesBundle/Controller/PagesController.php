<?php

namespace Piniu\PagesBundle\Controller;

use Piniu\PagesBundle\Entity\Enquiry;
use Piniu\PagesBundle\Form\EnquiryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PagesController extends Controller
{
    public function aboutAction()
    {
        return $this->render('PiniuPagesBundle:Pages:about.html.twig');
    }

    public function regulationsAction()
    {
        return $this->render('PiniuPagesBundle:Pages:regulations.html.twig');
    }

    public function contactAction(Request $request)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {

                $message = \Swift_Message::newInstance()
                    ->setSubject('Zapytanie ze sklepu AlfaTool')
                    ->setFrom('kontakt@alfatool.pl')
                    ->setTo($this->container->getParameter('piniu_pages.emails.contact_email'))
                    ->setBody($this->renderView('PiniuPagesBundle:Pages:contactEmail.txt.twig',
                        array('enquiry' => $enquiry)));
                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add('contact-notice', 'Twoja wiadomość została wysłana. Dziękujemy!');

                return $this->redirect($this->generateUrl('piniu_pages_contact'));
            }
        }

        return $this->render('PiniuPagesBundle:Pages:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
