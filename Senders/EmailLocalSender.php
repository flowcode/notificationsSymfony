<?php
namespace Flowcode\NotificationBundle\Senders;
use Swift_Message;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * @author Francisco Memoli <fmemoli@flowcode.com.ar>
 */
class EmailLocalSender implements  EmailSenderInterface{
	
	/**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

	public function send($toEmail, $toName, $fromEmail,$fromName, $subject, $body, $isHTML = false){
        $message = Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom(array($fromEmail => $fromName))
                ->setTo(array($toEmail => $toName));
        if($isHTML){
        	$message->setBody($body, 'text/html');
        }else{
        	$message->setBody($body, 'text/plain');
        }

        $this->container->get("mailer")->send($message);
	}
}

?>