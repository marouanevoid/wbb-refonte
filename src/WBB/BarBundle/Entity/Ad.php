<?php

namespace WBB\BarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Ad
 *
 * @ORM\Table(name="wbb_ad")
 * @ORM\Entity
 */

class Ad {

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
     * @ORM\Column(name="position", type="smallint", nullable=true)
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
     * @ORM\OneToMany(targetEntity="WBB\CoreBundle\Entity\Country", mappedBy="ad", cascade={"persist"})
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
     * @param integer $position
     * @return Ad
     */
    public function setPosition($position){
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @return integer
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
     * Add country
     *
     * @param Country $country
     * @return Ad
     */
    public function addCountry($country){
        $this->countries[] = $country;
        $country->setAd($this);
        return $this;
    }

    /**
     * Remove countries
     *
     * @param Country $countries
     */
    public function removeCountry($countries){
        $this->countries->removeElement($countries);
        $countries->setAd(null);
    }

    /**
     * Get countries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCountries(){
        return $this->countries;
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

}
