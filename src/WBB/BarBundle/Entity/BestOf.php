<?php

namespace WBB\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * BestOf
 *
 * @ORM\Table(name="wbb_bestof")
 * @ORM\Entity(repositoryClass="WBB\BarBundle\Repository\BestOfRepository")
 */
class BestOf
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
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

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
     * @var string
     *
     * @ORM\Column(name="sponsor", type="string", length=255, nullable=true)
     */
    private $sponsor;

    /**
     * @var string
     *
     * @ORM\Column(name="sponsor_image", type="string", length=255, nullable=true)
     */
    private $sponsorImage;

    /**
     * @var FileUpload
     */
    private $sponsorImageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=255, nullable=true)
     */
    private $seoDescription;

    /**
     * @var boolean
     *
     * @ORM\Column(name="by_tag", type="boolean", nullable=true)
     */
    private $byTag;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_top", type="boolean", nullable=true)
     */
    private $onTop;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ordered", type="boolean", nullable=true)
     */
    private $ordered;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\CoreBundle\Entity\City", inversedBy="bestofs")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\CoreBundle\Entity\Country", inversedBy="bestofs")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="News", inversedBy="bestOfs", cascade={"remove"})
     * @ORM\JoinColumn(name="bestof_id", referencedColumnName="id")
     */
    private $news;    
    
    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Collections\BestOfTag", mappedBy="bestof", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Collections\BestOfBar", mappedBy="bestof", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $bars;

    /**
     * @ORM\ManyToMany(targetEntity="BestOf", mappedBy="bestofs")
     */
    private $inBestofs;

    /**
     * @ORM\ManyToMany(targetEntity="BestOf", inversedBy="inBestofs")
     * @ORM\JoinTable(name="wbb_bestof_bestof",
     *      joinColumns={@ORM\JoinColumn(name="bestof_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="in_bestof_id", referencedColumnName="id")}
     *      )
     **/
    private $bestofs;

    
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
     * Set name
     *
     * @param string $name
     * @return BestOf
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return BestOf
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set sponsor
     *
     * @param string $sponsor
     * @return BestOf
     */
    public function setSponsor($sponsor)
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    /**
     * Get sponsor
     *
     * @return string 
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return BestOf
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string 
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * Set byTag
     *
     * @param boolean $byTag
     * @return BestOf
     */
    public function setByTag($byTag)
    {
        $this->byTag = $byTag;

        return $this;
    }

    /**
     * Get byTag
     *
     * @return boolean 
     */
    public function getByTag()
    {
        return $this->byTag;
    }

    /**
     * Set onTop
     *
     * @param boolean $onTop
     * @return BestOf
     */
    public function setOnTop($onTop)
    {
        $this->onTop = $onTop;

        return $this;
    }

    /**
     * Get onTop
     *
     * @return boolean 
     */
    public function getOnTop()
    {
        return $this->onTop;
    }


    /**
     * Set image
     *
     * @param  string   $image
     * @return BestOf
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
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
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setSponsorImageFile(UploadedFile $file = null)
    {
        $this->sponsorImageFile = $file;
        if (isset($this->sponsorImage)) {
            $this->temp = $this->sponsorImage;
            $this->sponsorImage = null;
        } else {
            $this->sponsorImage = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getSponsorImageFile()
    {
        return $this->sponsorImageFile;
    }

    public function getAbsolutePath($sponsor = null)
    {
        if($sponsor){
            return null === $this->sponsorImage
                ? null
                : $this->getUploadRootDir(true).'/'.$this->sponsorImage;
        }else{
            return null === $this->image
                ? null
                : $this->getUploadRootDir().'/'.$this->image;
        }
    }

    public function getWebPath($sponsor = null)
    {
        if($sponsor){
            return null === $this->sponsorImage
                ? null
                : $this->getUploadDir(true).'/'.$this->sponsorImage;
        }else{
            return null === $this->image
                ? null
                : $this->getUploadDir().'/'.$this->image;
        }
    }

    protected function getUploadRootDir($sponsor = null)
    {
        if($sponsor)
            return __DIR__.'/../../../../web/'.$this->getUploadDir(true);
        else
            return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir($sponsor = null)
    {
        if($sponsor){
            return "uploads/sponsor";
        }else{
            return 'uploads/bestof';
        }
    }

    private $temp;

    /**
     * preUpload
     */
    public function preUpload($sponsor = null)
    {
        if($sponsor){
            if (null !== $this->getSponsorImageFile()) {
                $filename = sha1(uniqid(mt_rand(), true));
                $this->sponsorImage = $filename.'.'.$this->getSponsorImageFile()->guessExtension();
            }
        }else{
            if (null !== $this->getFile()) {
                $filename = sha1(uniqid(mt_rand(), true));
                $this->image = $filename.'.'.$this->getFile()->guessExtension();
            }
        }
    }

    /**
     * upload
     */
    public function upload($sponsor = null)
    {
        if($sponsor){
            if (null === $this->getSponsorImageFile()) {
                return;
            }

            $this->getSponsorImageFile()->move($this->getUploadRootDir(true), $this->sponsorImage);

            if (isset($this->temp) && file_exists($this->getUploadRootDir(true).'/'.$this->temp)) {
                unlink($this->getUploadRootDir(true).'/'.$this->temp);
                $this->temp = null;
            }
            $this->sponsorImageFile = null;
        }else{
            if (null === $this->getFile()) {
                return;
            }

            $this->getFile()->move($this->getUploadRootDir(), $this->image);

            if (isset($this->temp) && file_exists($this->getUploadRootDir().'/'.$this->temp)) {
                unlink($this->getUploadRootDir().'/'.$this->temp);
                $this->temp = null;
            }
            $this->file = null;
        }
    }

    /**
     * removeUpload
     */
    public function removeUpload($sponsor = null)
    {
        if($sponsor){
            if ($file = $this->getAbsolutePath(true)) {
                unlink($file);
            }
        }else{
            if ($file = $this->getAbsolutePath()) {
                unlink($file);
            }
        }
    }

    /**
     * Set sponsorImage
     *
     * @param string $sponsorImage
     * @return BestOf
     */
    public function setSponsorImage($sponsorImage)
    {
        $this->sponsorImage = $sponsorImage;

        return $this;
    }

    /**
     * Get sponsorImage
     *
     * @return string 
     */
    public function getSponsorImage()
    {
        return $this->sponsorImage;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return BestOf
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
     * @param \DateTime $updatedAt
     * @return BestOf
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
     * Set city
     *
     * @param \WBB\CoreBundle\Entity\City $city
     * @return BestOf
     */
    public function setCity(\WBB\CoreBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \WBB\CoreBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param \WBB\CoreBundle\Entity\Country $country
     * @return BestOf
     */
    public function setCountry(\WBB\CoreBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \WBB\CoreBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function __construct(){
        $this->setOnTop(true);
        $this->setByTag(true);
        $this->setOrdered(true);
    }

    /**
     * Add tags
     *
     * @param \WBB\BarBundle\Entity\Collections\BestOfTag $tags
     * @return BestOf
     */
    public function addTag(\WBB\BarBundle\Entity\Collections\BestOfTag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \WBB\BarBundle\Entity\Collections\BestOfTag $tags
     */
    public function removeTag(\WBB\BarBundle\Entity\Collections\BestOfTag $tags)
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
     * Set ordered
     *
     * @param boolean $ordered
     * @return BestOf
     */
    public function setOrdered($ordered)
    {
        $this->ordered = $ordered;

        return $this;
    }

    /**
     * Get ordered
     *
     * @return boolean 
     */
    public function getOrdered()
    {
        return $this->ordered;
    }
    
    /**
     * Set news
     *
     * @param News $news
     * @return BestOf
     */
    public function setNews($news){
        $this->news = $news;
        return $this;
    }

    /**
     * Get news
     *
     * @return News
     */
    public function getNews(){
        return $this->news;
    }

    /**
     * Add bars
     *
     * @param \WBB\BarBundle\Entity\Collections\BestOfBar $bars
     * @return BestOf
     */
    public function addBar(\WBB\BarBundle\Entity\Collections\BestOfBar $bars)
    {
        $this->bars[] = $bars;

        return $this;
    }

    /**
     * Remove bars
     *
     * @param \WBB\BarBundle\Entity\Collections\BestOfBar $bars
     */
    public function removeBar(\WBB\BarBundle\Entity\Collections\BestOfBar $bars)
    {
        $this->bars->removeElement($bars);
    }

    /**
     * Get bars
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBars()
    {
        return $this->bars;
    }

    /**
     * Add inBestofs
     *
     * @param \WBB\BarBundle\Entity\BestOf $inBestofs
     * @return BestOf
     */
    public function addInBestof(\WBB\BarBundle\Entity\BestOf $inBestofs)
    {
        $this->inBestofs[] = $inBestofs;

        return $this;
    }

    /**
     * Remove inBestofs
     *
     * @param \WBB\BarBundle\Entity\BestOf $inBestofs
     */
    public function removeInBestof(\WBB\BarBundle\Entity\BestOf $inBestofs)
    {
        $this->inBestofs->removeElement($inBestofs);
    }

    /**
     * Get inBestofs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInBestofs()
    {
        return $this->inBestofs;
    }

    /**
     * Add bestofs
     *
     * @param \WBB\BarBundle\Entity\BestOf $bestofs
     * @return BestOf
     */
    public function addBestof(\WBB\BarBundle\Entity\BestOf $bestofs)
    {
        $this->bestofs[] = $bestofs;

        return $this;
    }

    /**
     * Remove bestofs
     *
     * @param \WBB\BarBundle\Entity\BestOf $bestofs
     */
    public function removeBestof(\WBB\BarBundle\Entity\BestOf $bestofs)
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
}
