<?php

namespace WBB\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use WBB\BarBundle\Entity\News;
use WBB\BarBundle\Entity\Bar;
use WBB\CoreBundle\Entity\CitySuburb;
use WBB\CoreBundle\Entity\CityBestOf;
use WBB\CoreBundle\Entity\Collections\CityTag;
use WBB\CoreBundle\Entity\Country;
use WBB\CloudSearchBundle\Indexer\IndexableEntity;

/**
 * City
 *
 * @ORM\Table(name="wbb_city")
 * @ORM\Entity(repositoryClass="WBB\CoreBundle\Repository\CityRepository")
 */
class City implements IndexableEntity
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
     * @Gedmo\Slug(fields={"name"}, style="camel", separator="-")
     * @ORM\Column(unique=true)
     */
    private $slug;

    /**
     * @var decimal
     *
     * @ORM\Column(name="latitude", type="decimal", scale=8, nullable=true)
     */
    private $latitude;

    /**
     * @var decimal
     *
     * @ORM\Column(name="longitude", type="decimal", scale=8, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="text", nullable=true)
     */
    private $seoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=10, nullable=true)
     */
    private $postalCode;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $image;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_top", type="boolean", nullable=true)
     */
    private $onTopCity;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="cities")
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="CitySuburb", mappedBy="city", cascade={"all"})
     */
    private $suburbs;

    /**
     * @ORM\OneToMany(targetEntity="WBB\UserBundle\Entity\User", mappedBy="prefStartCity", cascade={"persist"})
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Bar", mappedBy="city", cascade={"all"})
     */
    private $bars;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Semsoft\SemsoftBar", mappedBy="city", cascade={"all"})
     */
    private $semsoftBars;

    /**
     * @ORM\OneToMany(targetEntity="WBB\CoreBundle\Entity\CityBestOf", mappedBy="city", cascade={"all"})
     */
    private $bestofs;

    /**
     * @ORM\ManyToMany(targetEntity="WBB\BarBundle\Entity\News", inversedBy="cities", cascade={"all"})
     * @ORM\JoinTable(name="wbb_news_cities",
     *      joinColumns={@ORM\JoinColumn(name="city_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="news_id", referencedColumnName="id")}
     *      )
     **/
    private $news;

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
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return City
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return City
     */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return City
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return City
     */
    public function setSeoDescription($seoDescription) {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string
     */
    public function getSeoDescription() {
        return $this->seoDescription;
    }

    /**
     * Set onTopCity
     *
     * @param boolean $onTopCity
     * @return City
     */
    public function setOnTopCity($onTopCity) {
        $this->onTopCity = $onTopCity;

        return $this;
    }

    /**
     * Get onTopCity
     *
     * @return boolean
     */
    public function getOnTopCity() {
        return $this->onTopCity;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->suburbs = new ArrayCollection();
        $this->news    = new ArrayCollection();

        $this->setOnTopCity(true);
    }

    /**
     * Set country
     *
     * @param Country $country
     * @return City
     */
    public function setCountry(Country $country = null) {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return Country
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * Add suburb
     *
     * @param CitySuburb $suburb
     * @return City
     */
    public function addSuburb(CitySuburb $suburb) {
        $this->suburbs[] = $suburb;
        $suburb->setCity($this);

        return $this;
    }

    /**
     * Remove suburbs
     *
     * @param CitySuburb $suburbs
     */
    public function removeSuburb(CitySuburb $suburbs) {
        $this->suburbs->removeElement($suburbs);
    }

    /**
     * Get suburbs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSuburbs() {
        return $this->suburbs;
    }

    /**
     * Add bar
     *
     * @param Bar $bar
     * @return City
     */
    public function addBar(Bar $bar) {
        $this->bars[] = $bar;
        $bar->setCity($this);

        return $this;
    }

    /**
     * Remove bars
     *
     * @param Bar $bars
     */
    public function removeBar(Bar $bars) {
        $this->bars->removeElement($bars);
    }

    /**
     * Get bars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBars() {
        return $this->bars;
    }

    public function __toString() {
        return $this->getName();
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return City
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return City
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * Add bestofs
     *
     * @param CityBestOf $bestofs
     * @return City
     */
    public function addBestof(CityBestOf $bestofs)
    {
        $this->bestofs[] = $bestofs;

        return $this;
    }

    /**
     * Remove bestofs
     *
     * @param CityBestOf $bestofs
     */
    public function removeBestof(CityBestOf $bestofs)
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
     * Set slug
     *
     * @param string $slug
     * @return City
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add users
     *
     * @param \WBB\UserBundle\Entity\User $users
     * @return City
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

    public function getNbBars()
    {
        return count($this->getBars());
    }

    public function getNbNews()
    {
        return count($this->news);
    }

    public function getNbAreas()
    {
        return count($this->getSuburbs());
    }

    /**
     * Set image
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $image
     * @return City
     */
    public function setImage(\Application\Sonata\MediaBundle\Entity\Media $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add semsoftBars
     *
     * @param \WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBars
     * @return City
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
     * Add news
     *
     * @param \WBB\BarBundle\Entity\News $news
     * @return City
     */
    public function addNews(\WBB\BarBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \WBB\BarBundle\Entity\News $news
     */
    public function removeNews(\WBB\BarBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Add userHomes
     *
     * @param \WBB\UserBundle\Entity\User $userHomes
     * @return City
     */
    public function addUserHome(\WBB\UserBundle\Entity\User $userHomes)
    {
        $this->userHomes[] = $userHomes;

        return $this;
    }

    /**
     * Remove userHomes
     *
     * @param \WBB\UserBundle\Entity\User $userHomes
     */
    public function removeUserHome(\WBB\UserBundle\Entity\User $userHomes)
    {
        $this->userHomes->removeElement($userHomes);
    }

    /**
     * Get userHomes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserHomes()
    {
        return $this->userHomes;
    }

    /**
     * Add userCities1
     *
     * @param \WBB\UserBundle\Entity\User $userCities1
     * @return City
     */
    public function addUserCities1(\WBB\UserBundle\Entity\User $userCities1)
    {
        $this->userCities1[] = $userCities1;

        return $this;
    }

    /**
     * Remove userCities1
     *
     * @param \WBB\UserBundle\Entity\User $userCities1
     */
    public function removeUserCities1(\WBB\UserBundle\Entity\User $userCities1)
    {
        $this->userCities1->removeElement($userCities1);
    }

    /**
     * Get userCities1
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserCities1()
    {
        return $this->userCities1;
    }

    /**
     * Add userCities2
     *
     * @param \WBB\UserBundle\Entity\User $userCities2
     * @return City
     */
    public function addUserCities2(\WBB\UserBundle\Entity\User $userCities2)
    {
        $this->userCities2[] = $userCities2;

        return $this;
    }

    /**
     * Remove userCities2
     *
     * @param \WBB\UserBundle\Entity\User $userCities2
     */
    public function removeUserCities2(\WBB\UserBundle\Entity\User $userCities2)
    {
        $this->userCities2->removeElement($userCities2);
    }

    /**
     * Get userCities2
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserCities2()
    {
        return $this->userCities2;
    }

    public function getCloudSearchFields()
    {
        $countryName = ($this->country) ? $this->country->getName() : '';
        $lat = ($this->latitude) ? $this->latitude : 0;
        $lon = ($this->longitude) ? $this->longitude : 0;
        $suburbs = array();

        foreach ($this->getSuburbs() as $suburb) {
            $suburbs[] = $suburb->getName();
        }

        return array(
            'name' => $this->name,
            'slug' => $this->slug,
            'wbb_id' => $this->id,
            'country' => $countryName,
            'location' => $lat . ',' . $lon,
            'districts' => $suburbs
        );
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     * @return City
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }
}
