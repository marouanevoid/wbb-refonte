<?php

namespace WBB\BarBundle\Entity\Collections;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * BarTag
 *
 * @ORM\Table(name="wbb_bar_tag")
 * @ORM\Entity(repositoryClass="WBB\BarBundle\Repository\BarTagRepository")
 */
class BarTag
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
     * @ORM\ManyToOne(targetEntity="WBB\BarBundle\Entity\Bar", inversedBy="tags")
     */
    private $bar;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\BarBundle\Entity\Tag", inversedBy="bars")
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

    /**
     * Set bar
     *
     * @param \WBB\BarBundle\Entity\Bar $bar
     * @return BarMedia
     */
    public function setBar(\WBB\BarBundle\Entity\Bar $bar = null)
    {
        $this->bar = $bar;

        return $this;
    }

    /**
     * Get bar
     *
     * @return \WBB\BarBundle\Entity\Bar
     */
    public function getBar()
    {
        return $this->bar;
    }

    public function __toString()
    {
        return $this->tag->getName();
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
}
