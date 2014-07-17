<?php

namespace WBB\BarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use WBB\BarBundle\Entity\Tip;
use WBB\CoreBundle\Entity\City;
use WBB\CoreBundle\Entity\CitySuburb;
use WBB\UserBundle\Entity\User;
use WBB\BarBundle\Entity\Collections\BarMedia;
use JMS\Serializer\Annotation as JMS;
use WBB\CloudSearchBundle\Indexer\IndexableEntity;

/**
 * Bar
 *
 * @ORM\Table(name="wbb_bar")
 * @ORM\Entity(repositoryClass="WBB\BarBundle\Repository\BarRepository")
 *
 * @JMS\ExclusionPolicy("all")
 */
class Bar implements IndexableEntity
{
    const BAR_STATUS_ENABLED_VALUE = 2;
    const BAR_STATUS_ENABLED_TEXT = "Enabled";
    const BAR_STATUS_PENDING_VALUE = 1;
    const BAR_STATUS_PENDING_TEXT = "Pending";
    const BAR_STATUS_DISABLED_VALUE = 0;
    const BAR_STATUS_DISABLED_TEXT = "Disabled";

    const MOBILE_DESCRIPTION_CHARS_LIMIT = 500;
    const DESKTOP_DESCRIPTION_CHARS_LIMIT = 1000;

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
     * @ORM\Column(name="latitude", type="decimal", scale=8, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="decimal", scale=8, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="county", type="string", length=255, nullable=true)
     */
    private $county;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="address_2", type="string", length=255, nullable=true)
     */
    private $address2;

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
     * @ORM\Column(name="google_plus", type="string", length=255, nullable=true)
     */
    private $googlePlus;

    /**
     * @var string
     *
     * @ORM\Column(name="instagram_id", type="string", length=255, nullable=true)
     */
    private $instagramId;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_checkins", type="integer", nullable=true)
     */
    private $facebookCheckIns;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_likes", type="integer", nullable=true)
     */
    private $facebookLikes;

    /**
     * @var string
     *
     * @ORM\Column(name="foursquare_checkins", type="integer", nullable=true)
     */
    private $foursquareCheckIns;

    /**
     * @var string
     *
     * @ORM\Column(name="foursquare_likes", type="integer", nullable=true)
     */
    private $foursquareLikes;

    /**
     * @var string
     *
     * @ORM\Column(name="foursquare_tips", type="integer", nullable=true)
     */
    private $foursquareTips;

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
    private $creditCard;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_coat_check", type="boolean", nullable=true)
     */
    private $coatCheck;

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
    private $reservation;

    /**
     * @var string
     *
     * @ORM\Column(name="reservation", type="string", length=255, nullable=true)
     */
    private $reservationLink;

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
     * @ORM\Column(name="out_door_seating", type="boolean", nullable=true)
     */
    private $outDoorSeating;

    /**
     * @var boolean
     *
     * @ORM\Column(name="happyHour", type="boolean", nullable=true)
     */
    private $happyHour;

    /**
     * @var boolean
     *
     * @ORM\Column(name="wifi", type="boolean", nullable=true)
     */
    private $wifi;

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
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="barsLevel")
     */
    private $energyLevel;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="barOccasions", cascade={"all"})
     * @ORM\JoinTable(name="wbb_bar_occasion",
     *      joinColumns={@ORM\JoinColumn(name="bar_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="occasion_id", referencedColumnName="id")}
     *      )
     **/
    private $toGoWith;

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
     * @ORM\ManyToMany(targetEntity="News", inversedBy="bars")
     * @ORM\JoinTable(name="wbb_news_bars",
     *      joinColumns={@ORM\JoinColumn(name="bar_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="new_id", referencedColumnName="id")}
     *      )
     **/
    private $news;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Semsoft\SemsoftBar", mappedBy="bar", cascade={"all"}, orphanRemoval=true)
     */
    private $semsoftBars;

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
        if ((strpos($website,'http://') !== false) || (strpos($website,'https://') !== false)) {
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
    public function setCreditCard($isCreditCard)
    {
        $this->creditCard = $isCreditCard;

        return $this;
    }

    /**
     * Get isCreditCard
     *
     * @return boolean
     */
    public function isCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * Set isCoatCheck
     *
     * @param boolean $isCoatCheck
     * @return Bar
     */
    public function setCoatCheck($isCoatCheck)
    {
        $this->coatCheck = $isCoatCheck;

        return $this;
    }

    /**
     * Get isCoatCheck
     *
     * @return boolean
     */
    public function isCoatCheck()
    {
        return $this->coatCheck;
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
        if ((strpos($menu,'http://') !== false) || (strpos($menu,'https://') !== false)) {
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
    public function setReservation($isReservation)
    {
        $this->reservation = $isReservation;

        return $this;
    }

    /**
     * Get isReservation
     *
     * @return boolean
     */
    public function isReservation()
    {
        return $this->reservation;
    }

    /**
     * Set reservation
     *
     * @param string $reservationLink
     * @return Bar
     */
    public function setReservationLink($reservationLink)
    {
        if ((strpos($reservationLink,'http://') !== false) || (strpos($reservationLink,'https://') !== false)) {
            $this->reservationLink = $reservationLink;
        }
        else
        {
            $this->reservationLink = 'http://'.$reservationLink;
        }

        return $this;
    }

    /**
     * Get reservation
     *
     * @return string
     */
    public function getReservationLink()
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

        $this->news = new ArrayCollection();
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
        if(($key = array_search($hash, $this->fsExcludedTips)) !== false) {
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
        if(($key = array_search($hash, $this->fsSelectedImgs)) !== false) {
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
        if($enabled){
            $tips = array();
            foreach($this->tips as $tip){
                if($tip->getStatus() == 1)
                    $tips[] = $tip;
            }
            return $tips;
        }

        return $this->tips;
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
        if(($key = array_search($hash, $this->instagramExcludedImgs)) !== false) {
            unset($this->instagramExcludedImgs[$key]);
        }
    }

    public function getTagsIds()
    {
        $tags = array();
        foreach($this->getTags() as $tag)
        {
            if($tag->getTag())
                $tags[] = $tag->getTag()->getId();
        }

        if(sizeof($tags)>0)
            return $tags;
        else
            return array(0);
    }

    public function getGoWithIds()
    {
        $tags = array();
        foreach ($this->getToGoWith() as $tag) {
            if ($tag) {
                $tags[] = $tag->getId();
            }
        }

        if (sizeof($tags) > 0) {
            return $tags;
        } else {
            return array(0);
        }
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
        $curNb = 0;
        $curDelta = 0;
        $i = 1;
        $count = count($fullArray);
        for ($i = 1 ; $i < $count ; $i++) {
            $cur = $fullArray[$i];
            $curNb = strlen($cur);
            $curSize = strlen($init) + $curNb;
            $curDelta = abs($curSize - $limit);
            if ($curDelta < $delta+3) {
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

    /**
     * Add news
     *
     * @param \WBB\BarBundle\Entity\News $news
     * @return Bar
     */
    public function addNews(\WBB\BarBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \WBB\BarBundle\Entity\News $news
     */
    public function removeNews(\WBB\BarBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }

    /**
    * Get $news
    *
    * @return \Doctrine\Common\Collections\Collection
    **/
    public function getNews(){
         return $this->news;
     }

    /**
     * Add semsoftBars
     *
     * @param \WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBars
     * @return Bar
     */
    public function addSemsoftBar(\WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBars)
    {
        $this->semsoftBars[] = $semsoftBars;

        return $this;
    }

    /**
     * Remove semsoftBars
     *
     * @param \WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBars
     */
    public function removeSemsoftBar(\WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBars)
    {
        $this->semsoftBars->removeElement($semsoftBars);
    }

    /**
     * Get semsoftBars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSemsoftBars()
    {
        return $this->semsoftBars;
    }

    public function getCloudSearchFields()
    {
        $cityName = ($this->city) ? $this->city->getName() : '';
        $countryName = ($this->city->getCountry()) ? $this->city->getCountry()->getName() : '';
        $lat = ($this->latitude) ? $this->latitude : 0;
        $lon = ($this->longitude) ? $this->longitude : 0;

        $tags = $this->getTagsArrays();

        return array(
            'name' => $this->name,
            'slug' => $this->slug,
            'city' => $cityName,
            'country' => $countryName,
            'district' => ($this->suburb) ? $this->suburb->getName() : '',
            'location' => $lat . ',' . $lon,
            'address' => ($this->address) ? $this->address : '',
            'website' => ($this->website) ? $this->website : '',
            'description' => ($this->description) ? $this->description : '',
            'seo_description' => ($this->seoDescription) ? $this->seoDescription : '',
            'tags_style' => $tags['tags_style'],
            'tags_mood' => $tags['tags_mood'],
            'tags_occasion' => $tags['tags_occasion'],
            'tags_cocktails' => $tags['tags_cocktails'],
            //'tags_food' => '',
            //'tags_special' => '',
            'wbb_id' => $this->id
        );
    }

    public function getTagsArrays()
    {
        $tags = array(
            'tags_style' => array(),
            'tags_mood' => array(),
            'tags_occasion' => array(),
            'tags_cocktails' => array(),
        );

        foreach ($this->tags as $barTag) {
            $tag = $barTag->getTag();
            if ($tag) {
                if ($tag->getType() == Tag::WBB_TAG_TYPE_ENERGY_LEVEL) {
                    $tags['tags_mood'][] = $tag->getName();
                } elseif ($tag->getType() == Tag::WBB_TAG_TYPE_BEST_COCKTAILS) {
                    $tags['tags_cocktails'][] = $tag->getName();
                } elseif ($tag->getType() == Tag::WBB_TAG_TYPE_THEME) {
                    $tags['tags_style'][] = $tag->getName();
                } elseif ($tag->getType() == Tag::WBB_TAG_TYPE_WITH_WHO) {
                    $tags['tags_occasion'][] = $tag->getName();
                }
            }
        }

        return $tags;
    }

    public function calculateDistance($latitude, $longitude, $unit = 'km')
    {
        $theta = $this->getLongitude() - $longitude;
        $dist = sin(deg2rad($this->getLatitude())) * sin(deg2rad($latitude)) + cos(deg2rad($this->getLatitude())) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if($unit == "m")
        {
            return round($miles, 2);
        }
        elseif($unit == "nm") {
            return round(($miles * 0.8684), 2);
        }
        else
        {
            return round(($miles * 1.609344), 2);
        }
    }

    public static function getEnergyLevels()
    {
        $result = array(1 => 'Chillout', 2 => "Casual", 3 => "Party");

        return $result;
    }


    /**
     * Set energyLevel
     *
     * @param Tag $energyLevel
     * @return Bar
     */
    public function setEnergyLevel($energyLevel)
    {
        $this->energyLevel = $energyLevel;

        return $this;
    }

    /**
     * Get energyLevel
     *
     * @return integer
     */
    public function getEnergyLevel()
    {
        return $this->energyLevel;
    }

    /**
     * Add toGoWith
     *
     * @param \WBB\BarBundle\Entity\Tag $toGoWith
     * @return Bar
     */
    public function addToGoWith(\WBB\BarBundle\Entity\Tag $toGoWith)
    {
        $this->toGoWith[] = $toGoWith;

        return $this;
    }

    /**
     * Remove toGoWith
     *
     * @param \WBB\BarBundle\Entity\Tag $toGoWith
     */
    public function removeToGoWith(\WBB\BarBundle\Entity\Tag $toGoWith)
    {
        $this->toGoWith->removeElement($toGoWith);
    }

    /**
     * Get toGoWith
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getToGoWith()
    {
        return $this->toGoWith;
    }

    /**
     * Set county
     *
     * @param string $county
     * @return Bar
     */
    public function setCounty($county)
    {
        $this->county = $county;

        return $this;
    }

    /**
     * Get county
     *
     * @return string
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return Bar
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set googlePlus
     *
     * @param string $googlePlus
     * @return Bar
     */
    public function setGooglePlus($googlePlus)
    {
        $this->googlePlus = $googlePlus;

        return $this;
    }

    /**
     * Get googlePlus
     *
     * @return string
     */
    public function getGooglePlus()
    {
        return $this->googlePlus;
    }

    /**
     * Set instagramId
     *
     * @param string $instagramId
     * @return Bar
     */
    public function setInstagramId($instagramId)
    {
        $this->instagramId = $instagramId;

        return $this;
    }

    /**
     * Get instagramId
     *
     * @return string
     */
    public function getInstagramId()
    {
        return $this->instagramId;
    }

    /**
     * Set facebookCheckIns
     *
     * @param integer $facebookCheckIns
     * @return Bar
     */
    public function setFacebookCheckIns($facebookCheckIns)
    {
        $this->facebookCheckIns = $facebookCheckIns;

        return $this;
    }

    /**
     * Get facebookCheckIns
     *
     * @return integer
     */
    public function getFacebookCheckIns()
    {
        return $this->facebookCheckIns;
    }

    /**
     * Set facebookLikes
     *
     * @param integer $facebookLikes
     * @return Bar
     */
    public function setFacebookLikes($facebookLikes)
    {
        $this->facebookLikes = $facebookLikes;

        return $this;
    }

    /**
     * Get facebookLikes
     *
     * @return integer
     */
    public function getFacebookLikes()
    {
        return $this->facebookLikes;
    }

    /**
     * Set foursquareCheckIns
     *
     * @param integer $foursquareCheckIns
     * @return Bar
     */
    public function setFoursquareCheckIns($foursquareCheckIns)
    {
        $this->foursquareCheckIns = $foursquareCheckIns;

        return $this;
    }

    /**
     * Get foursquareCheckIns
     *
     * @return integer
     */
    public function getFoursquareCheckIns()
    {
        return $this->foursquareCheckIns;
    }

    /**
     * Set foursquareLikes
     *
     * @param integer $foursquareLikes
     * @return Bar
     */
    public function setFoursquareLikes($foursquareLikes)
    {
        $this->foursquareLikes = $foursquareLikes;

        return $this;
    }

    /**
     * Get foursquareLikes
     *
     * @return integer
     */
    public function getFoursquareLikes()
    {
        return $this->foursquareLikes;
    }

    /**
     * Set foursquareTips
     *
     * @param integer $foursquareTips
     * @return Bar
     */
    public function setFoursquareTips($foursquareTips)
    {
        $this->foursquareTips = $foursquareTips;

        return $this;
    }

    /**
     * Get foursquareTips
     *
     * @return integer
     */
    public function getFoursquareTips()
    {
        return $this->foursquareTips;
    }

    /**
     * Set outDoorSeating
     *
     * @param boolean $outDoorSeating
     * @return Bar
     */
    public function setOutDoorSeating($outDoorSeating)
    {
        $this->outDoorSeating = $outDoorSeating;

        return $this;
    }

    /**
     * Get outDoorSeating
     *
     * @return boolean
     */
    public function isOutDoorSeating()
    {
        return $this->outDoorSeating;
    }

    public function getPriceSymbols()
    {
        $response = '';

        for($i=1; $i <= $this->price; $i++)
        {
            $response.= "$";
        }

        return $response;
    }

    private function getOpeningsByDay($day)
    {
        $openings = $this->getOpenings();
        $response = '';

        foreach($openings as $op)
        {
            if($day == $op->getOpeningDay())
            {
                $response.= $op->getFromHour().'-'.$op->getToHour().',';
            }
        }

        return substr($response, 0, -1);
    }

    private function getTagsByType($type){
        $tags = $this->getTags();
        $response = '';

        foreach($tags as $tag)
        {
            if($tag->getType() == $type && $tag->getTag())
            {
                $response.= $tag->getTag()->getName().',';
            }
        }
        return substr($response, 0, -1);
    }

    /**
     * @return boolean
     */
    public function isHappyHour()
    {
        return $this->happyHour;
    }

    /**
     * @param boolean $happyHour
     */
    public function setHappyHour($happyHour)
    {
        $this->happyHour = $happyHour;
    }

    /**
     * @return boolean
     */
    public function isWifi()
    {
        return $this->wifi;
    }

    /**
     * @param boolean $wifi
     */
    public function setWifi($wifi)
    {
        $this->wifi = $wifi;
    }

    private function prepareString($string){

        return str_replace(array("\r", "\n"), "", $string);
    }

    public function toCSVArray()
    {
        return array(
            'ID'                    => $this->getId(),
            'Name'                  => $this->getName(),
            'Country'               => ($this->getCity() && $this->getCity()->getCountry())?$this->getCity()->getCountry()->getName():'',
            'County'                => $this->getCounty(),
            'City'                  => ($this->getCity())?$this->getCity()->getName():'',
            'PostalCode'            => ($this->getCity())?$this->getCity()->getPostalCode():'',
            'District'              => ($this->getSuburb())?$this->getSuburb()->getName():'',
            'Street1'               => $this->getAddress(),
            'Street2'               => $this->getAddress2(),
            'Intro'                 => $this->prepareString($this->getSeoDescription()),
            'Description'           => $this->prepareString($this->getDescription()),
            'GeocoordinateString'   => $this->getLatitude().','.$this->getLongitude(),
            'Website'               => $this->getWebsite(),
            'Email'                 => $this->getEmail(),
            'Phone'                 => $this->getPhone(),
            'MondayOpenHours'       => $this->getOpeningsByDay(1),
            'TuesdayOpenHours'      => $this->getOpeningsByDay(2),
            'WednesdayOpenHours'    => $this->getOpeningsByDay(3),
            'ThursdayOpenHours'     => $this->getOpeningsByDay(4),
            'FridayOpenHours'       => $this->getOpeningsByDay(5),
            'SaturdayOpenHours'     => $this->getOpeningsByDay(6),
            'SundayOpenHours'       => $this->getOpeningsByDay(7),
            'Category'              => $this->getTagsByType(Tag::WBB_TAG_TYPE_THEME),
            'Mood'                  => ($this->getEnergyLevel())?$this->getEnergyLevel()->getName():'',
            'OutdoorSeating'        => $this->isOutDoorSeating(),
            'HappyHour'             => $this->isHappyHour(),
            'Wifi'                  => $this->isWifi(),
            'PriceRange'            => $this->getPriceSymbols(),
            'PaymentAccepted'       => ($this->isCreditCard())? 'Card' : '',
            'RestaurantServices'    => $this->getTagsByType(Tag::WBB_TAG_TYPE_SPECIAL_FEATURES),
            'MenuUrl'               => $this->getMenu(),
            'Booking'               => $this->getReservationLink(),
            'ParkingType'           => $this->getParking(),
            'Public Transport'      => '',
            'FacebookId'            => $this->getFacebook(),
            'FacebookUserPage'      => 'http://facebook.com/'.$this->getFacebook(),
            'TwitterName'           => $this->getTwitter(),
            'TwitterUserPage'       => '',
            'InstagramId'           => $this->getInstagramId(),
            'InstagramUserPage'     => $this->getInstagram(),
            'GooglePlusUserPage'    => $this->getGooglePlus(),
            'FoursquareId'          => $this->getFoursquare(),
            'FoursquareUserPage'    => ''.$this->getFoursquare(),
            'FacebookLikes'         => '',
            'FacebookCheckins'      => '',
            'FoursquareLikes'       => '',
            'FoursquareCheckIns'    => '',
            'FoursquareTips'        => '',
            'IsPermanentlyClosed'   => ($this->getStatus() == Bar::BAR_STATUS_DISABLED_VALUE)? "true" : '',
            'BusinessFound'         => ($this->getStatus() == Bar::BAR_STATUS_ENABLED_VALUE)? "true" : '',
            'Updated Columns'       => '',
            'Overwritten Columns'   => ''
        );
    }

    /**
     * Get outDoorSeating
     *
     * @return boolean 
     */
    public function getOutDoorSeating()
    {
        return $this->outDoorSeating;
    }

    /**
     * Get happyHour
     *
     * @return boolean 
     */
    public function getHappyHour()
    {
        return $this->happyHour;
    }

    /**
     * Get wifi
     *
     * @return boolean 
     */
    public function getWifi()
    {
        return $this->wifi;
    }
}
