<?php

namespace WBB\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CitySuburb
 *
 * @ORM\Table(name="wbb_city_suburb")
 * @ORM\Entity(repositoryClass="WBB\CoreBundle\Repository\SuburbRepository")
 */
class CitySuburb
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
     * @Gedmo\Slug(fields={"name"}, style="camel", separator="-")
     * @ORM\Column(unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="suburbs")
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Bar", mappedBy="suburb", cascade={"all"})
     */
    private $bars;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Semsoft\SemsoftBar", mappedBy="suburb", cascade={"all"})
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
     * @return CitySuburb
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
     * Set city
     *
     * @param \WBB\CoreBundle\Entity\City $city
     * @return CitySuburb
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bars = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add bars
     *
     * @param \WBB\BarBundle\Entity\Bar $bars
     * @return CitySuburb
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return CitySuburb
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
     * @return CitySuburb
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
     * Set slug
     *
     * @param string $slug
     * @return CitySuburb
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

    /**
     * Add semsoftBars
     *
     * @param \WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBars
     * @return CitySuburb
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
}
