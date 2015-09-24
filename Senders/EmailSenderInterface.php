<?php
namespace Flowcode\NotificationBundle\Senders;

/**
 * @author Francisco Memoli <fmemoli@flowcode.com.ar>
 */
interface EmailSenderInterface
{
	/**
	 * The method send an email.
	 * @author Francisco Memoli <fmemoli@flowcode.com.ar>
	 * @date   2015-09-24
	 * @param  string     $toEmail   reciber email
	 * @param  string     $toName    reciber name
	 * @param  string     $fromEmail email from where we send
	 * @param  string     $fromName  name from where we send
	 * @param  string     $subject   some resume
	 * @param  string     $body      all my content, could be html or not.
	 * @param  boolean    $isHTML    if the body is html content or not. If is true is HTML.
	 * @return void
	 */
	public function send($toEmail, $toName, $fromEmail, $fromName, $subject, $body, $isHTML = false);
}

?>