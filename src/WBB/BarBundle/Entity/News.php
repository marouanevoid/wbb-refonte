<?php

namespace WBB\BarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;
use WBB\CoreBundle\Entity\City;
use WBB\CloudSearchBundle\Indexer\IndexableEntity;
/**
 * News
 *
 * @ORM\Table(name="wbb_news")
 * @ORM\Entity(repositoryClass="WBB\BarBundle\Repository\NewsRepository")
 */

class News implements IndexableEntity
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"}, style="camel", separator="-")
     * @ORM\Column(unique=true)
     * @JMS\Expose
     */
    private $slug;

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
     * @ORM\Column(name="on_top", type="boolean", nullable=true)
     */
    private $isOnTop;

    /**
     * @ORM\ManyToMany(targetEntity="Bar", mappedBy="news")
     */
    private $bars; 
    
    /**
     * @ORM\ManyToMany(targetEntity="WBB\CoreBundle\Entity\City", mappedBy="news")
     */
    private $cities;

    /**
     * @ORM\ManyToMany(targetEntity="BestOf", mappedBy="news")
     */
    private $bestOfs;     
    
    /**
     * @ORM\ManyToOne(targetEntity="WBB\UserBundle\Entity\User", inversedBy="news")
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Collections\NewsMedia", mappedBy="news", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $medias;

    /**
     * @var string
     *
     * @ORM\Column(name="sponsor", type="string", length=255, nullable=true)
     */
    private $sponsor;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $sponsorImage;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $sponsorImageSmall;

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
        $this->bars    = new ArrayCollection();
        $this->cities  = new ArrayCollection();
        $this->bestOfs = new ArrayCollection();
        $this->medias  = new ArrayCollection();
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
        $bar->addNews($this);
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
        $bar->getNews()->removeElement($this);
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
     * Add BestOf
     *
     * @param BestOf $bestOf
     * @return News
     */
    public function addBestOf($bestOf){
        $bestOf->addNews($this);
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
        $bestOf->getNews()->removeElement($this);
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
     * @param NewsMedia $media
     */
    public function removeMedia($media){
        $this->medias->removeElement($media);
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
     * Set sponsor
     *
     * @param string $sponsor
     * @return News
     */
    public function setSponsor($sponsor){
        $this->sponsor = $sponsor;
        return $this;
    }

    /**
     * Get sponsor
     *
     * @return string 
     */
    public function getSponsor(){
        return $this->sponsor;
    }
    
    /**
     * Set sponsorImage
     *
     * @param string $sponsorImage
     * @return News
     */
    public function setSponsorImage($sponsorImage){
        $this->sponsorImage = $sponsorImage;
        return $this;
    }

    /**
     * Get sponsorImage
     *
     * @return Media 
     */
    public function getSponsorImage(){
        return $this->sponsorImage;
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


    /**
     * Set slug
     *
     * @param string $slug
     * @return News
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

    public function getFirstVideo()
    {
        $medias = $this->getMedias();
        foreach($medias as $media)
        {
            if($media->getMedia()->getProviderName() === "sonata.media.provider.youtube")
                return $media;
        }

        return null;
    }

    public function hasOnlyOneTopCity()
    {
        $count = 0;
        $city = null;

        foreach($this->getCities() as $obj)
        {
            if($obj->getOnTopCity()){
                $count++;
                $city = $obj;
            }
        }

        return ($count == 1) ? $city : null;
    }

    public function getCitiesAsArray()
    {
        $ids = array();

        foreach($this->getCities() as $city){
            $ids[] = $city->getId();
        }

        return $ids;
    }

    /**
     * Set sponsorImageSmall
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $sponsorImageSmall
     * @return News
     */
    public function setSponsorImageSmall(\Application\Sonata\MediaBundle\Entity\Media $sponsorImageSmall = null)
    {
        $this->sponsorImageSmall = $sponsorImageSmall;

        return $this;
    }

    /**
     * Get sponsorImageSmall
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getSponsorImageSmall()
    {
        return $this->sponsorImageSmall;
    }

    /**
     * Add cities
     *
     * @param City $city
     * @return News
     */
    public function addCity(City $city)
    {
        $this->cities[] = $city;
        $city->addNews($this);

        return $this;
    }

    /**
     * Remove cities
     *
     * @param City $city
     */
    public function removeCity(City $city)
    {
        $this->cities->removeElement($city);
        $city->getNews()->removeElement($this);
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
    
    public function getCloudSearchFields()
    {
        $cities = array();
        $bars = array();
        foreach ($this->cities as $city) {
            $cities[] = $city->getName();
        }
        foreach ($this->bars as $bar) {
            $bars[] = $bar->getName();
        }
        
        $bestOfs = array();
        foreach ($this->bestOfs as $bestOf) {
            $bestOfs[] = $bestOf->getName();
        }

        return array(
            //'name' => $this->name,
            'title' => ($this->title) ? $this->title : '',
            //'text' => '',
            'cities' => $cities,
            'quote' => ($this->quoteText) ? $this->quoteText : '',
            'quote_author' => ($this->quoteAuthor) ? $this->quoteAuthor : '',
            'seo_description' => ($this->seoDescription) ? $this->seoDescription : '',
            'bestofs' => $bestOfs,
            'bars' => $bars,
            //'tags_mood' => '',
            //'tags_occasion' => '',
            //'tags_cocktails' => '',
            //'tags_special' => '',
            'wbb_id' => $this->id
        );
    }
}
