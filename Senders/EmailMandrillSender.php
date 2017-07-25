<?php

namespace Flowcode\NotificationBundle\Senders;

use Slot\MandrillBundle\Message;
use Slot\MandrillBundle\Dispatcher;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Flowcode\NotificationBundle\Senders\EmailSenderResponse;

/**
 * @author Francisco Memoli <fmemoli@flowcode.com.ar>
 */
class EmailMandrillSender implements EmailSenderInterface
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
        $dispatcher = $this->container->get('slot_mandrill.dispatcher');
        $message = new Message();
        $message->setFromEmail($fromEmail)
                ->setFromName($fromName)
                ->addTo($toEmail, $toName)
                ->setSubject($subject);
        if ($isHTML) {
            $message->setHtml($body);
        } else {
            $message->setText($body);
        }
        if ($attachmentPath) {
            $message->addAttachmentFromPath($attachmentPath);
        }
        $result = $dispatcher->send($message);


        switch ($result[0]["status"]) {
            case 'sent':
                return new EmailSenderResponse(true, EmailSenderResponse::status_sent, $result[0]['_id']);
                break;
            default:
                return new EmailSenderResponse(false, EmailSenderResponse::status_error);
                break;
        }
    }

    public function sendTemplate($toEmail, $toName, $fromEmail, $fromName, $subject, $templateName, $templateVars = array(), $attachmentPath = null)
    {
        $dispatcher = $this->container->get('slot_mandrill.dispatcher');
        $message = new Message();
        $message->setFromEmail($fromEmail)
                ->setFromName($fromName)
                ->addTo($toEmail, $toName)
                ->setSubject($subject);
        if ($attachmentPath) {
            $message->addAttachmentFromPath($attachmentPath);
        }
        foreach ($templateVars as $var) {
            $message->addGlobalMergeVar($var['name'], $var['content']);
        }
        $result = $dispatcher->send($message, $templateName);

        switch ($result[0]["status"]) {
            case 'sent':
                return new EmailSenderResponse(true, EmailSenderResponse::status_sent, $result[0]['_id']);
                break;
            default:
                return new EmailSenderResponse(false, EmailSenderResponse::status_error);
                break;
        }
    }

    public function sendTemplateMultipleRecipients($recipients, $fromEmail, $fromName, $subject, $templateName, $templateVars = array())
    {
        $dispatcher = $this->container->get('slot_mandrill.dispatcher');
        $message = new Message();
        $message->setFromEmail($fromEmail)
                ->setFromName($fromName)
                ->setSubject($subject);
        foreach ($recipients as $recipient) {
            $message->addTo($recipient['email'], $recipient['name']);
        }
        foreach ($templateVars as $var) {
            if ($var['global']) {
                $message->addGlobalMergeVar($var['name'], $var['content']);
            } else {
                $message->addMergeVar($var['recipient'], $var['name'], $var['content']);
            }
        }
        $result = $dispatcher->send($message, $templateName);

        switch ($result[0]["status"]) {
            case 'sent':
                return new EmailSenderResponse(true, EmailSenderResponse::status_sent, $result[0]['_id']);
                break;
            default:
                return new EmailSenderResponse(false, EmailSenderResponse::status_error);
                break;
        }
    }

}
