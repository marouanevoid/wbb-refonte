<?php

namespace WBB\BarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use WBB\CoreBundle\Entity\City;
use WBB\CoreBundle\Entity\CitySuburb;
use WBB\UserBundle\Entity\User;
use WBB\BarBundle\Entity\Collections\BarMedia;
use JMS\Serializer\Annotation as JMS;

/**
 * Bar
 *
 * @ORM\Table(name="wbb_bar")
 * @ORM\Entity(repositoryClass="WBB\BarBundle\Repository\BarRepository")
 *
 * @JMS\ExclusionPolicy("all")
 */
class Bar
{
    const BAR_STATUS_ENABLED_VALUE = 2;
    const BAR_STATUS_ENABLED_TEXT = "Enabled";
    const BAR_STATUS_PENDING_VALUE = 1;
    const BAR_STATUS_PENDING_TEXT = "Pending";
    const BAR_STATUS_DISABLED_VALUE = 0;
    const BAR_STATUS_DISABLED_TEXT = "Disabled";

    const MOBILE_DESCRIPTION_CHARS_LIMIT = 500;
    const DESKTOP_DESCRIPTION_CHARS_LIMIT = 5000;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @JMS\Expose
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"}, style="camel", separator="-")
     * @ORM\Column(unique=true)
     * @JMS\Expose
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=20, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=20, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="foursquare", type="string", length=255, nullable=true)
     */
    private $foursquare;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="instagram", type="string", length=255, nullable=true)
     */
    private $instagram;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_credit_card", type="boolean", nullable=true)
     */
    private $isCreditCard;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_coat_check", type="boolean", nullable=true)
     */
    private $isCoatCheck;

    /**
     * @var string
     *
     * @ORM\Column(name="parking", type="string", length=255, nullable=true)
     */
    private $parking;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="smallint", nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="menu", type="string", length=255, nullable=true)
     */
    private $menu;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_reservation", type="boolean", nullable=true)
     */
    private $isReservation;

    /**
     * @var string
     *
     * @ORM\Column(name="reservation", type="string", length=255, nullable=true)
     */
    private $reservation;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=255, nullable = true)
     */
    private $seoDescription;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_top", type="boolean", nullable=true)
     */
    private $onTop;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var array
     *
     * @ORM\Column(name="foursquare_excluded_tips", type="array")
     */
    private $fsExcludedTips;

    /**
     * @var array
     *
     * @ORM\Column(name="foursquare_selected_images", type="array")
     */
    private $fsSelectedImgs;

    /**
     * @var array
     *
     * @ORM\Column(name="instagram_excluded_imgs", type="array")
     */
    private $instagramExcludedImgs;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\UserBundle\Entity\User", inversedBy="bars")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\CoreBundle\Entity\City", inversedBy="bars")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\CoreBundle\Entity\CitySuburb", inversedBy="bars")
     */
    private $suburb;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Collections\BarMedia", mappedBy="bar", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $medias;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Collections\BarTag", mappedBy="bar", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Collections\BestOfBar", mappedBy="bar", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $bestofs;

    /**
     * @ORM\OneToMany(targetEntity="BarOpening", mappedBy="bar", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"openingDay" = "ASC"})
     */
    private $openings;

    /**
     * @ORM\OneToMany(targetEntity="Tip", mappedBy="bar", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $tips;
    
    /**
     * @ORM\ManyToOne(targetEntity="News", inversedBy="bars", cascade={"remove"})
     * @ORM\JoinColumn(name="bar_id", referencedColumnName="id")
     */
    private $news;      

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
     * @return Bar
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
     * Set latitude
     *
     * @param string $latitude
     * @return Bar
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Bar
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Bar
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Bar
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Bar
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Bar
     */
    public function setWebsite($website)
    {
        if ((strpos($website,'http://') !== false) or (strpos($website,'https://') !== false))
        {
            $this->website = $website;
        }
        else
        {
            $this->website = 'http://'.$website;
        }

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return Bar
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return Bar
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set instagram
     *
     * @param string $instagram
     * @return Bar
     */
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;

        return $this;
    }

    /**
     * Get instagram
     *
     * @return string 
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * Set isCreditCard
     *
     * @param boolean $isCreditCard
     * @return Bar
     */
    public function setIsCreditCard($isCreditCard)
    {
        $this->isCreditCard = $isCreditCard;

        return $this;
    }

    /**
     * Get isCreditCard
     *
     * @return boolean 
     */
    public function getIsCreditCard()
    {
        return $this->isCreditCard;
    }

    /**
     * Set isCoatCheck
     *
     * @param boolean $isCoatCheck
     * @return Bar
     */
    public function setIsCoatCheck($isCoatCheck)
    {
        $this->isCoatCheck = $isCoatCheck;

        return $this;
    }

    /**
     * Get isCoatCheck
     *
     * @return boolean 
     */
    public function getIsCoatCheck()
    {
        return $this->isCoatCheck;
    }

    /**
     * Set parking
     *
     * @param string $parking
     * @return Bar
     */
    public function setParking($parking)
    {
        $this->parking = $parking;

        return $this;
    }

    /**
     * Get parking
     *
     * @return string 
     */
    public function getParking()
    {
        return $this->parking;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Bar
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set menu
     *
     * @param string $menu
     * @return Bar
     */
    public function setMenu($menu)
    {
        if ((strpos($menu,'http://') !== false) or (strpos($menu,'https://') !== false))
        {
            $this->menu = $menu;
        }
        else
        {
            $this->menu = 'http://'.$menu;
        }

        return $this;
    }

    /**
     * Get menu
     *
     * @return string 
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set isReservation
     *
     * @param boolean $isReservation
     * @return Bar
     */
    public function setIsReservation($isReservation)
    {
        $this->isReservation = $isReservation;

        return $this;
    }

    /**
     * Get isReservation
     *
     * @return boolean 
     */
    public function getIsReservation()
    {
        return $this->isReservation;
    }

    /**
     * Set reservation
     *
     * @param string $reservation
     * @return Bar
     */
    public function setReservation($reservation)
    {
        if ((strpos($reservation,'http://') !== false) or (strpos($reservation,'https://') !== false))
        {
            $this->reservation = $reservation;
        }
        else
        {
            $this->reservation = 'http://'.$reservation;
        }

        return $this;
    }

    /**
     * Get reservation
     *
     * @return string 
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Bar
     */
    public function setDescription($description)
    {
        $this->description = strip_tags($description, '<a><b><br><strong><u><i>');

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
     * Set onTop
     *
     * @param boolean $onTop
     * @return Bar
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
     * Set status
     *
     * @param integer $status
     * @return Bar
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Bar
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
     * @return Bar
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
     * Set user
     *
     * @param User $user
     * @return Bar
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
        $this->openings = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->fsSelectedImgs = array();
        $this->fsExcludedTips = array();
        $this->instagramExcludedImgs = array();

        $this->isCoatCheck      = true;
        $this->isCreditCard     = true;
        $this->onTop            = true;
        $this->isReservation    = true;

        $this->latitude = 0;
        $this->longitude = 0;
    }

    /**
     * Add media
     *
     * @param BarMedia $media
     * @return Bar
     */
    public function addMedia(BarMedia $media)
    {
        $this->medias[] = $media;
        $media->setBar($this);

        return $this;
    }

    /**
     * Remove medias
     *
     * @param BarMedia $medias
     */
    public function removeMedia(BarMedia $medias)
    {
        $this->medias->removeElement($medias);
        $medias->setBar(null);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Set foursquare
     *
     * @param string $foursquare
     * @return Bar
     */
    public function setFoursquare($foursquare)
    {
        $this->foursquare = $foursquare;

        return $this;
    }

    /**
     * Get foursquare
     *
     * @return string 
     */
    public function getFoursquare()
    {
        return $this->foursquare;
    }

    /**
     * Set city
     *
     * @param City $city
     * @return Bar
     */
    public function setCity(City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return Bar
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
     * Set suburb
     *
     * @param CitySuburb $suburb
     * @return Bar
     */
    public function setSuburb(CitySuburb $suburb = null)
    {
        $this->suburb = $suburb;

        return $this;
    }

    /**
     * Get suburb
     *
     * @return CitySuburb
     */
    public function getSuburb()
    {
        return $this->suburb;
    }

    /**
     * Set fsExcludedTips
     *
     * @param array $fsExcludedTips
     * @return Bar
     */
    public function setFsExcludedTips($fsExcludedTips)
    {
        $this->fsExcludedTips = $fsExcludedTips;

        return $this;
    }

    /**
     * Get fsExcludedTips
     *
     * @return array 
     */
    public function getFsExcludedTips()
    {
        return $this->fsExcludedTips;
    }

    public function addFsExcludedTip($hash)
    {
        if(!in_array($hash, $this->fsExcludedTips))
            $this->fsExcludedTips[] = $hash;

        return $this;
    }
    
    public function removeFsExcludedTips($hash)
    {
        if(($key = array_search($hash, $this->fsExcludedTips)) !== false)
        {
            unset($this->fsExcludedTips[$key]);
        }
    }

    /**
     * Set fsExcludedTips
     *
     * @param $fsSelectedImgs
     * @return Bar
     */
    public function setFsSelectedImgs($fsSelectedImgs)
    {
        $this->fsSelectedImgs = $fsSelectedImgs;

        return $this;
    }

    /**
     * Get fsExcludedTips
     *
     * @return array
     */
    public function getFsSelectedImgs()
    {
        return $this->fsSelectedImgs;
    }

    public function addFsSelectedImg($hash)
    {
        if(!in_array($hash, $this->fsSelectedImgs))
            $this->fsSelectedImgs[] = $hash;

        return $this;
    }
    
    public function removeFsSelectedImgs($hash)
    {
        if(($key = array_search($hash, $this->fsSelectedImgs)) !== false)
        {
            unset($this->fsSelectedImgs[$key]);
        }
    }

    /**
     * Add openings
     *
     * @param \WBB\BarBundle\Entity\BarOpening $openings
     * @return Bar
     */
    public function addOpening(\WBB\BarBundle\Entity\BarOpening $openings)
    {
        $this->openings[] = $openings;

        return $this;
    }

    /**
     * Remove openings
     *
     * @param \WBB\BarBundle\Entity\BarOpening $openings
     */
    public function removeOpening(\WBB\BarBundle\Entity\BarOpening $openings)
    {
        $this->openings->removeElement($openings);
    }

    /**
     * Get openings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOpenings()
    {
        return $this->openings;
    }

    /**
     * Add tips
     *
     * @param \WBB\BarBundle\Entity\Tip $tips
     * @return Bar
     */
    public function addTip(\WBB\BarBundle\Entity\Tip $tips)
    {
        $this->tips[] = $tips;

        return $this;
    }

    /**
     * Remove tips
     *
     * @param \WBB\BarBundle\Entity\Tip $tips
     */
    public function removeTip(\WBB\BarBundle\Entity\Tip $tips)
    {
        $this->tips->removeElement($tips);
    }

    /**
     * Get tips
     *
     * @param bool $enabled
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTips($enabled = false)
    {
        if($enabled)
        {
            $tips = array();
            foreach($this->tips as $tip)
            {
                if($tip->getStatus() == 1)
                    $tips[] = $tip;
            }
            return $tips;
        }

        return $this->tips;
    }

    /**
     * Set news
     *
     * @param \WBB\BarBundle\Entity\News $news
     * @return Bar
     */
    public function setNews(\WBB\BarBundle\Entity\News $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \WBB\BarBundle\Entity\News 
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Add tags
     *
     * @param \WBB\BarBundle\Entity\Collections\BarTag $tags
     * @return Bar
     */
    public function addTag(\WBB\BarBundle\Entity\Collections\BarTag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \WBB\BarBundle\Entity\Collections\BarTag $tags
     */
    public function removeTag(\WBB\BarBundle\Entity\Collections\BarTag $tags)
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
     * Set instagramExcludedImgs
     *
     * @param array $instagramExcludedImgs
     * @return Bar
     */
    public function setInstagramExcludedImgs($instagramExcludedImgs)
    {
        $this->instagramExcludedImgs = $instagramExcludedImgs;

        return $this;
    }

    /**
     * Get instagramExcludedImgs
     *
     * @return array 
     */
    public function getInstagramExcludedImgs()
    {
        return $this->instagramExcludedImgs;
    }

    public function addInstagramExcludedImg($hash)
    {
        if(!in_array($hash, $this->instagramExcludedImgs))
            $this->instagramExcludedImgs[] = $hash;

        return $this;
    }

    public function removeInstagramExcludedImgs($hash)
    {
        if(($key = array_search($hash, $this->instagramExcludedImgs)) !== false)
        {
            unset($this->instagramExcludedImgs[$key]);
        }
    }

    public function getTagsIds()
    {
        $tags = array();
        foreach($this->getTags() as $tag)
        {
            $tags[] = $tag->getTag()->getId();
        }

        if(sizeof($tags)>0)
            return $tags;
        else
            return array(0);
    }

    /**
     * Add bestofs
     *
     * @param \WBB\BarBundle\Entity\Collections\BestOfBar $bestofs
     * @return Bar
     */
    public function addBestof(\WBB\BarBundle\Entity\Collections\BestOfBar $bestofs)
    {
        $this->bestofs[] = $bestofs;

        return $this;
    }

    /**
     * Remove bestofs
     *
     * @param \WBB\BarBundle\Entity\Collections\BestOfBar $bestofs
     */
    public function removeBestof(\WBB\BarBundle\Entity\Collections\BestOfBar $bestofs)
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
     * @return Bar
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

    public function splitDescription($getMore = false, $mobile = false)
    {
        $limit = ($mobile) ? self::MOBILE_DESCRIPTION_CHARS_LIMIT : self::DESKTOP_DESCRIPTION_CHARS_LIMIT;

        $fullArray = explode("<br>", $this->description);
        $init = $fullArray[0];
        $delta = abs(strlen($init) - $limit);
        $more = "";
        for ($i = 1 ; $i < count($fullArray) ; $i++)
        {
            $cur = $fullArray[$i];
            $curNb = strlen($cur);
            $curDelta = abs((strlen($init) + $curNb) - $limit);

            if ($curDelta < $delta)
            {
                $init .= "<br>".$cur;
                $delta = $curDelta;
            } else {
                $moreArray = array_slice($fullArray, $i);
                $more = implode( "<br>" , $moreArray);
                break;
            }
        }

        if($getMore)
            return $more;
        else
            return $init;
    }

    public function getDescriptionIntro($mobile = false)
    {
        return $this->splitDescription(false, $mobile);
    }

    public function getDescriptionMore($mobile = false)
    {
        return $this->splitDescription(true, $mobile);
    }
}
