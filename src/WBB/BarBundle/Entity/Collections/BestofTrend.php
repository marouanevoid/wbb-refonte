<?php

namespace WBB\BarBundle\Entity\Collections;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * BarTrend
 *
 * @ORM\Table(name="wbb_bestof_trend")
 * @ORM\Entity
 */
class BestofTrend
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
     * @var integer
     *
     * @ORM\Column(name="position", type="smallint", nullable=true)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\BarBundle\Entity\Bestof", inversedBy="trends")
     */
    private $bestof;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\BarBundle\Entity\Trend")
     */
    private $trend;

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
     * Set position
     *
     * @param integer $position
     * @return BarMedia
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    public function __toString()
    {
        return $this->trend->getName();
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return BarMedia
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
     * @return BarMedia
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
     * Set trend
     *
     * @param \WBB\BarBundle\Entity\Trend $trend
     * @return BarTrend
     */
    public function setTrend(\WBB\BarBundle\Entity\Trend $trend = null)
    {
        $this->trend = $trend;

        return $this;
    }

    /**
     * Get trend
     *
     * @return \WBB\BarBundle\Entity\Trend 
     */
    public function getTrend()
    {
        return $this->trend;
    }

    /**
     * Set bestof
     *
     * @param \WBB\BarBundle\Entity\Bestof $bestof
     * @return BestofTrend
     */
    public function setBestof(\WBB\BarBundle\Entity\Bestof $bestof = null)
    {
        $this->bestof = $bestof;

        return $this;
    }

    /**
     * Get bestof
     *
     * @return \WBB\BarBundle\Entity\Bestof
     */
    public function getBestof()
    {
        return $this->bestof;
    }
}
