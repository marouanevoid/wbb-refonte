<?php

namespace WBB\BarBundle\Entity\Collections;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * BarTag
 *
 * @ORM\Table(name="wbb_bestof_tag")
 * @ORM\Entity
 */
class BestOfTag
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
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="smallint", nullable=true)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\BarBundle\Entity\BestOf", inversedBy="tags")
     */
    private $bestof;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\BarBundle\Entity\Tag", inversedBy="bestofs", fetch="EAGER")
     */
    private $tag;

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
        if ($this->tag)
            return $this->tag->getName();
        else
            return "";
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
     * Set tag
     *
     * @param \WBB\BarBundle\Entity\Tag $tag
     * @return BarTag
     */
    public function setTag(\WBB\BarBundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \WBB\BarBundle\Entity\Tag
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set bestof
     *
     * @param \WBB\BarBundle\Entity\BestOf $bestof
     * @return BestOfTag
     */
    public function setBestof(\WBB\BarBundle\Entity\BestOf $bestof = null)
    {
        $this->bestof = $bestof;

        return $this;
    }

    /**
     * Get bestof
     *
     * @return \WBB\BarBundle\Entity\BestOf
     */
    public function getBestof()
    {
        return $this->bestof;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return BestOfTag
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
