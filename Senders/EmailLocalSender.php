<?php

namespace Flowcode\NotificationBundle\Senders;

use Swift_Message;
use Flowcode\NotificationBundle\Senders\EmailSenderResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Francisco Memoli <fmemoli@flowcode.com.ar>
 */
class EmailLocalSender implements EmailSenderInterface
{

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function send($toEmail, $toName, $fromEmail, $fromName, $subject, $body, $isHTML = false, $attachmentPath = null)
    {
        $message = Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom(array($fromEmail => $fromName))
            ->setTo(array($toEmail => $toName));
        if ($isHTML) {
            $message->setBody($body, 'text/html');
        } else {
            $message->setBody($body, 'text/plain');
        }
        if($attachmentPath){
           $message->attach(\Swift_Attachment::fromPath($attachmentPath));
        }

        try {
            $this->container->get("mailer")->send($message);
        }
        catch (\Swift_TransportException $e) {
            var_dump($e->getMessage());
        }
        return new EmailSenderResponse(true, EmailSenderResponse::status_sent);
    }

    public function sendTemplate($toEmail, $toName, $fromEmail, $fromName, $subject, $templateName, $templateVars = array(), $attachmentPath = null)
    {

    }

    public function sendTemplateMultipleRecipients($recipients, $fromEmail, $fromName, $subject, $templateName, $templateGlobalVars = array())
    {

    }

}
