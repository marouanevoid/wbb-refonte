<?php

namespace WBB\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trend
 *
 * @ORM\Table(name="wbb_tag")
 * @ORM\Entity
 */
class Trend
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
     * @var boolean
     *
     * @ORM\Column(name="isStyle", type="boolean", nullable=true)
     */
    private $isStyle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isOccasion", type="boolean", nullable=true)
     */
    private $isOccasion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isAtmosphere", type="boolean", nullable=true)
     */
    private $isAtmosphere;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isAlcohol", type="boolean", nullable=true)
     */
    private $isAlcohol;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isCocktail", type="boolean", nullable=true)
     */
    private $isCocktail;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isMood", type="boolean", nullable=true)
     */
    private $isMood;

    /**
     * @var integer
     *
     * @ORM\Column(name="energyLevel", type="smallint", nullable=true)
     */
    private $energyLevel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="onTop", type="boolean", nullable=true)
     */
    private $onTop;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;
    
    /**
     * @ORM\ManyToOne(targetEntity="WBB\CoreBundle\Entity\City", inversedBy="trends")
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Collections\BarTrend", mappedBy="trend", cascade={"all"}, orphanRemoval=true)
     */
    private $bars;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Collections\BestofTrend", mappedBy="trend", cascade={"all"}, orphanRemoval=true)
     */
    private $bestofs;


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
     * @return Trend
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
     * Set isStyle
     *
     * @param boolean $isStyle
     * @return Trend
     */
    public function setIsStyle($isStyle)
    {
        $this->isStyle = $isStyle;

        return $this;
    }

    /**
     * Get isStyle
     *
     * @return boolean 
     */
    public function getIsStyle()
    {
        return $this->isStyle;
    }

    /**
     * Set isOccasion
     *
     * @param boolean $isOccasion
     * @return Trend
     */
    public function setIsOccasion($isOccasion)
    {
        $this->isOccasion = $isOccasion;

        return $this;
    }

    /**
     * Get isOccasion
     *
     * @return boolean 
     */
    public function getIsOccasion()
    {
        return $this->isOccasion;
    }

    /**
     * Set isAtmosphere
     *
     * @param boolean $isAtmosphere
     * @return Trend
     */
    public function setIsAtmosphere($isAtmosphere)
    {
        $this->isAtmosphere = $isAtmosphere;

        return $this;
    }

    /**
     * Get isAtmosphere
     *
     * @return boolean 
     */
    public function getIsAtmosphere()
    {
        return $this->isAtmosphere;
    }

    /**
     * Set isAlcohol
     *
     * @param boolean $isAlcohol
     * @return Trend
     */
    public function setIsAlcohol($isAlcohol)
    {
        $this->isAlcohol = $isAlcohol;

        return $this;
    }

    /**
     * Get isAlcohol
     *
     * @return boolean 
     */
    public function getIsAlcohol()
    {
        return $this->isAlcohol;
    }

    /**
     * Set isCocktail
     *
     * @param boolean $isCocktail
     * @return Trend
     */
    public function setIsCocktail($isCocktail)
    {
        $this->isCocktail = $isCocktail;

        return $this;
    }

    /**
     * Get isCocktail
     *
     * @return boolean 
     */
    public function getIsCocktail()
    {
        return $this->isCocktail;
    }

    /**
     * Set isMood
     *
     * @param boolean $isMood
     * @return Trend
     */
    public function setIsMood($isMood)
    {
        $this->isMood = $isMood;

        return $this;
    }

    /**
     * Get isMood
     *
     * @return boolean 
     */
    public function getIsMood()
    {
        return $this->isMood;
    }

    /**
     * Set energyLevel
     *
     * @param integer $energyLevel
     * @return Trend
     */
    public function setEnergyLevel($energyLevel)
    {
        $this->energyLevel = $energyLevel;

        return $this;
    }

    /**
     * Get energyLevel
     *
     * @return integer 
     */
    public function getEnergyLevel()
    {
        return $this->energyLevel;
    }

    /**
     * Set onTop
     *
     * @param boolean $onTop
     * @return Trend
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

    public static function getEnergyLevels()
    {
        $result = array(0,1,2,3,4,5);

        return $result;
    }

    public function __construct(){
        $this->setIsAlcohol(true);
        $this->setIsAtmosphere(true);
        $this->setIsCocktail(true);
        $this->setIsMood(true);
        $this->setIsOccasion(true);
        $this->setIsStyle(true);
        $this->setOnTop(true);
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Trend
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Trend
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Trend
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set city
     *
     * @param \WBB\CoreBundle\Entity\City $city
     * @return Trend
     */
    public function setCity(\WBB\CoreBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \WBB\CoreBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }
    
    public function __toString() {
        return $this->getName();
    }

    /**
     * Add bars
     *
     * @param \WBB\BarBundle\Entity\Collections\BarTrend|\WBB\BarBundle\Entity\Collections\BarTrend $bars
     * @return Trend
     */
    public function addBar(\WBB\BarBundle\Entity\Collections\BarTrend $bars)
    {
        $this->bars[] = $bars;

        return $this;
    }

    /**
     * Remove bars
     *
     * @param \WBB\BarBundle\Entity\Collections\BarTrend $bars
     */
    public function removeBar(\WBB\BarBundle\Entity\Collections\BarTrend $bars)
    {
        $this->bars->removeElement($bars);
    }

    /**
     * Get bars
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBars()
    {
        return $this->bars;
    }

    /**
     * Add bestofs
     *
     * @param \WBB\BarBundle\Entity\Collections\BestofTrend $bestofs
     * @return Trend
     */
    public function addBestof(\WBB\BarBundle\Entity\Collections\BestofTrend $bestofs)
    {
        $this->bestofs[] = $bestofs;

        return $this;
    }

    /**
     * Remove bestofs
     *
     * @param \WBB\BarBundle\Entity\Collections\BestofTrend $bestofs
     */
    public function removeBestof(\WBB\BarBundle\Entity\Collections\BestofTrend $bestofs)
    {
        $this->bestofs->removeElement($bestofs);
    }

    /**
     * Get bestofs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBestofs()
    {
        return $this->bestofs;
    }
}
