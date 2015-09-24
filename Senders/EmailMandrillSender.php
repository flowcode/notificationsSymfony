<?php
namespace Flowcode\NotificationBundle\Senders;
use Hip\MandrillBundle\Message;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * @author Francisco Memoli <fmemoli@flowcode.com.ar>
 */
class EmailMandrillSender implements  EmailSenderInterface{
	
	/**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

	public function send($toEmail, $toName, $fromEmail,$fromName, $subject, $body, $isHTML = false){
        $dispatcher = $this->container->get('hip_mandrill.dispatcher');
		$message = new Message();
                    $message->setFromEmail($fromEmail)
                            ->setFromName($fromName)
                            ->addTo($toEmail)
                            ->setSubject($subject);
        if($isHTML){
        	$message->setHtml($body);
        }else{
        	$message->setText($body);
        }
		$result = $dispatcher->send($message);
	}
}

?>

