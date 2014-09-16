<?php

namespace WBB\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * RedirectUrl
 *
 * @ORM\Table(name="wbb_redirect_url")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
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
     * @var string
     *
     * @ORM\Column(name="source_canonical", type="string", length=255)
     */
    private $sourceCanonical;

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
     * @var string
     *
     * @ORM\Column(name="destination_canonical", type="string", length=255)
     */
    private $destinationCanonical;

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

    /**
     * Set sourceCanonical
     *
     * @param string $sourceCanonical
     * @return RedirectUrl
     */
    public function setSourceCanonical($sourceCanonical)
    {
        $this->sourceCanonical = $sourceCanonical;

        return $this;
    }

    /**
     * Get sourceCanonical
     *
     * @return string 
     */
    public function getSourceCanonical()
    {
        return $this->sourceCanonical;
    }

    /**
     * Set destinationCanonical
     *
     * @param string $destinationCanonical
     * @return RedirectUrl
     */
    public function setDestinationCanonical($destinationCanonical)
    {
        $this->destinationCanonical = $destinationCanonical;

        return $this;
    }

    /**
     * Get destinationCanonical
     *
     * @return string 
     */
    public function getDestinationCanonical()
    {
        return $this->destinationCanonical;
    }

    /**
     * @Assert\Callback
     */
    public function validateDifferentUrls(ExecutionContextInterface $context)
    {
        $sourceC = $this->canonicalizeUrl($this->source);
        $destinationC = $this->canonicalizeUrl($this->destination);
        if (trim($sourceC) == trim($destinationC)) {
            $context->addViolationAt('source', 'The source and destination must have different URLs.');
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->canonicalize();
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->canonicalize();
    }

    private function canonicalize()
    {
        $this->sourceCanonical = $this->canonicalizeUrl($this->source);
        $this->destinationCanonical = $this->canonicalizeUrl($this->destination);
    }

    private function canonicalizeUrl($url)
    {
        $urlCanonical = str_replace(array('http://', 'www.', 'worldsbestbars.com'), '', $url);

        return trim($urlCanonical);
    }

}
