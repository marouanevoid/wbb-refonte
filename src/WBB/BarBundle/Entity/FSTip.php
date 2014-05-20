<?php

namespace WBB\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FSTip
 *
 * @ORM\Table(name="wbb_foursquare_tip")
 * @ORM\Entity
 */
class FSTip
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
     * @ORM\Column(name="hash", type="string", length=255)
     */
    private $hash;

    /**
     * @ORM\ManyToOne(targetEntity="Bar")
     */
    private $bar;


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
     * Set hash
     *
     * @param string $hash
     * @return FSTip
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string 
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set bar
     *
     * @param \WBB\BarBundle\Entity\Bar $bar
     * @return FSTip
     */
    public function setBar(\WBB\BarBundle\Entity\Bar $bar = null)
    {
        $this->bar = $bar;

        return $this;
    }

    /**
     * Get bar
     *
     * @return \WBB\BarBundle\Entity\Bar 
     */
    public function getBar()
    {
        return $this->bar;
    }
}
