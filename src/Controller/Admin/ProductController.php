<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/admin/product/new", name="admin_product_new")
     */
    public function new(
        Request $request
    )
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->pr->add($product, 1);
            $this->addFlash('success', 'Produit ajoutée avec succées');
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
        $id
    ){
        $product = $this->pr->find($id);
        return $this->render('admin/product/show.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/admin/product/edit/{id}", name="admin_product_edit")
     */
    public function edit(
        $id,
        EntityManagerInterface $em,
        Request $request
    ){
        $product = $this->pr->find($id);
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $this->addFlash('success', 'Produit editer avec succées');
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
        Request $request
    ){
        $token = $request->get('_token');
        if($this->isCsrfTokenValid('delete-product-'.$id, $token)){
            $this->pr->remove($this->pr->find($id), true);
        }
        $this->addFlash('success', 'Produit supprimer avec succées');
        return $this->redirectToRoute('admin_home');
    }
}
