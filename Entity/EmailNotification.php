<?php

namespace Flowcode\NotificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class EmailNotification
{
    public static $STATUS_PENDING = 0;
    public static $STATUS_SENDING = 1;
    public static $STATUS_SENDED = 2;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="toEmail", type="string", length=255)
     */
    protected $toEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="toName", type="string", length=255)
     */
    protected $toName;

    /**
     * @var string
     *
     * @ORM\Column(name="fromEmail", type="string", length=255)
     */
    protected $fromEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="fromName", type="string", length=255)
     */
    protected $fromName;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    protected $body;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isHTML", type="boolean")
     */
    protected $isHTML;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    protected $subject;


    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    protected $status;
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set toEmail
     *
     * @param string $toEmail
     * @return EmailNotification
     */
    public function setToEmail($toEmail)
    {
        $this->toEmail = $toEmail;

        return $this;
    }

    /**
     * Get toEmail
     *
     * @return string 
     */
    public function getToEmail()
    {
        return $this->toEmail;
    }

    /**
     * Set toName
     *
     * @param string $toName
     * @return EmailNotification
     */
    public function setToName($toName)
    {
        $this->toName = $toName;

        return $this;
    }

    /**
     * Get toName
     *
     * @return string 
     */
    public function getToName()
    {
        return $this->toName;
    }

    /**
     * Set fromEmail
     *
     * @param string $fromEmail
     * @return EmailNotification
     */
    public function setFromEmail($fromEmail)
    {
        $this->fromEmail = $fromEmail;

        return $this;
    }
    /**
     * Get fromEmail
     *
     * @return string 
     */
    public function getFromEmail()
    {
        return $this->fromEmail;
    }

    /**
     * Set fromName
     *
     * @param string $fromName
     * @return EmailNotification
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * Get fromName
     *
     * @return string 
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return EmailNotification
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set isHTML
     *
     * @param boolean $isHTML
     * @return EmailNotification
     */
    public function setIsHTML($isHTML)
    {
        $this->isHTML = $isHTML;

        return $this;
    }

    /**
     * Get isHTML
     *
     * @return boolean 
     */
    public function getIsHTML()
    {
        return $this->isHTML;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return EmailNotification
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return EmailNotification
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
