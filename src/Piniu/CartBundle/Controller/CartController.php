<?php

namespace Piniu\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
    public function showAction(Request $request)
    {
        // get the cart from  the session
        $session = $request->getSession();
        $cart = $session->get('cart', array());

        $ids = array_keys($cart);

        if (!empty($ids)) {
            $em = $this->getDoctrine()->getManager();
            $products = $em->getRepository('PiniuProductsBundle:Product')->findByIds($ids);
        }

        if (isset($products)) {
            return $this->render('PiniuCartBundle:Cart:show.html.twig',
                array('products' => $products));
        } else {
            return $this->render('PiniuCartBundle:Cart:show.html.twig');
        }
    }

    public function addAction($id, Request $request)
    {
        // fetch the cart
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('PiniuProductsBundle:Product')->find($id);

        $session = $request->getSession();
        $cart = $session->get('cart', array());

        // check if the $id already exists in it.
        if (!isset($product)) {
            $this->get('session')->getFlashBag()->add('cart-error', 'Takiego produktu nie ma w naszym magazynie');
        } elseif (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);

        return $this->redirect($this->generateUrl('piniu_cart_show'));
    }

    public function removeAction($id, Request $request)
    {
        // check the cart
        $session = $request->getSession();
        $cart = $session->get('cart', array());

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->get('session')->getFlashBag()->add('cart-notice', 'Produkt został uzunięty z koszyka');
        } else {
            $this->get('session')->getFlashBag()->add('cart-error', 'Nie można usunąć produktu, którego nie ma w koszyku');
        }

        $session->set('cart', $cart);

        return $this->redirect($this->generateUrl('piniu_cart_show'));
    }
}
