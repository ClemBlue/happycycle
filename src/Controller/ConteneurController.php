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

    /**
     * @Serializer
     */
    private $serializer;

    /**
     * @var ObjectManager
     */
    private $manager;

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

    #[Route('/api/conteneurs/{name}', name: 'conteneurs_ByCity')]
    public function getConteneursByCity(VillesRepository $villesRepository, string $name): JsonResponse
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
        return new JsonResponse($conteneurs);
        $content = $this->serializer->serialize($responseAPI, 'json', ['json_encode_options' => JSON_UNESCAPED_SLASHES]);
        $response = new Response();
        $response->setContent($content);
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
