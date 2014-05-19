<?php

namespace WBB\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Application\Sonata\MediaBundle\Entity\Media;

/**
 * Ad
 *
 * @ORM\Table(name="wbb_article_media")
 * @ORM\Entity
 */

class ArticleMedia {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="medias")
     */
    private $article;

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
     * Set article
     *
     * @param \WBB\BarBundle\Entity\Article $article
     * @return ArticleMedia
     */
    public function setArticle($article){
        $this->article = $article;
        return $this;
    }

    /**
     * Get article
     *
     * @return \WBB\BarBundle\Entity\Article
     */
    public function getArticle(){
        return $this->article;
    }

    /**
     * Set media
     *
     * @param Media $media
     * @return ArticleMedia
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
     * @return ArticleMedia
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
     * @return ArticleMedia
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
