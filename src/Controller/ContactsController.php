<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\ContactsType;
use App\Repository\ContactsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactsController extends AbstractController
{
    #[Route('/', name: 'app_contacts_index', methods: ['GET', 'POST'])]
    public function new(Request $request, ContactsRepository $contactsRepository): Response
    {
        $success = false;
        $contact = new Contacts();
        $form = $this->createForm(ContactsType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactsRepository->save($contact, true);
            $success = true;
        }

        return $this->render('contacts/new.html.twig', [
            'contact' => $contact,
            'form' => $form,
            'success' => $success
        ]);
    }


}
