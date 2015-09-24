<?php

namespace Flowcode\NotificationBundle\Command;

/**
 *
 * @author Francisco Memoli <fmemoli@flowcode.com.ar>
 */
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Flowcode\NotificationBundle\Service\NotificationEmailService;
class NotificationEmailCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
                ->setName('flowcode:notification:email')
                ->setDescription('Init notification email');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Start notification process ");
        $notificationEmailService = $this->getContainer()->get("flowcode.notification.email");
        $notificationEmailService->run();
        $output->writeln("Done.");
    }
}
