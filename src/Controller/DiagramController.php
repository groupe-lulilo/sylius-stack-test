<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DiagramController extends AbstractController
{
    #[Route('/admin/diagram', name: 'app_diagram')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();
        
        return $this->render('diagram/index.html.twig', [
            'controller_name' => 'DiagramController',
            'products' => $products,
        ]);
    }
}
