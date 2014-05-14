<?php

namespace WBB\BarBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;

/**
 * BarMedia
 *
 * @ORM\Table(name="wbb_bar_media")
 * @ORM\Entity
 */
class BarMedia
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
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="smallint", nullable=true)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="Bar", inversedBy="medias")
     */
    private $bar;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $media;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $video1;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $video2;


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
     * Set alt
     *
     * @param string $alt
     * @return BarMedia
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return BarMedia
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set bar
     *
     * @param \WBB\BarBundle\Entity\Bar $bar
     * @return BarMedia
     */
    public function setBar(\WBB\BarBundle\Entity\Bar $bar = null)
    {
        $this->bar = $bar;

        return $this;
    }

    /**
     * Get bar
     *
     * @return \WBB\BarBundle\Entity\Bar
     */
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * Set media
     *
     * @param Media $media
     * @return BarMedia
     */
    public function setMedia(Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set video1
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $video1
     * @return BarMedia
     */
    public function setVideo1(Media $video1 = null)
    {
        $this->video1 = $video1;

        return $this;
    }

    /**
     * Get video1
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getVideo1()
    {
        return $this->video1;
    }

    /**
     * Set video2
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $video2
     * @return BarMedia
     */
    public function setVideo2(Media $video2 = null)
    {
        $this->video2 = $video2;

        return $this;
    }

    /**
     * Get video2
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getVideo2()
    {
        return $this->video2;
    }

    public function __toString()
    {
        return $this->alt;
    }
}
