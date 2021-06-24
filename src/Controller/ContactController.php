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
    public const MAILER_TO = "contact@coachmoi.com";
    public const MAILER_SUBJECT = "Nouveau message du site COACH MOI";
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $contactForm = $this->createForm(ContactType::class, $contact);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contactForm = $contactForm->getData();
            $email = (new Email())
            ->from(new Address($contactForm->getEmail()))
            ->to(self::MAILER_TO)
            ->subject(self::MAILER_SUBJECT)
            ->html($this->renderView('contact/newMessageEmail.html.twig', ['contact' => $contact]));
            $mailer->send($email);
            $this->addFlash('success', 'Votre message est en cours de traitement,
                nous vous contacterons ultérieurement !');
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
            'contact' => $contactForm->createView()
        ]);
    }
}
