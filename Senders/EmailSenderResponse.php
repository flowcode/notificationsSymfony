<?php

namespace Flowcode\NotificationBundle\Senders;

/**
 * Email Sender Reponse.
 * @author Juan Manuel Aguero <jaguero@flowcode.com.ar>
 */
class EmailSenderResponse
{
    const status_sent = 'sent';
    const status_error = 'error';

    /**
     * Send id.
     * @var string
     */
    protected $id;

    /**
     * Send status.
     * @var string
     */
    protected $status;

    /**
     * Send sucess.
     * @var boolean
     */
    protected $sucess;

    public function __construct($sucess = true, $status = self::status_sent, $id = null)
    {
        $this->sucess = $success;
        $this->status = $status;
        $this->id = $id;
    }

    /**
     * Set status.
     * @param string $status status.
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status.
     * @return string status.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status.
     * @param string $success success.
     */
    public function setSuccess($success)
    {
        $this->success = $success;
        return $this;
    }

    /**
     * Get success.
     * @return string success.
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * Set id.
     * @param string $id id.
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get id.
     * @return string id.
     */
    public function getId()
    {
        return $this->id;
    }



}
