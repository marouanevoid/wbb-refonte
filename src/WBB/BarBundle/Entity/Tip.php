<?php

namespace WBB\BarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Tip
 *
 * @ORM\Table(name="wbb_tip")
 * @ORM\Entity
 */

class Tip {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\UserBundle\Entity\User", inversedBy="tips")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\BarBundle\Entity\Bar", inversedBy="tips")
     */
    private $bar;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint", nullable=true)
     */
    private $status;

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
     * Constructor
     */
    public function __construct(){

    }

    /**
     * toString
     */
    public function __toString(){
        return $this->getDescription();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return Tip
     */
    public function setUser($user){
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser(){
        return $this->user;
    }

    /**
     * Set bar
     *
     * @param Bar $bar
     * @return Tip
     */
    public function setBar($bar){
        $this->bar = $bar;
        return $this;
    }

    /**
     * Get bar
     *
     * @return Bar
     */
    public function getBar(){
        return $this->bar;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Tip
     */
    public function setDescription($description){
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(){
        return $this->description;
    }


    /**
     * Set status
     *
     * @param boolean $status
     * @return Tip
     */
    public function setStatus($status){
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Tip
     */
    public function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(){
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Tip
     */
    public function setUpdatedAt($updatedAt){
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt(){
        return $this->updatedAt;
    }

}
