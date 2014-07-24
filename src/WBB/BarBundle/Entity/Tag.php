<?php

namespace WBB\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Tag
 *
 * @ORM\Table(name="wbb_tag")
 * @ORM\Entity(repositoryClass="WBB\BarBundle\Repository\TagRepository")
 */
class Tag
{
    const WBB_TAG_TYPE_SPECIAL_FEATURES = 1;
    const WBB_TAG_TYPE_THEME            = 2;
    const WBB_TAG_TYPE_BEST_COCKTAILS   = 3;
    const WBB_TAG_TYPE_WITH_WHO         = 4;
    const WBB_TAG_TYPE_ENERGY_LEVEL     = 5;
    const WBB_TAG_TYPE_DRINK_BRANDS     = 6;


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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_top", type="boolean", nullable=true)
     */
    private $onTop;

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
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Collections\BarTag", mappedBy="tag", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $bars;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Collections\BestOfTag", mappedBy="tag", cascade={"persist"}, orphanRemoval=true)
     */
    private $bestofs;

    /**
     * @ORM\OneToMany(targetEntity="Bar", mappedBy="energyLevel", cascade={"persist", "detach"}, orphanRemoval=true)
     */
    private $barsLevel;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Semsoft\SemsoftBar", mappedBy="energyLevel", cascade={"persist", "detach"}, orphanRemoval=true)
     */
    private $semsoftBarsLevel;

    /**
     * @ORM\ManyToMany(targetEntity="Bar", mappedBy="toGoWith")
     */
    private $barOccasions;

    /**
     * @ORM\OneToMany(targetEntity="BestOf", mappedBy="energyLevel", cascade={"persist", "detach"}, orphanRemoval=true)
     */
    private $bestofsLevel;

    /**
     * @ORM\ManyToMany(targetEntity="BestOf", mappedBy="toGoWith")
     */
    private $bestofOccasions;


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
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = ucfirst($name);

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
     * Set onTop
     *
     * @param boolean $onTop
     * @return Tag
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

    public function __construct(){
        $this->setOnTop(true);
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Tag
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
     * @return Tag
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

    public function __toString() {
        return $this->getName();
    }

    /**
     * Add bars
     *
     * @param \WBB\BarBundle\Entity\Collections\BarTag $bars
     * @return Tag
     */
    public function addBar(\WBB\BarBundle\Entity\Collections\BarTag $bars)
    {
        $this->bars[] = $bars;

        return $this;
    }

    /**
     * Remove bars
     *
     * @param \WBB\BarBundle\Entity\Collections\BarTag $bars
     */
    public function removeBar(\WBB\BarBundle\Entity\Collections\BarTag $bars)
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
     * Add bestofs
     *
     * @param \WBB\BarBundle\Entity\Collections\BestOfTag $bestofs
     * @return Tag
     */
    public function addBestof(\WBB\BarBundle\Entity\Collections\BestOfTag $bestofs)
    {
        $this->bestofs[] = $bestofs;

        return $this;
    }

    /**
     * Remove bestofs
     *
     * @param \WBB\BarBundle\Entity\Collections\BestOfTag $bestofs
     */
    public function removeBestof(\WBB\BarBundle\Entity\Collections\BestOfTag $bestofs)
    {
        $this->bestofs->removeElement($bestofs);
    }

    /**
     * Get bestofs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBestofs()
    {
        return $this->bestofs;
    }

    public static function getTypeNames(){
        return array(
            Tag::WBB_TAG_TYPE_SPECIAL_FEATURES  => 'Special Features',
            Tag::WBB_TAG_TYPE_THEME             => 'Style',
            Tag::WBB_TAG_TYPE_BEST_COCKTAILS    => 'Best Cocktails',
            Tag::WBB_TAG_TYPE_WITH_WHO          => 'With Who',
            Tag::WBB_TAG_TYPE_ENERGY_LEVEL      => 'Mood',
            Tag::WBB_TAG_TYPE_DRINK_BRANDS      => 'Drink Brands'
        );
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Tag
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

    /**
     * Add barsLevel
     *
     * @param \WBB\BarBundle\Entity\Bar $barsLevel
     * @return Tag
     */
    public function addBarsLevel(\WBB\BarBundle\Entity\Bar $barsLevel)
    {
        $this->barsLevel[] = $barsLevel;

        return $this;
    }

    /**
     * Remove barsLevel
     *
     * @param \WBB\BarBundle\Entity\Bar $barsLevel
     */
    public function removeBarsLevel(\WBB\BarBundle\Entity\Bar $barsLevel)
    {
        $this->barsLevel->removeElement($barsLevel);
    }

    /**
     * Get barsLevel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBarsLevel()
    {
        return $this->barsLevel;
    }

    /**
     * Add barOccasions
     *
     * @param \WBB\BarBundle\Entity\Bar $barOccasions
     * @return Tag
     */
    public function addBarOccasion(\WBB\BarBundle\Entity\Bar $barOccasions)
    {
        $this->barOccasions[] = $barOccasions;

        return $this;
    }

    /**
     * Remove barOccasions
     *
     * @param \WBB\BarBundle\Entity\Bar $barOccasions
     */
    public function removeBarOccasion(\WBB\BarBundle\Entity\Bar $barOccasions)
    {
        $this->barOccasions->removeElement($barOccasions);
    }

    /**
     * Get barOccasions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBarOccasions()
    {
        return $this->barOccasions;
    }

    /**
     * Add bestofsLevel
     *
     * @param \WBB\BarBundle\Entity\BestOf $bestofsLevel
     * @return Tag
     */
    public function addBestofsLevel(\WBB\BarBundle\Entity\BestOf $bestofsLevel)
    {
        $this->bestofsLevel[] = $bestofsLevel;

        return $this;
    }

    /**
     * Remove bestofsLevel
     *
     * @param \WBB\BarBundle\Entity\BestOf $bestofsLevel
     */
    public function removeBestofsLevel(\WBB\BarBundle\Entity\BestOf $bestofsLevel)
    {
        $this->bestofsLevel->removeElement($bestofsLevel);
    }

    /**
     * Get bestofsLevel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBestofsLevel()
    {
        return $this->bestofsLevel;
    }

    /**
     * Add bestofOccasions
     *
     * @param \WBB\BarBundle\Entity\BestOf $bestofOccasions
     * @return Tag
     */
    public function addBestofOccasion(\WBB\BarBundle\Entity\BestOf $bestofOccasions)
    {
        $this->bestofOccasions[] = $bestofOccasions;

        return $this;
    }

    /**
     * Remove bestofOccasions
     *
     * @param \WBB\BarBundle\Entity\BestOf $bestofOccasions
     */
    public function removeBestofOccasion(\WBB\BarBundle\Entity\BestOf $bestofOccasions)
    {
        $this->bestofOccasions->removeElement($bestofOccasions);
    }

    /**
     * Get bestofOccasions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBestofOccasions()
    {
        return $this->bestofOccasions;
    }

    /**
     * Add semsoftBarsLevel
     *
     * @param \WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBarsLevel
     * @return Tag
     */
    public function addSemsoftBarsLevel(\WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBarsLevel)
    {
        $this->semsoftBarsLevel[] = $semsoftBarsLevel;

        return $this;
    }

    /**
     * Remove semsoftBarsLevel
     *
     * @param \WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBarsLevel
     */
    public function removeSemsoftBarsLevel(\WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBarsLevel)
    {
        $this->semsoftBarsLevel->removeElement($semsoftBarsLevel);
    }

    /**
     * Get semsoftBarsLevel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSemsoftBarsLevel()
    {
        return $this->semsoftBarsLevel;
    }
}
