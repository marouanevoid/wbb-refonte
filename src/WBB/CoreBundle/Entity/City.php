<?php

namespace WBB\CoreBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use WBB\BarBundle\Entity\Bar;
use WBB\BarBundle\Entity\News;
use WBB\BarBundle\Entity\Semsoft\SemsoftBar;
use WBB\CloudSearchBundle\Indexer\IndexableEntity;
use WBB\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * City
 *
 * @ORM\Table(name="wbb_city")
 * @ORM\Entity(repositoryClass="WBB\CoreBundle\Repository\CityRepository")
 * @Vich\Uploadable
 */
class City implements IndexableEntity
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
     * @var decimal
     *
     * @ORM\Column(name="latitude", type="decimal", scale=8, nullable=true)
     */
    private $latitude;

    /**
     * @var decimal
     *
     * @ORM\Column(name="longitude", type="decimal", scale=8, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="text", nullable=true)
     */
    private $seoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=10, nullable=true)
     */
    private $postalCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_top", type="boolean", nullable=true)
     */
    private $onTopCity;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="cities")
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="CitySuburb", mappedBy="city", cascade={"all"})
     */
    private $suburbs;

    /**
     * @ORM\OneToMany(targetEntity="WBB\UserBundle\Entity\User", mappedBy="prefStartCity", cascade={"persist"})
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Bar", mappedBy="city", cascade={"all"})
     */
    private $bars;

    /**
     * @ORM\OneToMany(targetEntity="WBB\BarBundle\Entity\Semsoft\SemsoftBar", mappedBy="city", cascade={"all"})
     */
    private $semsoftBars;

    /**
     * @ORM\OneToMany(targetEntity="WBB\CoreBundle\Entity\CityBestOf", mappedBy="city", cascade={"all"})
     */
    private $bestofs;

    /**
     * @ORM\ManyToMany(targetEntity="WBB\BarBundle\Entity\News", inversedBy="cities", cascade={"all"})
     * @ORM\JoinTable(name="wbb_news_cities",
     *      joinColumns={@ORM\JoinColumn(name="city_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="news_id", referencedColumnName="id")}
     *      )
     **/
    private $news;

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
     * @Vich\UploadableField(mapping="city_image", fileNameProperty="imageName")
     *
     * @var File $imageFile
     */
    protected $imageFile;

    /**
     * @ORM\Column(type="string", length=255, name="image_name", nullable=true)
     *
     * @var string $imageName
     */
    protected $imageName;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
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
     * Set name
     *
     * @param  string $name
     * @return City
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
     * Set latitude
     *
     * @param  string $latitude
     * @return City
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
     * @param  string $longitude
     * @return City
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

    /**
     * Set seoDescription
     *
     * @param  string $seoDescription
     * @return City
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * Set onTopCity
     *
     * @param  boolean $onTopCity
     * @return City
     */
    public function setOnTopCity($onTopCity)
    {
        $this->onTopCity = $onTopCity;

        return $this;
    }

    /**
     * Get onTopCity
     *
     * @return boolean
     */
    public function getOnTopCity()
    {
        return $this->onTopCity;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->suburbs = new ArrayCollection();
        $this->news    = new ArrayCollection();
        $this->bars    = new ArrayCollection();
    }

    /**
     * Set country
     *
     * @param  Country $country
     * @return City
     */
    public function setCountry(Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add suburb
     *
     * @param  CitySuburb $suburb
     * @return City
     */
    public function addSuburb(CitySuburb $suburb)
    {
        $this->suburbs[] = $suburb;
        $suburb->setCity($this);

        return $this;
    }

    /**
     * Remove suburbs
     *
     * @param CitySuburb $suburbs
     */
    public function removeSuburb(CitySuburb $suburbs)
    {
        $this->suburbs->removeElement($suburbs);
    }

    /**
     * Get suburbs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSuburbs()
    {
        return $this->suburbs;
    }

    /**
     * Add bar
     *
     * @param  Bar  $bar
     * @return City
     */
    public function addBar(Bar $bar)
    {
        $this->bars[] = $bar;
        $bar->setCity($this);

        return $this;
    }

    /**
     * Remove bars
     *
     * @param Bar $bars
     */
    public function removeBar(Bar $bars)
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

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return City
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
     * @param  \DateTime $updatedAt
     * @return City
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
     * Add bestofs
     *
     * @param  CityBestOf $bestofs
     * @return City
     */
    public function addBestof(CityBestOf $bestofs)
    {
        $this->bestofs[] = $bestofs;

        return $this;
    }

    /**
     * Remove bestofs
     *
     * @param CityBestOf $bestofs
     */
    public function removeBestof(CityBestOf $bestofs)
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

    /**
     * Set slug
     *
     * @param  string $slug
     * @return City
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
     * Add users
     *
     * @param  User $users
     * @return City
     */
    public function addUser(User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param User $users
     */
    public function removeUser(User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function getNbBars()
    {
        return count($this->getBars());
    }

    public function getNbNews()
    {
        return count($this->news);
    }

    public function getNbAreas()
    {
        return count($this->getSuburbs());
    }

    /**
     * Add semsoftBars
     *
     * @param  SemsoftBar $semsoftBars
     * @return City
     */
    public function addSemsoftBar(SemsoftBar $semsoftBars)
    {
        $this->semsoftBars[] = $semsoftBars;

        return $this;
    }

    /**
     * Remove semsoftBars
     *
     * @param SemsoftBar $semsoftBars
     */
    public function removeSemsoftBar(SemsoftBar $semsoftBars)
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

    /**
     * Add news
     *
     * @param  News $news
     * @return City
     */
    public function addNews(News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param News $news
     */
    public function removeNews(News $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Add userHomes
     *
     * @param  User $userHomes
     * @return City
     */
    public function addUserHome(User $userHomes)
    {
        $this->userHomes[] = $userHomes;

        return $this;
    }

    /**
     * Remove userHomes
     *
     * @param User $userHomes
     */
    public function removeUserHome(User $userHomes)
    {
        $this->userHomes->removeElement($userHomes);
    }

    /**
     * Get userHomes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserHomes()
    {
        return $this->userHomes;
    }

    /**
     * Add userCities1
     *
     * @param  User $userCities1
     * @return City
     */
    public function addUserCities1(User $userCities1)
    {
        $this->userCities1[] = $userCities1;

        return $this;
    }

    /**
     * Remove userCities1
     *
     * @param User $userCities1
     */
    public function removeUserCities1(User $userCities1)
    {
        $this->userCities1->removeElement($userCities1);
    }

    /**
     * Get userCities1
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserCities1()
    {
        return $this->userCities1;
    }

    /**
     * Add userCities2
     *
     * @param  User $userCities2
     * @return City
     */
    public function addUserCities2(User $userCities2)
    {
        $this->userCities2[] = $userCities2;

        return $this;
    }

    /**
     * Remove userCities2
     *
     * @param User $userCities2
     */
    public function removeUserCities2(User $userCities2)
    {
        $this->userCities2->removeElement($userCities2);
    }

    /**
     * Get userCities2
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserCities2()
    {
        return $this->userCities2;
    }

    public function getCloudSearchFields()
    {
        $countryName = ($this->country) ? $this->country->getName() : '';
        $lat = ($this->latitude) ? $this->latitude : 0;
        $lon = ($this->longitude) ? $this->longitude : 0;
        $suburbs = array();

        foreach ($this->getSuburbs() as $suburb) {
            $suburbs[] = $suburb->getName();
        }

        return array(
            'name' => $this->name,
            'slug' => $this->slug,
            'wbb_id' => $this->id,
            'country' => $countryName,
            'location' => $lat . ',' . $lon,
            'districts' => $suburbs
        );
    }

    /**
     * Set postalCode
     *
     * @param  string $postalCode
     * @return City
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function isUSCity()
    {
        if ($this->getCountry()->getAcronym() == 'US') {
            return true;
        } else {
            return false;
        }
    }

}
