<?php

namespace WBB\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SemsoftBars
 */
class SemsoftBars
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $county;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $latitude;

    /**
     * @var string
     */
    private $longitude;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var integer
     */
    private $price;

    /**
     * @var boolean
     */
    private $isCreditCard;

    /**
     * @var string
     */
    private $seoDescription;

    /**
     * @var boolean
     */
    private $isOutDoorSeating;

    /**
     * @var boolean
     */
    private $isHappyHour;

    /**
     * @var boolean
     */
    private $isWiFi;

    /**
     * @var string
     */
    private $menu;

    /**
     * @var boolean
     */
    private $reservation;

    /**
     * @var string
     */
    private $parkingType;

    /**
     * @var string
     */
    private $facebookID;

    /**
     * @var string
     */
    private $facebookUserPage;

    /**
     * @var string
     */
    private $twitterName;

    /**
     * @var string
     */
    private $twitterUserPage;

    /**
     * @var string
     */
    private $instagramID;

    /**
     * @var string
     */
    private $instagramUserPage;

    /**
     * @var string
     */
    private $googlePlusUserPage;

    /**
     * @var integer
     */
    private $foursquareCheckIns;

    /**
     * @var integer
     */
    private $facebookCheckIns;

    /**
     * @var integer
     */
    private $foursquareLikes;

    /**
     * @var integer
     */
    private $facebookLikes;

    /**
     * @var boolean
     */
    private $isPermanentlyClosed;

    /**
     * @var boolean
     */
    private $businessFound;

    /**
     * @var array
     */
    private $updatedColumns;

    /**
     * @var array
     */
    private $overwrittenColumns;


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
     * @return SemsoftBars
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
     * Set postalCode
     *
     * @param string $postalCode
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * @return SemsoftBars
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
     * Set updatedColumns
     *
     * @param array $updatedColumns
     * @return SemsoftBars
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
     * Set overwrittenColumns
     *
     * @param array $overwrittenColumns
     * @return SemsoftBars
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
}
