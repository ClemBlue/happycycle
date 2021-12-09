<?php

namespace App\Controller;

use App\Entity\Villes;
use App\Repository\VillesRepository;
use App\Entity\Conteneur;
use App\Service\CallApiService;
use App\Repository\ConteneurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;

class ConteneurController extends AbstractController
{


    #[Route('/api/conteneurs/{name}', name: 'conteneurs_ByCity')]
    public function getConteneursByCity(VillesRepository $villesRepository, string $name)
    {
        $repo = $villesRepository->findOneBy(['name' => $name])->getConteneurs();
        $conteneurs = array();
        foreach ($repo as $data) {
            $conteneurs[] = array(
                'id' => $data->getId(),
                'lat' => $data->getLat(),
                'lon' => $data->getLon(),
                'ville' => $name
            );
        }
        
    }
}