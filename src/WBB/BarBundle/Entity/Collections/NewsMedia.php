<?php

namespace WBB\BarBundle\Entity\Collections;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Application\Sonata\MediaBundle\Entity\Media;

/**
 * NewsMedia
 *
 * @ORM\Table(name="wbb_news_media")
 * @ORM\Entity
 */

class NewsMedia {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\BarBundle\Entity\News", inversedBy="medias")
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id")
     */
    private $news;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $media;

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
     * Set news
     *
     * @param \WBB\BarBundle\Entity\News $news
     * @return NewsMedia
     */
    public function setNews($news){
        $this->news = $news;
        return $this;
    }

    /**
     * Get news
     *
     * @return \WBB\BarBundle\Entity\News
     */
    public function getNews(){
        return $this->news;
    }

    /**
     * Set media
     *
     * @param Media $media
     * @return NewsMedia
     */
    public function setMedia($media){
        $this->media = $media;
        return $this;
    }

    /**
     * Get media
     *
     * @return Media
     */
    public function getMedia(){
        return $this->media;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return NewsMedia
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
     * @return NewsMedia
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
