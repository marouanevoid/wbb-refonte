<?php

namespace WBB\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trend
 *
 * @ORM\Table()
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
}