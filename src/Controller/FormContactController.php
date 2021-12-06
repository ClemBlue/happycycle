<?php

namespace App\Controller;

use App\Entity\FormContact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormContactController extends AbstractController
{
    #[Route('/contact', name: 'form_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formContact = new FormContact();
        $form = $this->createForm(ContactFormType::class, $formContact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($formContact);
            $entityManager->flush();

            return $this->redirectToRoute('main');
        }

        return $this->render('form_contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
