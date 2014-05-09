<?php

namespace WBB\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table(name="wbb_city")
 * @ORM\Entity
 */
class City
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
     * @ORM\Column(name="latitude", type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="text", nullable=true)
     */
    private $seoDescription;

    /**
     * @var boolean
     *
     * @ORM\Column(name="onTopCity", type="boolean", nullable=true)
     */
    private $onTopCity;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="cities")
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="CitySuburb", mappedBy="city", cascade={"persist"})
     */
    private $suburbs;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Bar", mappedBy="city", cascade={"persist"})
     */
    private $bars;

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
     * @return City
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
     * Set latitude
     *
     * @param string $latitude
     * @return City
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return City
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return City
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
     * Set onTopCity
     *
     * @param boolean $onTopCity
     * @return City
     */
    public function setOnTopCity($onTopCity)
    {
        $this->onTopCity = $onTopCity;

        return $this;
    }

    /**
     * Get onTopCity
     *
     * @return boolean 
     */
    public function getOnTopCity()
    {
        return $this->onTopCity;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->suburbs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set country
     *
     * @param \WBB\CoreBundle\Entity\Country $country
     * @return City
     */
    public function setCountry(\WBB\CoreBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \WBB\CoreBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add suburb
     *
     * @param \WBB\CoreBundle\Entity\CitySuburb $suburb
     * @return City
     */
    public function addSuburb(\WBB\CoreBundle\Entity\CitySuburb $suburb)
    {
        $this->suburbs[] = $suburb;
        $suburb->setCity($this);

        return $this;
    }

    /**
     * Remove suburbs
     *
     * @param \WBB\CoreBundle\Entity\CitySuburb $suburbs
     */
    public function removeSuburb(\WBB\CoreBundle\Entity\CitySuburb $suburbs)
    {
        $this->suburbs->removeElement($suburbs);
    }

    /**
     * Get suburbs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSuburbs()
    {
        return $this->suburbs;
    }

    /**
     * Add bar
     *
     * @param \WBB\BarBundle\Entity\Bar $bar
     * @return City
     */
    public function addBar(\WBB\BarBundle\Entity\Bar $bar)
    {
        $this->bars[] = $bar;
        $bar->setCity($this);

        return $this;
    }

    /**
     * Remove bars
     *
     * @param \WBB\BarBundle\Entity\Bar $bars
     */
    public function removeBar(\WBB\BarBundle\Entity\Bar $bars)
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

    public function __toString()
    {
        return $this->getName();
    }
}
