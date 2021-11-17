<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgglomerationController extends AbstractController
{
    #[Route('/agglomeration', name: 'agglomeration')]
    public function index(): Response
    {
        return $this->render('agglomeration/index.html.twig', [
            'controller_name' => 'AgglomerationController',
        ]);
    }
}
