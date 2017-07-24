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
                ->addTo($toEmail)
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

}
