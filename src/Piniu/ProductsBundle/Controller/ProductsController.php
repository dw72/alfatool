<?php

namespace Piniu\ProductsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductsController extends Controller
{
    protected function getRepository($repositoryName = 'Product')
    {
        return $this->getDoctrine()->getManager()->getRepository('PiniuProductsBundle:'.$repositoryName);
    }

    public function listAction()
    {
        $products = $this->getRepository()->findAll();

        return $this->render('PiniuProductsBundle:Products:list.html.twig', array('products' => $products));
    }

    public function showAction($id)
    {
        $product = $this->getRepository()->findOneById($id);

        return $this->render('PiniuProductsBundle:Products:show.html.twig', array('product' => $product));
    }

    public function showByCategoryAction($categoryId)
    {
        $products = $this->getRepository()->findByCategory($categoryId);
        $category = $this->getRepository('Category')->find($categoryId);

        return $this->render('PiniuProductsBundle:Products:list.html.twig',
            array('products' => $products, 'category' => $category));
    }
}
