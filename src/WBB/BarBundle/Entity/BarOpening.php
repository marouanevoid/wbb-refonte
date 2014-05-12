<?php

namespace WBB\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use WBB\BarBundle\Entity\Bar;

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
     * @ORM\Column(name="fromHour", type="smallint")
     */
    private $fromHour;

    /**
     * @var integer
     *
     * @ORM\Column(name="toHour", type="smallint")
     */
    private $toHour;

    /**
     * @ORM\ManyToOne(targetEntity="Bar", inversedBy="openings")
     */
    private $bar;


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
     * @param integer $day
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
     * @param integer $fromHour
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
     * @param integer $toHour
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
        for($i=0;$i<25;$i++)
        {
            if($i<10)
                $hours[$i] = "0$i";
            else
                $hours[$i] = "$i";
        }

        return $hours;
    }

    public static function getOpeningDays()
    {
        $days = array();
        for($i=1;$i<8;$i++)
        {
            $days[$i] = "Day $i";
        }

        return $days;
    }

    /**
     * Set bar
     *
     * @param Bar $bar
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
}
