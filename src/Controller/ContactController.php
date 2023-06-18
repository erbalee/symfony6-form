<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    // #[Route('/contact', name: 'app_contact')]
    // public function index(): Response
    // {
    //     return $this->render('contact/index.html.twig', [
    //         'controller_name' => 'ContactController',
    //     ]);
    // }

    /**
     * @Route("/")
     */
    public function show(Environment $twig, Request $request, EntityManagerInterface $entitiyManager)
    {

        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entitiyManager->persist($contact);
            $entitiyManager->flush();
            $form = $this->createForm(ContactFormType::class, $contact);

            $message = 'Köszönjük szépen a kérdésedet. Válaszunkkal hamarosan keresünk a megadott e-mail címen';
            $this->addFlash('notice', $message);

            return $this->redirect('/');
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $message = 'Hiba! Kérjük töltsd ki az összes mezőt!';
            $this->addFlash('error', $message);

            return $this->redirect('/');
        }

        return new Response($twig->render('contact/show.html.twig', [
            'contact_form' => $form->createView(),
        ]));
    }
}
