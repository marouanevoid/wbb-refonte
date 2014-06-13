<?php

namespace WBB\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="WBB\UserBundle\Repository\UserRepository")
 * @ORM\Table(name="wbb_user")
 * @JMS\ExclusionPolicy("all")
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
     * @ORM\Column(name="first_name", type="string", length=45, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=45, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

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

    public function __construct()
    {
        parent::__construct();
        $this->setEnabled(true);
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
     * @param \WBB\BarBundle\Entity\Bar $bars
     * @return User
     */
    public function addBar(\WBB\BarBundle\Entity\Bar $bars)
    {
        $this->bars[] = $bars;

        return $this;
    }

    /**
     * Remove bars
     *
     * @param \WBB\BarBundle\Entity\Bar $bars
     */
    public function removeBar(\WBB\BarBundle\Entity\Bar $bars)
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
}
