<?php

namespace App\Controller;

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

class ConteneurController extends AbstractController
{

    #[Serializer]
    private $serializer;

    public function __construct(EntityManagerInterface $em)
    {
        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getNom();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
        $this->serializer = new Serializer([$normalizer], [$encoder]);
        $this->entityManager = $em;
    }

    #[Route('/api/conteneur', name: 'conteneur')]
    public function index(CallApiService $callApiService): Response
    {
        dd($callApiService->getToulouseData());

        return $this->render('base.html.twig', [
            'controller_name' => 'ConteneurController',
        ]);
    }
}