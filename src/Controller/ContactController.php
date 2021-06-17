<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $contactForm = $this->createForm(ContactType::class, $contact);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $formData = $contactForm->getData();
            $email = (new Email())
            ->from(new Address($formData->getEmail('email')))
            ->to('serdar45000@gmail.com')
            ->subject('Nouveau message du site COACH MOI')
            ->html($this->renderView('contact/newMessageEmail.html.twig', ['contact' => $contact]));
            $mailer->send($email);
            return $this->render('contact/messageSentConfirmed.html.twig');
        }
        return $this->render('contact/index.html.twig', [
            'contact' => $contactForm->createView()
        ]);
    }
}
