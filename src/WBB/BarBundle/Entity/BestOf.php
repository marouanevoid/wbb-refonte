<?php

namespace WBB\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BestOf
 *
 * @ORM\Table(name="wbb_best_of")
 * @ORM\Entity
 */
class BestOf
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="sponsor", type="string", length=255)
     */
    private $sponsor;

    /**
     * @var string
     *
     * @ORM\Column(name="seoDescription", type="string", length=255)
     */
    private $seoDescription;

    /**
     * @var boolean
     *
     * @ORM\Column(name="byTrend", type="boolean")
     */
    private $byTrend;

    /**
     * @var boolean
     *
     * @ORM\Column(name="onTop", type="boolean")
     */
    private $onTop;


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
     * Set name
     *
     * @param string $name
     * @return BestOf
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return BestOf
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set sponsor
     *
     * @param string $sponsor
     * @return BestOf
     */
    public function setSponsor($sponsor)
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    /**
     * Get sponsor
     *
     * @return string 
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return BestOf
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string 
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * Set byTrend
     *
     * @param boolean $byTrend
     * @return BestOf
     */
    public function setByTrend($byTrend)
    {
        $this->byTrend = $byTrend;

        return $this;
    }

    /**
     * Get byTrend
     *
     * @return boolean 
     */
    public function getByTrend()
    {
        return $this->byTrend;
    }

    /**
     * Set onTop
     *
     * @param boolean $onTop
     * @return BestOf
     */
    public function setOnTop($onTop)
    {
        $this->onTop = $onTop;

        return $this;
    }

    /**
     * Get onTop
     *
     * @return boolean 
     */
    public function getOnTop()
    {
        return $this->onTop;
    }
}
