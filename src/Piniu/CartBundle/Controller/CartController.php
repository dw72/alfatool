<?php

namespace Piniu\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
    public function showAction(Request $request)
    {
        $session = $request->getSession();
        $cart = $session->get('cart', array());

        return $this->render('PiniuCartBundle:Cart:show.html.twig',
            array('cart' => $cart));
    }

    public function addAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('PiniuProductsBundle:Product')->find($id);

        $session = $request->getSession();
        $cart = $session->get('cart', array());

        // check if the $id already exists in it.
        if (!isset($product)) {
            $this->get('session')->getFlashBag()->add('cart-error', 'Takiego produktu nie ma w naszym magazynie');
        } elseif (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id]['id'] = $product->getId();
            $cart[$id]['name'] = $product->getName();
            $cart[$id]['price'] = $product->getPrice();
            $cart[$id]['quantity'] = 1;
        }

        $session->set('cart', $cart);

        return $this->redirect($this->generateUrl('piniu_cart_show'));
    }

    public function updateAction(Request $request)
    {
        $session = $request->getSession();
        $cart = $session->get('cart', array());

        if ($request->getMethod() == 'POST') {
            foreach ($cart as $product) {
                $quantity = $request->request->get('quantity-' . $product['id']);
                $cart[$product['id']]['quantity'] = $quantity;
            }
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
            $this->get('session')->getFlashBag()->add('cart-notice', 'Produkt został usunięty z koszyka');
        } else {
            $this->get('session')->getFlashBag()->add('cart-error', 'Nie można usunąć produktu, którego nie ma w koszyku');
        }

        $session->set('cart', $cart);

        return $this->redirect($this->generateUrl('piniu_cart_show'));
    }

    public function clearAction(Request $request)
    {
        $cart = array();
        $request->getSession()->set('cart', $cart);

        $this->get('session')->getFlashBag()->add('cart-notice', 'Wszystkie produkty zostały usunięte z koszyka');

        return $this->redirect($this->generateUrl('piniu_cart_show'));
    }
}
