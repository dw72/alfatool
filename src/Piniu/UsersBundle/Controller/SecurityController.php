<?php
namespace Piniu\UsersBundle\Controller;

use Piniu\UsersBundle\Form\Model\Registration;
use Piniu\UsersBundle\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        if (isset($error)) {
            $session->getFlashBag()->add('login-error', 'Błędna nazwa użytkownika lub hasło!');
        }

        return $this->render('PiniuUsersBundle:Security:login.html.twig',
            array('username' => $session->get(SecurityContext::LAST_USERNAME)));
    }

    public function registerAction()
    {
        $registration = new Registration();
        $form = $this->createForm(new RegistrationType(), $registration);

        return $this->render(
            'PiniuUsersBundle:Security:register.html.twig',
            array('form' => $form->createView())
        );
    }

    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new RegistrationType(), new Registration());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $registration = $form->getData();
            $user = $registration->getUser();

            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);


            $user->setRole($em->getRepository('PiniuUsersBundle:Role')->findOneBy(array('role' => "ROLE_USER")));

            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('piniu_products_homepage'));
        }

        return $this->render('PiniuUsersBundle:Security:register.html.twig',
            array('form' => $form->createView())
        );
    }
}