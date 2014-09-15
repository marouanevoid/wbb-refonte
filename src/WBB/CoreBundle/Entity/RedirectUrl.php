<?php

namespace WBB\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RedirectUrl
 *
 * @ORM\Table(name="wbb_redirect_url")
 * @ORM\Entity
 * @UniqueEntity("source")
 */
class RedirectUrl
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Url()
     */
    private $source;

    /**
     * @var integer
     *
     * @ORM\Column(name="redirect", type="integer")
     * @Assert\NotBlank()
     */
    private $redirect;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Url()
     */
    private $destination;

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
     * Set source
     *
     * @param string $source
     * @return RedirectUrl
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set redirect
     *
     * @param integer $redirect
     * @return RedirectUrl
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;

        return $this;
    }

    /**
     * Get redirect
     *
     * @return integer 
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * Set destination
     *
     * @param string $destination
     * @return RedirectUrl
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string 
     */
    public function getDestination()
    {
        return $this->destination;
    }

}
