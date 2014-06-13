<?php

namespace WBB\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use WBB\BarBundle\Entity\News;
use WBB\BarBundle\Entity\Bar;
use WBB\CoreBundle\Entity\CitySuburb;
use WBB\CoreBundle\Entity\CityBestOf;
use WBB\CoreBundle\Entity\Collections\CityTag;
use WBB\CoreBundle\Entity\Country;

/**
 * City
 *
 * @ORM\Table(name="wbb_city")
 * @ORM\Entity(repositoryClass="WBB\CoreBundle\Repository\CityRepository")
 */
class City {

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
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var FileUpload
     */
    private $file;

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
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Bar", mappedBy="city", cascade={"all"})
     */
    private $bars;

    /**
     * @ORM\OneToMany(targetEntity="WBB\CoreBundle\Entity\CityBestOf", mappedBy="city", cascade={"all"})
     */
    private $bestofs;  
    
    /**
     * @ORM\ManyToOne(targetEntity="WBB\BarBundle\Entity\News", inversedBy="cities", cascade={"remove"})
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id")
     */
    private $news;    
    
    /**
     * @ORM\OneToMany(targetEntity="WBB\CoreBundle\Entity\Collections\CityTag", mappedBy="city", cascade={"all"})
     */
    private $tags;

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
     * Set image
     *
     * @param  string   $image
     * @return BestOf
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        if (isset($this->image)) {
            $this->temp = $this->image;
            $this->image = null;
        } else {
            $this->image = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
        return $this->file;
    }

    public function getAbsolutePath() {

        return null === $this->image ? null : $this->getUploadRootDir() . '/' . $this->image;
    }

    public function getWebPath() {

        return null === $this->image ? null : $this->getUploadDir() . '/' . $this->image;
    }

    protected function getUploadRootDir() {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        return 'uploads/cities';
    }

    private $temp;

    /**
     * preUpload
     */
    public function preUpload() {
        if (null !== $this->getFile()) {
            $filename = sha1(uniqid(mt_rand(), true));
            $this->image = $filename . '.' . $this->getFile()->guessExtension();
        }
    }

    /**
     * upload
     */
    public function upload() {

        if (null === $this->getFile()) {
            return;
        }

        $this->getFile()->move($this->getUploadRootDir(), $this->image);

        if (isset($this->temp) && file_exists($this->getUploadRootDir() . '/' . $this->temp)) {
            unlink($this->getUploadRootDir() . '/' . $this->temp);
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * removeUpload
     */
    public function removeUpload() {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    /**
     * Set news
     *
     * @param \WBB\BarBundle\Entity\News $news
     * @return City
     */
    public function setNews(\WBB\BarBundle\Entity\News $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Add tags
     *
     * @param CityTag $tags
     * @return City
     */
    public function addTag(CityTag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param CityTag $tags
     */
    public function removeTag(CityTag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
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
}
