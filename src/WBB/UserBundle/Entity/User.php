<?php

namespace WBB\UserBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;
use WBB\BarBundle\Entity\Bar;
use WBB\BarBundle\Entity\BestOf;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="WBB\UserBundle\Repository\UserRepository")
 * @ORM\Table(name="wbb_user")
 * @JMS\ExclusionPolicy("all")
 * @UniqueEntity("facebookId", message="This facebook account is already used", groups={"registration_fb"})
 * @UniqueEntity("username", message="Sorry, this username has already been taken", groups={"profile_light"})
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=4, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=45, nullable=true)
     * @Assert\NotBlank(message="not.blank", groups={"registration_full"})
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=45, nullable=true)
     * @Assert\NotBlank(message="not.blank", groups={"registration_full"})
     */
    private $lastname;

    /**
     * @var date
     *
     * @ORM\Column(name="birthdate", type="date", nullable=true)
     * @Assert\NotBlank(message="not.blank")
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
     */
    private $facebookId;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="facebook_picture", type="string", nullable=true)
     */
    private $facebookPicture;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

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
     * @ORM\Column(name="pref_when", type="time", nullable=true)
     */
    private $prefWhen;

    /**
     * @var string
     *
     * @ORM\Column(name="pref_home", type="string", length=255, nullable=true)
     */
    private $prefHome;

    /**
     * @var string
     *
     * @ORM\Column(name="pref_city1", type="string", length=255, nullable=true)
     */
    private $prefCity1;

    /**
     * @var string
     *
     * @ORM\Column(name="pref_city2", type="string", length=255, nullable=true)
     */
    private $prefCity2;

    /**
     * @var string
     *
     * @ORM\Column(name="pref_city3", type="string", length=255, nullable=true)
     */
    private $prefCity3;

    /**
     * @var string
     *
     * @ORM\Column(name="pref_bar1", type="string", length=255, nullable=true)
     */
    private $prefBar1;

    /**
     * @var string
     *
     * @ORM\Column(name="pref_bar2", type="string", length=255, nullable=true)
     */
    private $prefBar2;

    /**
     * @var string
     *
     * @ORM\Column(name="pref_bar3", type="string", length=255, nullable=true)
     */
    private $prefBar3;

    /**
     * @var string
     *
     * @ORM\Column(name="pref_drink_brand_1", type="string", length=255, nullable=true)
     */
    private $prefDrinkBrand1;

    /**
     * @var string
     *
     * @ORM\Column(name="pref_drink_brand_2", type="string", length=255, nullable=true)
     */
    private $prefDrinkBrand2;

    /**
     * @var string
     *
     * @ORM\Column(name="pref_drink_brand_3", type="string", length=255, nullable=true)
     */
    private $prefDrinkBrand3;

    /**
     * @var string
     *
     * @ORM\Column(name="pref_cocktails_1", type="string", length=255, nullable=true)
     */
    private $prefCocktails1;

    /**
     * @var string
     *
     * @ORM\Column(name="pref_cocktails_2", type="string", length=255, nullable=true)
     */
    private $prefCocktails2;

    /**
     * @var string
     *
     * @ORM\Column(name="pref_cocktails_3", type="string", length=255, nullable=true)
     */
    private $prefCocktails3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="stay_informed", type="boolean", nullable=true)
     */
    private $stayInformed;

    /**
     * @var boolean
     *
     * @ORM\Column(name="stay_brand_informed", type="boolean", nullable=true)
     */
    private $stayBrandInformed;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\CoreBundle\Entity\City", inversedBy="users")
     * @ORM\JoinColumn(name="pref_city_id_start", referencedColumnName="id")
     */
    private $prefStartCity;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\CoreBundle\Entity\Country", inversedBy="users")
     * @Assert\NotBlank(message="not.blank", groups={"registration_full", "Registration", "Profile"})
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Bar", mappedBy="user")
     */
    private $bars;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Tip", mappedBy="user")
     */
    private $tips;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\News", mappedBy="user")
     */
    private $news;

    /**
     * @ORM\ManyToMany(targetEntity="WBB\BarBundle\Entity\Bar", inversedBy="usersFavorite")
     * @ORM\JoinTable(name="wbb_user_favorite_bars")
     */
    private $favoriteBars;

    /**
     * @ORM\ManyToMany(targetEntity="WBB\BarBundle\Entity\BestOf", inversedBy="usersFavorite")
     * @ORM\JoinTable(name="wbb_user_favorite_bestof")
     */
    private $favoriteBestOfs;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tips_should_be_moderated", type="boolean", nullable=true)
     */
    private $tipsShouldBeModerated;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="confirmed", type="boolean", nullable=true)
     */
    private $confirmed;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
    private $avatar;

    /**
     * @var datetime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var datetime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    public function serialize()
    {
        return serialize(array($this->facebookId, parent::serialize()));
    }

    public function unserialize($data)
    {
        list($this->facebookId, $parentData) = unserialize($data);
        parent::unserialize($parentData);
    }

    public function __construct()
    {
        parent::__construct();
        $this->setEnabled(true);
        $this->setStayInformed(true);
        $this->tipsShouldBeModerated = true;
        $this->favoriteBars = new ArrayCollection();
        $this->favoriteBestOfs = new ArrayCollection();
        $this->facebookId = null;
        $this->facebookPicture = null;
        $this->confirmed = false;
    }

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
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
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
     * @return User
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
     * Add bars
     *
     * @param Bar $bars
     * @return User
     */
    public function addBar(Bar $bars)
    {
        $this->bars[] = $bars;

        return $this;
    }

    /**
     * Remove bars
     *
     * @param Bar $bar
     */
    public function removeBar(Bar $bar)
    {
        $this->bars->removeElement($bar);
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
     * Add tips
     *
     * @param \WBB\BarBundle\Entity\Tip $tips
     * @return User
     */
    public function addTip(\WBB\BarBundle\Entity\Tip $tips){
        $this->tips[] = $tips;
        return $this;
    }

    /**
     * Remove tips
     *
     * @param \WBB\BarBundle\Entity\Tip $tips
     */
    public function removeTip(\WBB\BarBundle\Entity\Tip $tips){
        $this->tips->removeElement($tips);
    }

    /**
     * Get tips
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTips(){
        return $this->tips;
    }

    /**
     * Add news
     *
     * @param \WBB\BarBundle\Entity\News $news
     * @return User
     */
    public function addNews(\WBB\BarBundle\Entity\News $news){
        $this->news[] = $news;
        return $this;
    }

    /**
     * Remove news
     *
     * @param \WBB\BarBundle\Entity\News $news
     */
    public function removeNews(\WBB\BarBundle\Entity\News $news){
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNews(){
        return $this->news;
    }    

    /**
     * Set website
     *
     * @param string $website
     * @return User
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
     * Set description
     *
     * @param string $description
     * @return User
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
     * @return User
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
     * @return User
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

    public function getUserRole()
    {
        $roles = $this->getRoles();
        if(in_array('ROLE_SUPER_ADMIN',$roles)){
            return 'Super Admin';
        }elseif(in_array('ROLE_MODERATOR',$roles)){
            return 'Moderator';
        }elseif(in_array('ROLE_PUBLISHER', $roles)){
            return 'Publisher';
        }elseif(in_array('ROLE_EDITORIAL_EXPERT',$roles)){
            return 'Editorial Expert';
        }elseif(in_array('ROLE_BAR_EXPERT',$roles)){
            return 'Bar Expert';
        }elseif(in_array('ROLE_BAR_OWNER',$roles)){
            return 'Bar Owner';
        }else{
            return 'User';
        }
    }


    /**
     * @JMS\VirtualProperty
     */
    public function getFullName()
    {
        return $this->getFirstname().' '.$this->getLastname();
    }

    /**
     * Set title
     *
     * @param string $title
     * @return User
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set prefWhen
     *
     * @param \DateTime $prefWhen
     * @return User
     */
    public function setPrefWhen($prefWhen)
    {
        $this->prefWhen = $prefWhen;

        return $this;
    }

    /**
     * Get prefWhen
     *
     * @return \DateTime 
     */
    public function getPrefWhen()
    {
        return $this->prefWhen;
    }

    /**
     * Set prefHome
     *
     * @param string $prefHome
     * @return User
     */
    public function setPrefHome($prefHome)
    {
        $this->prefHome = $prefHome;

        return $this;
    }

    /**
     * Get prefHome
     *
     * @return string 
     */
    public function getPrefHome()
    {
        return $this->prefHome;
    }

    /**
     * Set prefStartCity
     *
     * @param \WBB\CoreBundle\Entity\City $prefStartCity
     * @return User
     */
    public function setPrefStartCity(\WBB\CoreBundle\Entity\City $prefStartCity = null)
    {
        $this->prefStartCity = $prefStartCity;

        return $this;
    }

    /**
     * Get prefStartCity
     *
     * @return \WBB\CoreBundle\Entity\City 
     */
    public function getPrefStartCity()
    {
        return $this->prefStartCity;
    }

    /**
     * Set stayInformed
     *
     * @param boolean $stayInformed
     * @return User
     */
    public function setStayInformed($stayInformed)
    {
        $this->stayInformed = $stayInformed;

        return $this;
    }

    /**
     * Get stayInformed
     *
     * @return boolean 
     */
    public function getStayInformed()
    {
        return $this->stayInformed;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime 
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set country
     *
     * @param \WBB\CoreBundle\Entity\Country $country
     * @return User
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

    /**
     * Set prefCity1
     *
     * @param string $prefCity1
     * @return User
     */
    public function setPrefCity1($prefCity1)
    {
        $this->prefCity1 = $prefCity1;

        return $this;
    }

    /**
     * Get prefCity1
     *
     * @return string 
     */
    public function getPrefCity1()
    {
        return $this->prefCity1;
    }

    /**
     * Set prefCity2
     *
     * @param string $prefCity2
     * @return User
     */
    public function setPrefCity2($prefCity2)
    {
        $this->prefCity2 = $prefCity2;

        return $this;
    }

    /**
     * Get prefCity2
     *
     * @return string 
     */
    public function getPrefCity2()
    {
        return $this->prefCity2;
    }

    /**
     * Set prefCity3
     *
     * @param string $prefCity3
     * @return User
     */
    public function setPrefCity3($prefCity3)
    {
        $this->prefCity3 = $prefCity3;

        return $this;
    }

    /**
     * Get prefCity3
     *
     * @return string 
     */
    public function getPrefCity3()
    {
        return $this->prefCity3;
    }

    /**
     * Set prefBar1
     *
     * @param string $prefBar1
     * @return User
     */
    public function setPrefBar1($prefBar1)
    {
        $this->prefBar1 = $prefBar1;

        return $this;
    }

    /**
     * Get prefBar1
     *
     * @return string 
     */
    public function getPrefBar1()
    {
        return $this->prefBar1;
    }

    /**
     * Set prefBar2
     *
     * @param string $prefBar2
     * @return User
     */
    public function setPrefBar2($prefBar2)
    {
        $this->prefBar2 = $prefBar2;

        return $this;
    }

    /**
     * Get prefBar2
     *
     * @return string 
     */
    public function getPrefBar2()
    {
        return $this->prefBar2;
    }

    /**
     * Set prefBar3
     *
     * @param string $prefBar3
     * @return User
     */
    public function setPrefBar3($prefBar3)
    {
        $this->prefBar3 = $prefBar3;

        return $this;
    }

    /**
     * Get prefBar3
     *
     * @return string 
     */
    public function getPrefBar3()
    {
        return $this->prefBar3;
    }

    /**
     * Set prefDrinkBrand1
     *
     * @param string $prefDrinkBrand1
     * @return User
     */
    public function setPrefDrinkBrand1($prefDrinkBrand1)
    {
        $this->prefDrinkBrand1 = $prefDrinkBrand1;

        return $this;
    }

    /**
     * Get prefDrinkBrand1
     *
     * @return string 
     */
    public function getPrefDrinkBrand1()
    {
        return $this->prefDrinkBrand1;
    }

    /**
     * Set prefDrinkBrand2
     *
     * @param string $prefDrinkBrand2
     * @return User
     */
    public function setPrefDrinkBrand2($prefDrinkBrand2)
    {
        $this->prefDrinkBrand2 = $prefDrinkBrand2;

        return $this;
    }

    /**
     * Get prefDrinkBrand2
     *
     * @return string 
     */
    public function getPrefDrinkBrand2()
    {
        return $this->prefDrinkBrand2;
    }

    /**
     * Set prefDrinkBrand3
     *
     * @param string $prefDrinkBrand3
     * @return User
     */
    public function setPrefDrinkBrand3($prefDrinkBrand3)
    {
        $this->prefDrinkBrand3 = $prefDrinkBrand3;

        return $this;
    }

    /**
     * Get prefDrinkBrand3
     *
     * @return string 
     */
    public function getPrefDrinkBrand3()
    {
        return $this->prefDrinkBrand3;
    }

    /**
     * Set prefCocktails1
     *
     * @param string $prefCocktails1
     * @return User
     */
    public function setPrefCocktails1($prefCocktails1)
    {
        $this->prefCocktails1 = $prefCocktails1;

        return $this;
    }

    /**
     * Get prefCocktails1
     *
     * @return string 
     */
    public function getPrefCocktails1()
    {
        return $this->prefCocktails1;
    }

    /**
     * Set prefCocktails2
     *
     * @param string $prefCocktails2
     * @return User
     */
    public function setPrefCocktails2($prefCocktails2)
    {
        $this->prefCocktails2 = $prefCocktails2;

        return $this;
    }

    /**
     * Get prefCocktails2
     *
     * @return string 
     */
    public function getPrefCocktails2()
    {
        return $this->prefCocktails2;
    }

    /**
     * Set prefCocktails3
     *
     * @param string $prefCocktails3
     * @return User
     */
    public function setPrefCocktails3($prefCocktails3)
    {
        $this->prefCocktails3 = $prefCocktails3;

        return $this;
    }

    /**
     * Get prefCocktails3
     *
     * @return string 
     */
    public function getPrefCocktails3()
    {
        return $this->prefCocktails3;
    }
    
    /**
     * @param string $facebookId
     * @return void
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        $this->setUsername($facebookId);
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param Array
     */
    public function setFBData($fbdata)
    {
        if (isset($fbdata['id'])) {
            $this->setFacebookId($fbdata['id']);
        }
        if (isset($fbdata['picture'])) {
            $this->setFacebookPicture($fbdata['picture']);
        }
    }

    /**
     * Add favoriteBars
     *
     * @param Bar $favoriteBars
     * @return User
     */
    public function addFavoriteBar(Bar $favoriteBars)
    {
        $this->favoriteBars[] = $favoriteBars;
        return $this;
    }

    /**
     * Set stayBrandInformed
     *
     * @param boolean $stayBrandInformed
     * @return User
     */
    public function setStayBrandInformed($stayBrandInformed)
    {
        $this->stayBrandInformed = $stayBrandInformed;
        return $this;
    }

    /**
     * Remove favoriteBars
     *
     * @param Bar $favoriteBars
     */
    public function removeFavoriteBar(Bar $favoriteBars)
    {
        $this->favoriteBars->removeElement($favoriteBars);
    }

    /**
     * Get favoriteBars
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFavoriteBars()
    {
        return $this->favoriteBars;
    }

    /**
     * Add favoriteBestOfs
     *
     * @param BestOf $favoriteBestOfs
     * @return User
     */
    public function addFavoriteBestOf(BestOf $favoriteBestOfs)
    {
        $this->favoriteBestOfs[] = $favoriteBestOfs;

        return $this;
    }

    /**
     * Remove favoriteBestOfs
     *
     * @param BestOf $favoriteBestOfs
     */
    public function removeFavoriteBestOf(BestOf $favoriteBestOfs)
    {
        $this->favoriteBestOfs->removeElement($favoriteBestOfs);
    }

    /**
     * Get favoriteBestOfs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFavoriteBestOfs()
    {
        return $this->favoriteBestOfs;
    }

    /**
     * Set tipsShouldBeModerated
     *
     * @param boolean $tipsShouldBeModerated
     * @return User
     */
    public function setTipsShouldBeModerated($tipsShouldBeModerated)
    {
        $this->tipsShouldBeModerated = $tipsShouldBeModerated;

        return $this;
    }

    /**
     * Get tipsShouldBeModerated
     *
     * @return boolean 
     */
    public function getTipsShouldBeModerated()
    {
        return $this->tipsShouldBeModerated;
    }

    /**
     * Get stayBrandInformed
     *
     * @return boolean 
     */
    public function getStayBrandInformed()
    {
        return $this->stayBrandInformed;
    }

    /**
     * Set avatar
     *
     * @param Media $avatar
     * @return User
     */
    public function setAvatar(Media $avatar = null)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return Media
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
    
    /**
     * @Assert\Callback()
     */
    public function validateBirthday(ExecutionContextInterface $context)
    {
        $country = $this->getCountry();
        if ($this->birthdate) {
            $age = $this->birthdate->diff(new \DateTime('now'))->y;
            if ($country) {
                $drinkingAge = $country->getDrinkingAge();
                if ($drinkingAge > $age) {
                    $context->addViolationAt('birthday', 'fos_user.birthday.legal');
                }
            }
        }
    }

    /**
     * @Assert\Callback()
     */
    public function validatePassword(ExecutionContextInterface $context)
    {
        if ($this->plainPassword) {
            if (strlen($this->plainPassword) < 6) {
                $context->addViolationAt('plainPassword', 'Please confirm a valid password (must contain at least 6 caracters, a number and a letter)');
            } else {
                $chars = str_split($this->plainPassword);
                $characterFound = false;
                $numberFound = false;
                foreach ($chars as $char) {
                    $asciiCode = ord($char);
                    if (!(($asciiCode >= 97 && $asciiCode <= 122) || ($asciiCode >= 65 && $asciiCode <= 90) || ($asciiCode >= 48 && $asciiCode <= 57))) {
                        $context->addViolationAt('plainPassword', 'Please confirm a valid password (must contain at least 6 caracters, a number and a letter)');
                        break;
                    }
                    if (($asciiCode >= 97 && $asciiCode <= 122) || ($asciiCode >= 65 && $asciiCode <= 90)) {
                        $characterFound = true;
                    }
                    if (($asciiCode >= 48 && $asciiCode <= 57)) {
                        $numberFound = true;
                    }
                }
                if (!$numberFound || !$characterFound) {
                    $context->addViolationAt('plainPassword', 'Please confirm a valid password (must contain at least 6 caracters, a number and a letter)');
                }
            }
        }
    }

    /**
     * Set facebookPicture
     *
     * @param string $facebookPicture
     * @return User
     */
    public function setFacebookPicture($facebookPicture)
    {
        $this->facebookPicture = $facebookPicture;

        return $this;
    }

    /**
     * Get facebookPicture
     *
     * @return string 
     */
    public function getFacebookPicture()
    {
        return $this->facebookPicture;
    }

    /**
     * Set confirmed
     *
     * @param boolean $confirmed
     * @return User
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Get confirmed
     *
     * @return boolean 
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }
}
