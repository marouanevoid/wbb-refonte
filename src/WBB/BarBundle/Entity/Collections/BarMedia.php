<?php

namespace WBB\BarBundle\Entity\Collections;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use WBB\BarBundle\Entity\Bar;
use WBB\BarBundle\Entity\Collections\BestOfBar;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * BarMedia
 *
 * @ORM\Table(name="wbb_bar_media")
 * @ORM\Entity
 * @Vich\Uploadable
 *
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
     * @ORM\ManyToOne(targetEntity="WBB\BarBundle\Entity\Bar", inversedBy="medias")
     */
    private $bar;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Collections\BestOfBar", mappedBy="media", cascade={"persist"}, orphanRemoval=true)
     */
    private $bestofs;

    /**
    **
    * @Vich\UploadableField(mapping="bar_image", fileNameProperty="media")
    *
    * @var File $mediaFile
    */
    protected $mediaFile;

    /**
     * @ORM\Column(type="string", length=255, name="media_name", nullable=true)
     *
     * @var string $media
     */
    protected $media;

    /**
     * @ORM\Column(type="string", length=20, name="youtube", nullable=true)
     *
     * @var string $youtube
     */
    protected $youtube;

    ////////// Media getters and setters
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setMediaFile(File $image)
    {
        $this->mediaFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getMediaFile()
    {
        return $this->mediaFile;
    }

    /**
     * @param string $imageName
     */
    public function setMedia($imageName)
    {
        $this->media = $imageName;
    }

    /**
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    //////////End Media Getters and setters

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set alt
     *
     * @param  string   $alt
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
     * @param  integer  $position
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
     * @param  Bar $bar
     * @return BarMedia
     */
    public function setBar(Bar $bar = null)
    {
        $this->bar = $bar;

        return $this;
    }

    /**
     * Get bar
     *
     * @return Bar
     */
    public function getBar()
    {
        return $this->bar;
    }

    public function __toString()
    {
        if($this->alt)

            return $this->position.': '.$this->alt;
        else
            return '';
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return BarMedia
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
     * @return BarMedia
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
     * Constructor
     */
    public function __construct()
    {
        $this->bestofs = new ArrayCollection();
    }

    /**
     * Add bestofs
     *
     * @param  BestOfBar $bestofs
     * @return BarMedia
     */
    public function addBestof(BestOfBar $bestofs)
    {
        $this->bestofs[] = $bestofs;

        return $this;
    }

    /**
     * Remove bestofs
     *
     * @param BestOfBar $bestofs
     */
    public function removeBestof(BestOfBar $bestofs)
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
     * Set youtube
     *
     * @param string $youtube
     * @return BarMedia
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;

        return $this;
    }

    /**
     * Get youtube
     *
     * @return string 
     */
    public function getYoutube()
    {
        return $this->youtube;
    }
}
