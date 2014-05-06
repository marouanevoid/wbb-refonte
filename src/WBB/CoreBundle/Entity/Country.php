<?php

namespace WBB\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="wbb_country")
 * @ORM\Entity
 */
class Country
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
     * @ORM\OneToMany(targetEntity="City", mappedBy="country", cascade={"persist"})
     */
    private $cities;


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
     * @return Country
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
     * Constructor
     */
    public function __construct()
    {
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cities
     *
     * @param \WBB\CoreBundle\Entity\City $cities
     * @return Country
     */
    public function addCity(\WBB\CoreBundle\Entity\City $cities)
    {
        $this->cities[] = $cities;

        return $this;
    }

    /**
     * Remove cities
     *
     * @param \WBB\CoreBundle\Entity\City $cities
     */
    public function removeCity(\WBB\CoreBundle\Entity\City $cities)
    {
        $this->cities->removeElement($cities);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCities()
    {
        return $this->cities;
    }
}
