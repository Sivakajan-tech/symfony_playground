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
        $form = $this->createForm(ProductType::class, $product);
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
}
