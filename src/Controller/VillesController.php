<?php

namespace App\Controller;

use App\Entity\Villes;
use App\Repository\VillesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class VillesController extends AbstractController
{
    #[Route('/api/villes', name: 'villes')]
    public function getVilles(VillesRepository $villesRepository): JsonResponse
    {
        $repo = $villesRepository->findAll();
        $villes = array();
        foreach ($repo as $data) {
            $villes[] = $data->getName();
        }

        return new JsonResponse($villes);
    }
}
