<?php 

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailerController extends AbstractController
{

    public function sendEmail(MailerInterface $mailer, Contact $contact)
    {
        $email = (new TemplatedEmail())
            ->from('noreply@agency.com')
            ->to('contact@agency.com')
            ->replyTo($contact->getEmail())
            ->subject('Agency: Visit Appointment')
            ->htmlTemplate('email/contact.html.twig');

        $mailer->send($email);
    }
}