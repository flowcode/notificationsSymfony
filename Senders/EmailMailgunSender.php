<?php

namespace Flowcode\NotificationBundle\Senders;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Flowcode\NotificationBundle\Senders\EmailSenderResponse;
use Mailgun\Mailgun;

/**
 * @author Juan Manuerl Aguero <jaguero@flowcode.com.ar>
 */
class EmailMailgunSender implements EmailSenderInterface
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
        $mailgunApiKey = $this->container->getParameter('mailgun_api_key');
        $mailgunDomain = $this->container->getParameter('mailgun_domain');
        $mgClient = new Mailgun($mailgunApiKey);
        $domain = $mailgunDomain;

        $message = array(
            'from' => $fromName . ' <' . $fromEmail . '>',
            'to' => $toName . ' <' . $toEmail . '>',
            'subject' => $subject
        );
        if (strlen($fromName) == 0) {
            $message['from'] = $fromEmail;
        }
        if ($isHTML) {
            $message['html'] = $body;
        } else {
            $message['text'] = $body;
        }

        # Make the call to the client.
        $resultRaw = $mgClient->sendMessage($domain, $message);
        $result = $resultRaw->http_response_body;
        if ($result->id) {
            return new EmailSenderResponse(true, EmailSenderResponse::status_sent, $result->id);
        } else {
            return new EmailSenderResponse(false, EmailSenderResponse::status_error);
        }
    }

    public function sendTemplate($toEmail, $toName, $fromEmail, $fromName, $subject, $templateName, $templateVars = array(), $attachmentPath = null)
    {
        
    }

    public function sendTemplateMultipleRecipients($recipients, $fromEmail, $fromName, $subject, $templateName, $templateGlobalVars = array())
    {
        
    }

}
