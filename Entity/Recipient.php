<?php
namespace Flowcode\NotificationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Recipient
{
    private $email;
    private $name;
    private $variables;

    /**
    * Get email
    * @return String
    */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
    * Set email
    * @return $this
    */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
    * Get name
    * @return String
    */
    public function getName()
    {
        return $this->name;
    }
    
    /**
    * Set name
    * @return $this
    */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function __construct() {
        $this->variables = new ArrayCollection();
    }

    function getVariables() {
        return $this->variables;
    }

    function setVariables($variables) {
        $this->variables = $variables;
    }

    function addVariable($variable) {
        $this->variables->add($variable);
    }

}
