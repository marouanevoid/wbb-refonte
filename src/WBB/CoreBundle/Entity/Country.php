<?php

namespace WBB\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use WBB\BarBundle\Entity\Ad;

/**
 * Country
 *
 * @ORM\Table(name="wbb_country")
 * @ORM\Entity(repositoryClass="WBB\CoreBundle\Repository\CountryRepository")
 */
class Country
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
     * @ORM\Column(name="acronym", type="string", length=6)
     */
    private $acronym;

    /**
     * @ORM\Column(name="drinking_age", type="integer")
     */
    private $drinkingAge = 18;

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
     * @ORM\OneToMany(targetEntity="City", mappedBy="country", cascade={"all"})
     */
    private $cities;

    /**
     * @ORM\OneToMany(targetEntity="WBB\UserBundle\Entity\User", mappedBy="country", cascade={"all"})
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\BestOf", mappedBy="country", cascade={"all"})
     */
    private $bestofs;

    /**
     * @ORM\ManyToMany(targetEntity="\WBB\BarBundle\Entity\Ad", inversedBy="countries", cascade={"all"})
     * @ORM\JoinTable(name="wbb_ads_countries",
     *      joinColumns={@ORM\JoinColumn(name="country_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="ad_id", referencedColumnName="id")}
     *      )
     **/
    private $ads;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Semsoft\SemsoftBar", mappedBy="country", cascade={"all"})
     */
    private $semsoftBars;

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
     * @param  string  $name
     * @return Country
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
     * Constructor
     */
    public function __construct()
    {
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add city
     *
     * @param  \WBB\CoreBundle\Entity\City $city
     * @return Country
     */
    public function addCity(\WBB\CoreBundle\Entity\City $city)
    {
        $this->cities[] = $city;
        $city->setCountry($this);

        return $this;
    }

    /**
     * Remove cities
     *
     * @param \WBB\CoreBundle\Entity\City $cities
     */
    public function removeCity(\WBB\CoreBundle\Entity\City $cities)
    {
        $this->cities->removeElement($cities);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return Country
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
     * @param  \DateTime $updatedAt
     * @return Country
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
     * Add bestofs
     *
     * @param  \WBB\BarBundle\Entity\BestOf $bestofs
     * @return Country
     */
    public function addBestof(\WBB\BarBundle\Entity\BestOf $bestofs)
    {
        $this->bestofs[] = $bestofs;

        return $this;
    }

    /**
     * Remove bestofs
     *
     * @param \WBB\BarBundle\Entity\BestOf $bestofs
     */
    public function removeBestof(\WBB\BarBundle\Entity\BestOf $bestofs)
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

    /**
     * Set acronym
     *
     * @param  string  $acronym
     * @return Country
     */
    public function setAcronym($acronym)
    {
        $this->acronym = $acronym;

        return $this;
    }

    /**
     * Get acronym
     *
     * @return string
     */
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * Add users
     *
     * @param  \WBB\UserBundle\Entity\User $users
     * @return Country
     */
    public function addUser(\WBB\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \WBB\UserBundle\Entity\User $users
     */
    public function removeUser(\WBB\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add semsoftBars
     *
     * @param  \WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBars
     * @return Country
     */
    public function addSemsoftBar(\WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBars)
    {
        $this->semsoftBars[] = $semsoftBars;

        return $this;
    }

    /**
     * Remove semsoftBars
     *
     * @param \WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBars
     */
    public function removeSemsoftBar(\WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBars)
    {
        $this->semsoftBars->removeElement($semsoftBars);
    }

    /**
     * Get semsoftBars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSemsoftBars()
    {
        return $this->semsoftBars;
    }

    /**
     * Set drinkingAge
     *
     * @param  integer $drinkingAge
     * @return Country
     */
    public function setDrinkingAge($drinkingAge)
    {
        $this->drinkingAge = $drinkingAge;

        return $this;
    }

    /**
     * Get drinkingAge
     *
     * @return integer
     */
    public function getDrinkingAge()
    {
        return $this->drinkingAge;
    }

    /**
     * Add ads
     *
     * @param  Ad      $ads
     * @return Country
     */
    public function addAd(Ad $ads)
    {
        $this->ads[] = $ads;

        return $this;
    }

    /**
     * Remove ads
     *
     * @param Ad $ads
     */
    public function removeAd(Ad $ads)
    {
        $this->ads->removeElement($ads);
    }

    /**
     * Get ads
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAds()
    {
        return $this->ads;
    }
}
