<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    private $pr;
    public function __construct(
        ProductRepository $pr
    )
    {
        $this->pr = $pr;
    }
    /**
     * @Route("/product", name="app_product")
     */
    public function index(
        ProductRepository $pr,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $products = $pr->findAllProduct();
        $products_paginate = $paginator->paginate($products, $request->get('page',1), 12);
        return $this->render('product/index.html.twig', [
            'products' => $products_paginate
        ]);
    }

    /**
     * @Route("/product/show/{id}", name="app_product_show")
     */
    public function show(
        $id
    ){
        $product = $this->pr->findOneBy(['id' => $id]);
        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}
