<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use SebastianBergmann\Environment\Console;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/admin/product/new", name="admin_product_new")
     */
    public function index(
        Request $request,
        ProductRepository $pr
    )
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $pr->add($product, 1);
            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/product/new.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/product/show/{id}", name="admin_product_show")
     */
    public function show(
        $id,
        ProductRepository $pr
    ){
        $product = $pr->findOneBy(['id' =>$id]);
        return $this->render('admin/product/show.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/admin/product/edit/{id}", name="admin_product_edit")
     */
    public function edit(
        $id,
        ProductRepository $pr,
        EntityManagerInterface $em,
        Request $request
    ){
        $product = $pr->findOneBy(['id' => $id]);
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            return $this->redirectToRoute('admin_home');
        }
        
        return $this->render('admin/product/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     *  @Route("/admin/product/delete/{id}" , name="admin_product_delete")
     */
    public function delete(
        $id,
        ProductRepository $pr,
        Request $request
    ){
        $token = $request->get('_token');
        if($this->isCsrfTokenValid('delete-product-'.$id, $token)){
            $pr->remove($pr->findOneBy(['id' => $id]), true);
        }
        return $this->redirectToRoute('admin_home');
    }
}
