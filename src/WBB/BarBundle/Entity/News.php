<?php

namespace WBB\BarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * News
 *
 * @ORM\Table(name="wbb_news")
 * @ORM\Entity
 */

class News {

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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="share_text", type="string", length=1024, nullable=true)
     */
    private $shareText;

    /**
     * @var string
     *
     * @ORM\Column(name="quote_author", type="string", length=1024, nullable=true)
     */
    private $quoteAuthor;

    /**
     * @var string
     *
     * @ORM\Column(name="quote_text", type="string", length=1024, nullable=true)
     */
    private $quoteText;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=1024, nullable=true)
     */
    private $seoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="rich_description", type="text", nullable=true)
     */
    private $richDescription;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_an_interview", type="boolean", nullable=true)
     */
    private $isAnInterview;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_on_top", type="boolean", nullable=true)
     */
    private $isOnTop;

    /**
     * @ORM\OneToMany(targetEntity="Bar", mappedBy="news", cascade={"remove", "persist"})
     */
    private $bars; 
    
    /**
     * @ORM\OneToMany(targetEntity="WBB\CoreBundle\Entity\City", mappedBy="news", cascade={"remove", "persist"})
     */
    private $cities;    

    /**
     * @ORM\OneToMany(targetEntity="BestOf", mappedBy="news", cascade={"remove", "persist"})
     */
    private $bestOfs;     
    
    /**
     * @ORM\ManyToOne(targetEntity="WBB\UserBundle\Entity\User", inversedBy="tips")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Collections\NewsMedia", mappedBy="news", cascade={"remove", "persist"})
     */
    private $medias;

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

    }

    /**
     * toString
     */
    public function __toString(){
        return $this->getTitle();
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
     * Set title
     *
     * @param string $title
     * @return News
     */
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(){
        return $this->title;
    }

    /**
     * Set shareText
     *
     * @param string $shareText
     * @return News
     */
    public function setShareText($shareText){
        $this->shareText = $shareText;
        return $this;
    }

    /**
     * Get shareText
     *
     * @return string
     */
    public function getShareText(){
        return $this->shareText;
    }


    /**
     * Set quoteAuthor
     *
     * @param string $quoteAuthor
     * @return News
     */
    public function setQuoteAuthor($quoteAuthor){
        $this->quoteAuthor = $quoteAuthor;
        return $this;
    }

    /**
     * Get quoteAuthor
     *
     * @return string
     */
    public function getQuoteAuthor(){
        return $this->quoteAuthor;
    }

    /**
     * Set quoteText
     *
     * @param string $quoteText
     * @return News
     */
    public function setQuoteText($quoteText){
        $this->quoteText = $quoteText;
        return $this;
    }

    /**
     * Get quoteText
     *
     * @return string
     */
    public function getQuoteText(){
        return $this->quoteText;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return News
     */
    public function setSeoDescription($seoDescription){
        $this->seoDescription = $seoDescription;
        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string
     */
    public function getSeoDescription(){
        return $this->seoDescription;
    }

    /**
     * Set richDescription
     *
     * @param string $richDescription
     * @return News
     */
    public function setRichDescription($richDescription){
        $this->richDescription = $richDescription;
        return $this;
    }

    /**
     * Get richDescription
     *
     * @return string
     */
    public function getRichDescription(){
        return $this->richDescription;
    }

    /**
     * Set isAnInterview
     *
     * @param boolean $isAnInterview
     * @return News
     */
    public function setIsAnInterview($isAnInterview){
        $this->isAnInterview = $isAnInterview;
        return $this;
    }

    /**
     * Get isAnInterview
     *
     * @return boolean
     */
    public function getIsAnInterview(){
        return $this->isAnInterview;
    }


    /**
     * Set isOnTop
     *
     * @param boolean $isOnTop
     * @return News
     */
    public function setIsOnTop($isOnTop){
        $this->isOnTop = $isOnTop;
        return $this;
    }

    /**
     * Get isOnTop
     *
     * @return boolean
     */
    public function getIsOnTop(){
        return $this->isOnTop;
    }

    /**
     * Add bar
     *
     * @param Bar $bar
     * @return News
     */
    public function addBar($bar){
        $this->bars[] = $bar;
        return $this;
    }

    /**
     * Remove bars
     *
     * @param Bar $bar
     */
    public function removeBar($bar){
        $this->bars->removeElement($bar);
    }

    /**
     * Get bars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBars(){
        return $this->bars;
    }

    /**
     * Add city
     *
     * @param City $city
     * @return News
     */
    public function addCity($city){
        $this->cities[] = $city;
        return $this;
    }

    /**
     * Remove city
     *
     * @param City $citie
     */
    public function removeCity($citie){
        $this->cities->removeElement($citie);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities(){
        return $this->cities;
    }


    /**
     * Add city
     *
     * @param BestOf $bestOf
     * @return News
     */
    public function addBestOf($bestOf){
        $this->bestOfs[] = $bestOf;
        return $this;
    }

    /**
     * Remove bestOf
     *
     * @param BestOf $bestOf
     */
    public function removeBestOf($bestOf){
        $this->cities->removeElement($bestOf);
    }

    /**
     * Get bestOfs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBestOfs(){
        return $this->bestOfs;
    }    
    
    /**
     * Set user
     *
     * @param User $user
     * @return Tip
     */
    public function setUser($user){
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser(){
        return $this->user;
    }

    /**
     * Add media
     *
     * @param BarMedia $media
     * @return News
     */
    public function addMedia($media){
        $this->medias[] = $media;
        return $this;
    }

    /**
     * Remove medias
     *
     * @param NewsMedia $medias
     */
    public function removeMedia($medias){
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedias(){
        return $this->medias;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Tip
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
     * @return Tip
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
