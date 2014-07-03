<?php

namespace WBB\BarBundle\Entity\Semsoft;

use Doctrine\ORM\Mapping as ORM;
use WBB\BarBundle\Entity\Semsoft\BarOpening;

/**
 * SemsoftBars
 *
 * @ORM\Table(name="wbb_semsoft_imported_bar")
 * @ORM\Entity
 */
class SemsoftBar
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
     * @ORM\Column(name="county", type="string", length=255, nullable=true)
     */
    private $county;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=255, nullable=true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="decimal", nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="decimal", nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="smallint", nullable=true)
     */
    private $price;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_credit_card", type="boolean", nullable=true)
     */
    private $isCreditCard;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="text", nullable=true)
     */
    private $seoDescription;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_out_door_seating", type="boolean", nullable=true)
     */
    private $isOutDoorSeating;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_happy_hour", type="boolean", nullable=true)
     */
    private $isHappyHour;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_wifi", type="boolean", nullable=true)
     */
    private $isWiFi;

    /**
     * @var string
     *
     * @ORM\Column(name="menu", type="string", length=255, nullable=true)
     */
    private $menu;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reservation", type="boolean", nullable=true)
     */
    private $reservation;

    /**
     * @var string
     *
     * @ORM\Column(name="parking_type", type="string", length=255, nullable=true)
     */
    private $parkingType;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
     */
    private $facebookID;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_user_page", type="string", length=255, nullable=true)
     */
    private $facebookUserPage;

    /**
     * @var integer
     *
     * @ORM\Column(name="facebook_likes", type="integer", nullable=true)
     */
    private $facebookLikes;

    /**
     * @var integer
     *
     * @ORM\Column(name="facebook_check_ins", type="integer", nullable=true)
     */
    private $facebookCheckIns;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter_name", type="string", length=255, nullable=true)
     */
    private $twitterName;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter_user_page", type="string", length=255, nullable=true)
     */
    private $twitterUserPage;

    /**
     * @var string
     *
     * @ORM\Column(name="instagram_id", type="string", length=255, nullable=true)
     */
    private $instagramID;

    /**
     * @var string
     *
     * @ORM\Column(name="instagram_user_page", type="string", length=255, nullable=true)
     */
    private $instagramUserPage;

    /**
     * @var string
     *
     * @ORM\Column(name="google_plus_user_page", type="string", length=255, nullable=true)
     */
    private $googlePlusUserPage;

    /**
     * @var string
     *
     * @ORM\Column(name="foursquare_id", type="string", length=255, nullable=true)
     */
    private $foursquareID;

    /**
     * @var string
     *
     * @ORM\Column(name="foursquare_user_page", type="string", length=255, nullable=true)
     */
    private $foursquareUserPage;

    /**
     * @var integer
     *
     * @ORM\Column(name="foursquare_check_ins", type="integer", nullable=true)
     */
    private $foursquareCheckIns;

    /**
     * @var integer
     *
     * @ORM\Column(name="foursquare_likes", type="integer", nullable=true)
     */
    private $foursquareLikes;

    /**
     * @var integer
     *
     * @ORM\Column(name="foursquare_tips", type="integer", nullable=true)
     */
    private $foursquareTips;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_permanently_closed", type="boolean", nullable=true)
     */
    private $isPermanentlyClosed;

    /**
     * @var boolean
     *
     * @ORM\Column(name="business_found", type="boolean", nullable=true)
     */
    private $businessFound;

    /**
     * @var array
     *
     * @ORM\Column(name="updated_columns", type="array", nullable=true)
     */
    private $updatedColumns;

    /**
     * @var array
     *
     * @ORM\Column(name="overwritten_columns", type="array", nullable=true)
     */
    private $overwrittenColumns;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\CoreBundle\Entity\Country", inversedBy="semsoftBars")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\CoreBundle\Entity\City", inversedBy="semsoftBars")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\CoreBundle\Entity\CitySuburb", inversedBy="semsoftBars", cascade={"all"})
     */
    private $suburb;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Collections\BarTag", mappedBy="semsoftBar", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\BarOpening", mappedBy="semsoftBar", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"openingDay" = "ASC"})
     */
    private $openings;


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
     * @return Semsoft
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
     * Set postalCode
     *
     * @param string $postalCode
     * @return Semsoft
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Semsoft
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
     * Set latitude
     *
     * @param string $latitude
     * @return Semsoft
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
     * @return Semsoft
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
     * Set website
     *
     * @param string $website
     * @return Semsoft
     */
    public function setWebsite($website)
    {
        $this->website = $website;

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
     * Set email
     *
     * @param string $email
     * @return Semsoft
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
     * Set phone
     *
     * @param string $phone
     * @return Semsoft
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
     * Set price
     *
     * @param integer $price
     * @return Semsoft
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
     * Set isCreditCard
     *
     * @param boolean $isCreditCard
     * @return Semsoft
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
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return Semsoft
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
     * Set isOutDoorSeating
     *
     * @param boolean $isOutDoorSeating
     * @return Semsoft
     */
    public function setIsOutDoorSeating($isOutDoorSeating)
    {
        $this->isOutDoorSeating = $isOutDoorSeating;

        return $this;
    }

    /**
     * Get isOutDoorSeating
     *
     * @return boolean 
     */
    public function getIsOutDoorSeating()
    {
        return $this->isOutDoorSeating;
    }

    /**
     * Set isHappyHour
     *
     * @param boolean $isHappyHour
     * @return Semsoft
     */
    public function setIsHappyHour($isHappyHour)
    {
        $this->isHappyHour = $isHappyHour;

        return $this;
    }

    /**
     * Get isHappyHour
     *
     * @return boolean 
     */
    public function getIsHappyHour()
    {
        return $this->isHappyHour;
    }

    /**
     * Set isWiFi
     *
     * @param boolean $isWiFi
     * @return Semsoft
     */
    public function setIsWiFi($isWiFi)
    {
        $this->isWiFi = $isWiFi;

        return $this;
    }

    /**
     * Get isWiFi
     *
     * @return boolean 
     */
    public function getIsWiFi()
    {
        return $this->isWiFi;
    }

    /**
     * Set menu
     *
     * @param string $menu
     * @return Semsoft
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;

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
     * Set reservation
     *
     * @param boolean $reservation
     * @return Semsoft
     */
    public function setReservation($reservation)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return boolean 
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set parkingType
     *
     * @param string $parkingType
     * @return Semsoft
     */
    public function setParkingType($parkingType)
    {
        $this->parkingType = $parkingType;

        return $this;
    }

    /**
     * Get parkingType
     *
     * @return string 
     */
    public function getParkingType()
    {
        return $this->parkingType;
    }

    /**
     * Set facebookID
     *
     * @param string $facebookID
     * @return Semsoft
     */
    public function setFacebookID($facebookID)
    {
        $this->facebookID = $facebookID;

        return $this;
    }

    /**
     * Get facebookID
     *
     * @return string 
     */
    public function getFacebookID()
    {
        return $this->facebookID;
    }

    /**
     * Set facebookUserPage
     *
     * @param string $facebookUserPage
     * @return Semsoft
     */
    public function setFacebookUserPage($facebookUserPage)
    {
        $this->facebookUserPage = $facebookUserPage;

        return $this;
    }

    /**
     * Get facebookUserPage
     *
     * @return string 
     */
    public function getFacebookUserPage()
    {
        return $this->facebookUserPage;
    }

    /**
     * Set twitterName
     *
     * @param string $twitterName
     * @return Semsoft
     */
    public function setTwitterName($twitterName)
    {
        $this->twitterName = $twitterName;

        return $this;
    }

    /**
     * Get twitterName
     *
     * @return string 
     */
    public function getTwitterName()
    {
        return $this->twitterName;
    }

    /**
     * Set twitterUserPage
     *
     * @param string $twitterUserPage
     * @return Semsoft
     */
    public function setTwitterUserPage($twitterUserPage)
    {
        $this->twitterUserPage = $twitterUserPage;

        return $this;
    }

    /**
     * Get twitterUserPage
     *
     * @return string 
     */
    public function getTwitterUserPage()
    {
        return $this->twitterUserPage;
    }

    /**
     * Set instagramID
     *
     * @param string $instagramID
     * @return Semsoft
     */
    public function setInstagramID($instagramID)
    {
        $this->instagramID = $instagramID;

        return $this;
    }

    /**
     * Get instagramID
     *
     * @return string 
     */
    public function getInstagramID()
    {
        return $this->instagramID;
    }

    /**
     * Set instagramUserPage
     *
     * @param string $instagramUserPage
     * @return Semsoft
     */
    public function setInstagramUserPage($instagramUserPage)
    {
        $this->instagramUserPage = $instagramUserPage;

        return $this;
    }

    /**
     * Get instagramUserPage
     *
     * @return string 
     */
    public function getInstagramUserPage()
    {
        return $this->instagramUserPage;
    }

    /**
     * Set googlePlusUserPage
     *
     * @param string $googlePlusUserPage
     * @return Semsoft
     */
    public function setGooglePlusUserPage($googlePlusUserPage)
    {
        $this->googlePlusUserPage = $googlePlusUserPage;

        return $this;
    }

    /**
     * Get googlePlusUserPage
     *
     * @return string 
     */
    public function getGooglePlusUserPage()
    {
        return $this->googlePlusUserPage;
    }

    /**
     * Set foursquareCheckIns
     *
     * @param integer $foursquareCheckIns
     * @return Semsoft
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
     * Set facebookCheckIns
     *
     * @param integer $facebookCheckIns
     * @return Semsoft
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
     * Set foursquareLikes
     *
     * @param integer $foursquareLikes
     * @return Semsoft
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
     * Set facebookLikes
     *
     * @param integer $facebookLikes
     * @return Semsoft
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
     * Set isPermanentlyClosed
     *
     * @param boolean $isPermanentlyClosed
     * @return Semsoft
     */
    public function setIsPermanentlyClosed($isPermanentlyClosed)
    {
        $this->isPermanentlyClosed = $isPermanentlyClosed;

        return $this;
    }

    /**
     * Get isPermanentlyClosed
     *
     * @return boolean 
     */
    public function getIsPermanentlyClosed()
    {
        return $this->isPermanentlyClosed;
    }

    /**
     * Set businessFound
     *
     * @param boolean $businessFound
     * @return Semsoft
     */
    public function setBusinessFound($businessFound)
    {
        $this->businessFound = $businessFound;

        return $this;
    }

    /**
     * Get businessFound
     *
     * @return boolean 
     */
    public function getBusinessFound()
    {
        return $this->businessFound;
    }

    /**
     * Set overwrittenColumns
     *
     * @param array $overwrittenColumns
     * @return Semsoft
     */
    public function setOverwrittenColumns($overwrittenColumns)
    {
        $this->overwrittenColumns = $overwrittenColumns;

        return $this;
    }

    /**
     * Get overwrittenColumns
     *
     * @return array 
     */
    public function getOverwrittenColumns()
    {
        return $this->overwrittenColumns;
    }

    /**
     * Set updatedColumns
     *
     * @param array $updatedColumns
     * @return Semsoft
     */
    public function setUpdatedColumns($updatedColumns)
    {
        $this->updatedColumns = $updatedColumns;

        return $this;
    }

    /**
     * Get updatedColumns
     *
     * @return array
     */
    public function getUpdatedColumns()
    {
        return $this->updatedColumns;
    }

    /**
     * Set county
     *
     * @param string $county
     * @return SemsoftBars
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
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->openings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set city
     *
     * @param \WBB\CoreBundle\Entity\City $city
     * @return SemsoftBars
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
     * Set suburb
     *
     * @param \WBB\CoreBundle\Entity\CitySuburb $suburb
     * @return SemsoftBars
     */
    public function setSuburb(\WBB\CoreBundle\Entity\CitySuburb $suburb = null)
    {
        $this->suburb = $suburb;

        return $this;
    }

    /**
     * Get suburb
     *
     * @return \WBB\CoreBundle\Entity\CitySuburb 
     */
    public function getSuburb()
    {
        return $this->suburb;
    }

    /**
     * Add tags
     *
     * @param \WBB\BarBundle\Entity\Collections\BarTag $tags
     * @return SemsoftBars
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
     * Add openings
     *
     * @param \WBB\BarBundle\Entity\BarOpening $openings
     * @return SemsoftBars
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
     * Set address
     *
     * @param string $address
     * @return SemsoftBar
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
     * Set foursquareID
     *
     * @param string $foursquareID
     * @return SemsoftBar
     */
    public function setFoursquareID($foursquareID)
    {
        $this->foursquareID = $foursquareID;

        return $this;
    }

    /**
     * Get foursquareID
     *
     * @return string 
     */
    public function getFoursquareID()
    {
        return $this->foursquareID;
    }

    /**
     * Set foursquareUserPage
     *
     * @param string $foursquareUserPage
     * @return SemsoftBar
     */
    public function setFoursquareUserPage($foursquareUserPage)
    {
        $this->foursquareUserPage = $foursquareUserPage;

        return $this;
    }

    /**
     * Get foursquareUserPage
     *
     * @return string 
     */
    public function getFoursquareUserPage()
    {
        return $this->foursquareUserPage;
    }

    /**
     * Set foursquareTips
     *
     * @param integer $foursquareTips
     * @return SemsoftBar
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
     * Set country
     *
     * @param \WBB\CoreBundle\Entity\Country $country
     * @return SemsoftBar
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
}
