<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DiagramController extends AbstractController
{
    #[Route('/admin/diagram', name: 'app_diagram')]
    public function index(): Response
    {
        return $this->render('diagram/index.html.twig', [
            'controller_name' => 'DiagramController',
            'title' => 'coucou',
        ]);
    }
}
