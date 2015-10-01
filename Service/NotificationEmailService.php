<?php

namespace Flowcode\NotificationBundle\Service;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Flowcode\NotificationBundle\Senders\EmailSenderInterface;
use Flowcode\NotificationBundle\Entity\EmailNotification;
/**
 * Description of NotificationEmailService
 *
 * @author Francisco Memoli <fmemoli@flowcode.com.ar>
 */
class NotificationEmailService implements ContainerAwareInterface
{

    /**
     * @var Container
     */
    private $container;
    /**
     * @var entity manager
     */
    private $em;
    /**
     * @var connection
     */
    private $conn;

    /**
     * @var connection
     */
    private $emailSender;

    /**
     * @param EmailSenderInterface $container
     */
    public function setSender(EmailSenderInterface $sender)
    {
        $this->emailSender = $sender;
    }
    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = NULL)
    {
        $this->container = $container;
        $this->em = $this->container->get("doctrine.orm.entity_manager");
        $this->conn = $this->em->getConnection();
    }
    /**
     * This methos read search all the pendings emails notifications and send it.
     * @author Francisco Memoli <fmemoli@flowcode.com.ar>
     * @date   2015-09-24
     * @return void
     */
    public function run(){
        $em = $this->em;
        $batch = 100;
        $this->entityNameNotification = $em->getClassMetadata("FlowcodeNotificationBundle:EmailNotification")->getName();
        $countNotifications = $em->getRepository('FlowcodeNotificationBundle:EmailNotification')->countAllPendingNotifications();
        $pages = ceil($countNotifications/$batch);
        $this->disableLogging();
        for ($i=0; $i < ($pages); $i++) { 
            $offset =($i*$batch);//not necessary for now.
            $notifications = $em->getRepository('FlowcodeNotificationBundle:EmailNotification')->getAllPendingNotifications($batch,0);
            foreach ($notifications as $notification) {
                $this->logger = $this->container->get("logger");
                $this->logger->info("sending " ."ToEmail".$notification->getToEmail()."ToName".$notification->getToName()."FromEmail".$notification->getFromEmail()."FromName".$notification->getFromName()."Subject".$notification->getSubject()."Body".$notification->getBody(). " rows.");
                $this->emailSender->send($notification->getToEmail(),
                                            $notification->getToName(),
                                            $notification->getFromEmail(),
                                            $notification->getFromName(),
                                            $notification->getSubject(),
                                            $notification->getBody(),$notification->getIsHTML());
                $notification->setStatus(EmailNotification::$STATUS_SENDED);
            }
            $this->flushAndClear();
        }
        $this->reEnableLogging();
        $this->finish();
    }

    /**
     * Disable Doctrine logging
     */
    protected function disableLogging() {
        $config = $this->em->getConnection()->getConfiguration();
        $this->originalLogger = $config->getSQLLogger();
        $config->setSQLLogger(null);
    }

    /**
     * Re-enable Doctrine logging
     */
    protected function reEnableLogging() {
        $config = $this->em->getConnection()->getConfiguration();
        $config->setSQLLogger($this->originalLogger);
    }

    /**
     * Do ending process tasks.
     *
     */
    public function finish() {
        $this->flushAndClear();

        $this->reEnableLogging();
    }

    /**
     * Flush and clear the entity manager
     */
    protected function flushAndClear() {
        $this->em->flush();
        $this->em->clear($this->entityNameNotification);
    }
}
