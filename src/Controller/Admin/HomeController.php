<?php

namespace App\Controller\Admin;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index(
        ProductRepository $pr
    ): Response
    {
        $products = $pr->findAll();
        return $this->render('admin/home/index.html.twig',[
            'products' => $products
        ]);
    }
}
