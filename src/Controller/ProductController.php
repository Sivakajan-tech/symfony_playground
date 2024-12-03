<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'product')]
    public function index(ProductRepository $productRepo): Response
    {
        $products = $productRepo->findAll();
        // dump($products);

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $products,
        ]);
    }

    #[Route('/product/{id<\d+>}', name: 'product_show')]
    public function show($id, ProductRepository $productRepo): Response
    {
        $product = $productRepo->find($id);
        // dump($product);

        if (!$product) {
            throw $this->createNotFoundException('The product does not exist');
        }

        return $this->render('product/show_product.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $product,
            'id' => $id,
        ]);
    }

    #[Route('/product/new', name: 'product_new')]
    public function new(Request $request, EntityManagerInterface $emi): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product, [
            'submit_label' => 'Create Product',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emi->persist($product);
            $emi->flush();

            $this->addFlash('notice', 'Product created successfully!');

            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
            // dd($product);
        }

        return $this->render('product/new_product.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/product/{id<\d+>}/edit', name: 'product_edit')]
    public function edit($id, Request $request, EntityManagerInterface $emi): Response
    {
        $product = $emi->getRepository(Product::class)->find($id);
        $form = $this->createForm(ProductType::class, $product, [
            'submit_label' => 'Edit Product',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emi->flush();

            $this->addFlash('notice', 'Product updated successfully!');

            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }

        return $this->render('product/edit_product.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/product/{id<\d+>}/delete', name: 'product_delete')]
    public function delete($id, Request $request, EntityManagerInterface $emi): Response
    {
        if ($request->isMethod('POST')) {
            $product = $emi->getRepository(Product::class)->find($id);
            $emi->remove($product);
            $emi->flush();

            $this->addFlash('notice', 'Product deleted successfully!');

            return $this->redirectToRoute('product');
        }
        // dump($product);

        return $this->render('product/delete_product.html.twig', [
            'id' => $id,
        ]);
    }
}
