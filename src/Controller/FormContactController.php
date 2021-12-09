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
    public function show(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $formContact = new FormContact();

        $form = $this->createForm(ContactFormType::class, $formContact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManagerInterface->persist($formContact);
            $entityManagerInterface->flush();

        }

        return $this->render('form_contact/index.html.twig',[
            'contact_form' => $form->createView()
        ]);
    }
}
