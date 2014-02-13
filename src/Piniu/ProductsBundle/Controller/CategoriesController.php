<?php

namespace Piniu\ProductsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    public function listAction()
    {
        $categories = $this->getDoctrine()->getManager()
            ->getRepository('PiniuProductsBundle:Category')
            ->findAll();

        return $this->render('PiniuProductsBundle:Categories:list.html.twig', array('categories' => $categories) );
    }
}
