<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\ConteneurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(UserRepository $userRepository, ConteneurRepository $conteneurRepository): Response
    {
        $user = $userRepository->findAll();
        $nbUser = count($user);
        $conteneur = $conteneurRepository->findAll();
        $nbCont = count($conteneur);
        return $this->render('base.html.twig', ["nbUser" => $nbUser, "nbCont" => $nbCont]);
    }
    #[Route('/home', name: 'home')]
    public function home(UserRepository $userRepository, ConteneurRepository $conteneurRepository): Response
    {
        $user = $userRepository->findAll();
        $nbUser = count($user);
        $conteneur = $conteneurRepository->findAll();
        $nbCont = count($conteneur);
        return $this->render('base.html.twig', ["nbUser" => $nbUser, "nbCont" => $nbCont]);
    }
    #[Route('/qsn', name: 'qsn')]
    public function qsn(): Response
    {
        return $this->render('qsn.html.twig');
    }
    #[Route('/legal', name: 'legal')]
    public function legal(): Response
    {
        return $this->render('legal.html.twig');
    }
    #[Route('/profil', name: 'profil')]
    public function profil(): Response
    {
        return $this->render('profil.html.twig');
    }
}
