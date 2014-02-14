<?php
namespace Piniu\UsersBundle\Controller;

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
}