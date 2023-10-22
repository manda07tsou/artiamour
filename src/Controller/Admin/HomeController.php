<?php

namespace App\Controller\Admin;

use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index(
        ProductRepository $pr,
        Request $request,
        PaginatorInterface $paginator
    ): Response
    {
        $products = $pr->findAllProduct();
        $products_paginate = $paginator->paginate($products, $request->get('page', 1), 10);
        return $this->render('admin/home/index.html.twig',[
            'products' => $products_paginate
        ]);
    }
}
