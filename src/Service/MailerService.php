<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct(private MailerInterface $mailer)
    {

    }
    public function sendMAil(
        $from = 'aymen.noreply.please@gmail.com',
        $to = 'aymen.sellaouti@gmail.com',
        $subject = 'Time for Symfony Mailer!',
        $body = '<p>See Twig integration for better HTML integration!</p>')
    {
        $email = (new Email())
            ->from($from)
            ->to($to)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
            ->text('Sending emails is fun again!')
            ->html($body);

        $this->mailer->send($email);

    }

}