<?php

namespace WBB\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use WBB\BarBundle\Entity\BarMedia;

/**
 * Bar
 *
 * @ORM\Table(name="wbb_bar")
 * @ORM\Entity
 */
class Bar
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
     * @ORM\Column(name="latitude", type="string", length=20, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="langitude", type="string", length=20, nullable=true)
     */
    private $langitude;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

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
     * @ORM\Column(name="isCreditCard", type="boolean", nullable=true)
     */
    private $isCreditCard;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isCoatCheck", type="boolean", nullable=true)
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
     * @ORM\Column(name="isReservation", type="boolean", nullable=true)
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
     * @var boolean
     *
     * @ORM\Column(name="onTop", type="boolean", nullable=true)
     */
    private $onTop;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\UserBundle\Entity\User", inversedBy="bars")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\CoreBundle\Entity\City", inversedBy="bars")
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="BarMedia", mappedBy="bar", cascade={"persist"})
     */
    private $medias;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
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
     * Set langitude
     *
     * @param string $langitude
     * @return Bar
     */
    public function setLangitude($langitude)
    {
        $this->langitude = $langitude;

        return $this;
    }

    /**
     * Get langitude
     *
     * @return string 
     */
    public function getLangitude()
    {
        return $this->langitude;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Bar
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
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
        $this->reservation = $reservation;

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
     * @param \WBB\UserBundle\Entity\User $user
     * @return Bar
     */
    public function setUser(\WBB\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \WBB\UserBundle\Entity\User 
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
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param \WBB\CoreBundle\Entity\City $city
     * @return Bar
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

    public function __toString()
    {
        return $this->getName();
    }
}
