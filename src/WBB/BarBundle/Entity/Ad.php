<?php

namespace WBB\BarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Ad
 *
 * @ORM\Table(name="wbb_ad")
 * @ORM\Entity(repositoryClass="WBB\BarBundle\Repository\AdRepository")
 */

class Ad {

    const WBB_ADS_HP_300X250    = "HP_300x250";
    const WBB_ADS_HP_728X90     = "HP_728x90";
    const WBB_ADS_BF_728X90     = "BF_728x90";
    const WBB_ADS_SR_728X90     = "SR_728x90";
    const WBB_ADS_BG_728X90     = "BG_728x90";
    const WBB_ADS_BD_300X250    = "BD_300x250";
    const WBB_ADS_BD_728X90     = "BD_728x90";
    const WBB_ADS_BOD_300X250   = "BOD_300x250";
    const WBB_ADS_BOD_728X90    = "BOD_728x90";
    const WBB_ADS_NLP_300X250   = "NLP_300x250";
    const WBB_ADS_NLP_300X600   = "NLP_300x600";
    const WBB_ADS_NLP_728X90    = "NLP_728x90";
    const WBB_ADS_ND_300X250    = "ND_300x250";
    const WBB_ADS_ND_728X90     = "ND_728x90";
    const WBB_ADS_UP_728X90     = "UP_728x90";

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
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="string", length=20, nullable=true)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=255, nullable=true)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=1024, nullable=true)
     */
    private $link;

    /**
     * @ORM\ManyToMany(targetEntity="WBB\CoreBundle\Entity\Country", mappedBy="ads")
     */
    private $countries;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="begin_at", type="datetime", nullable=true)
     */
    private $beginAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_at", type="datetime", nullable=true)
     */
    private $endAt;

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
     * Constructor
     */
    public function __construct(){
        $this->countries = new ArrayCollection();
    }

    /**
     * toString
     */
    public function __toString(){
        return $this->getName();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Ad
     */
    public function setName($name){
        $this->name = $name;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return Ad
     */
    public function setPosition($position){
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition(){
        return $this->position;
    }

    /**
     * Set image
     *
     * @param Media $image
     * @return Ad
     */
    public function setImage($image){
        $this->image = $image;
        return $this;
    }

    /**
     * Get image
     *
     * @return Media
     */
    public function getImage(){
        return $this->image;
    }

    /**
     * Set tag
     *
     * @param string $tag
     * @return Ad
     */
    public function setTag($tag){
        $this->tag = $tag;
        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag(){
        return $this->tag;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Ad
     */
    public function setLink($link){
        $this->link = $link;
        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink(){
        return $this->link;
    }

    /**
     * Set beginAt
     *
     * @param \DateTime $beginAt
     * @return Ad
     */
    public function setBeginAt($beginAt){
        $this->beginAt = $beginAt;
        return $this;
    }

    /**
     * Get beginAt
     *
     * @return \DateTime
     */
    public function getBeginAt(){
        return $this->beginAt;
    }

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     * @return Ad
     */
    public function setEndAt($endAt){
        $this->endAt = $endAt;
        return $this;
    }

    /**
     * Get endAt
     *
     * @return \DateTime
     */
    public function getEndAt(){
        return $this->endAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Ad
     */
    public function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(){
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Ad
     */
    public function setUpdatedAt($updatedAt){
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt(){
        return $this->updatedAt;
    }

    public static function getAdsPositionArray(){
        return array(
            Ad::WBB_ADS_HP_300X250    => "Home Page (300x250)",
            Ad::WBB_ADS_HP_728X90     => "Home Page (728x90)",
            Ad::WBB_ADS_BF_728X90     => "Bar Finder (728x90)",
            Ad::WBB_ADS_SR_728X90     => "Search Results (728x90)",
            Ad::WBB_ADS_BG_728X90     => "Bar Guide (728x90)",
            Ad::WBB_ADS_BD_300X250    => "Bar Detail (300x250)",
            Ad::WBB_ADS_BD_728X90     => "Bar Detail (728x90)",
            Ad::WBB_ADS_BOD_300X250   => "Best of Detail (300x250)",
            Ad::WBB_ADS_BOD_728X90    => "Best of Detail (728x90)",
            Ad::WBB_ADS_NLP_300X250   => "News Landing Page (300x250)",
            Ad::WBB_ADS_NLP_300X600   => "News Landing Page (300x600)",
            Ad::WBB_ADS_NLP_728X90    => "News Landing Page (728x90)",
            Ad::WBB_ADS_ND_300X250    => "News Detail (300x250)",
            Ad::WBB_ADS_ND_728X90     => "News Detail (728x90)",
            Ad::WBB_ADS_UP_728X90     => "User Profile (728x90)"
        );
    }


    /**
     * Add countries
     *
     * @param \WBB\CoreBundle\Entity\Country $country
     * @return Ad
     */
    public function addCountry(\WBB\CoreBundle\Entity\Country $country)
    {
        $this->countries[] = $country;
        $country->addAd($this);
        return $this;
    }

    /**
     * Remove countries
     *
     * @param \WBB\CoreBundle\Entity\Country $country
     */
    public function removeCountry(\WBB\CoreBundle\Entity\Country $country)
    {
        $this->countries->removeElement($country);
        $country->removeAd($this);
    }

    /**
     * Get countries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCountries()
    {
        return $this->countries;
    }
}
