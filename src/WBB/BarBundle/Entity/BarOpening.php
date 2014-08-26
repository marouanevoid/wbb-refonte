<?php

namespace WBB\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * BarOpening
 *
 * @ORM\Table(name="wbb_bar_opening")
 * @ORM\Entity
 */
class BarOpening
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
     * @ORM\Column(name="opening_day", type="smallint")
     */
    private $openingDay;

    /**
     * @var integer
     *
     * @ORM\Column(name="from_hour", type="smallint")
     */
    private $fromHour;

    /**
     * @var integer
     *
     * @ORM\Column(name="to_hour", type="smallint")
     */
    private $toHour;

    /**
     * @ORM\ManyToOne(targetEntity="Bar", inversedBy="openings")
     */
    private $bar;

    /**
     * @ORM\ManyToOne(targetEntity="WBB\BarBundle\Entity\Semsoft\SemsoftBar", inversedBy="openings")
     */
    private $semsoftBar;

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
     * Set day
     *
     * @param  integer    $day
     * @return BarOpening
     */
    public function setOpeningDay($day)
    {
        $this->openingDay = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer
     */
    public function getOpeningDay()
    {
        return $this->openingDay;
    }

    /**
     * Set fromHour
     *
     * @param  integer    $fromHour
     * @return BarOpening
     */
    public function setFromHour($fromHour)
    {
        $this->fromHour = $fromHour;

        return $this;
    }

    /**
     * Get fromHour
     *
     * @return integer
     */
    public function getFromHour()
    {
        return $this->fromHour;
    }

    /**
     * Set toHour
     *
     * @param  integer    $toHour
     * @return BarOpening
     */
    public function setToHour($toHour)
    {
        $this->toHour = $toHour;

        return $this;
    }

    /**
     * Get toHour
     *
     * @return integer
     */
    public function getToHour()
    {
        return $this->toHour;
    }

    public static function getOpeningHours()
    {
        $hours = array();
        for ($i=0;$i<24;$i++) {
            if($i<10)
                $hours[$i] = "0$i";
            else
                $hours[$i] = "$i";
        }

        return $hours;
    }

    public static function getOpeningDays()
    {
        $days = array(
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday'
        );

        return $days;
    }

    /**
     * Set bar
     *
     * @param  Bar        $bar
     * @return BarOpening
     */
    public function setBar(Bar $bar = null)
    {
        $this->bar = $bar;

        return $this;
    }

    /**
     * Get bar
     *
     * @return Bar
     */
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime  $createdAt
     * @return BarOpening
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
     * @param  \DateTime  $updatedAt
     * @return BarOpening
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
     * Set semsoftBar
     *
     * @param  \WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBar
     * @return BarOpening
     */
    public function setSemsoftBar(\WBB\BarBundle\Entity\Semsoft\SemsoftBar $semsoftBar = null)
    {
        $this->semsoftBar = $semsoftBar;

        return $this;
    }

    /**
     * Get semsoftBar
     *
     * @return \WBB\BarBundle\Entity\Semsoft\SemsoftBar
     */
    public function getSemsoftBar()
    {
        return $this->semsoftBar;
    }
}
