<?php

namespace Piniu\ProductsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductsController extends Controller
{
    public function indexAction()
    {
        $products = $this->getDoctrine()->getManager()
                         ->getRepository('PiniuProductsBundle:Product')
                         ->getAllProducts();

        return $this->render('PiniuProductsBundle:Products:index.html.twig', array('products' => $products) );
    }

    public function showAction($id)
    {
        $product = $this->getDoctrine()->getManager()
                        ->getRepository('PiniuProductsBundle:Product')
                        ->getProductById($id);

        return $this->render('PiniuProductsBundle:Products:show.html.twig', array('product' => $product) );
    }
}
