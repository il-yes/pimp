<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Workshop
 *
 * @ORM\Table(name="prod_workshop")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\WorkshopRepository")
 */
class Workshop
{
    const SMALL = 'small';

    const CLASSIC = 'classic';

    const LARGE = 'large';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
    @var string
     *
     * @ORM\Column(name="capacity", type="string", length=100)
     */
    private $capacity;

    /**
     * @var boolean
     * @ORM\Column(name="is_available", type="boolean")
     */
    private $isAvailable;

    /**
     * @ORM\OneToMany(targetEntity="PrestationBundle\Entity\Activity", mappedBy="workshop", cascade={"persist"})
     */
    private $activities;


    /**
     * Workshop constructor.
     * @param string $name
     * @param string $activity
     * @param string $capacity
     */
    public function __construct($name, $activity, $capacity, $isAvailable = false)
    {
        $this->name = $name;
        $this->activity = $activity;
        $this->setCapacity($capacity);
        $this->isAvailable = $isAvailable;
    }

    /**
     * Set capacity
     *
     * @param string $capacity
     *
     * @return Workshop
     */
    public function setCapacity($capacity)
    {
        $capacity = strtolower($capacity);

        switch ($capacity)
        {
            case 'small' :
                $this->capacity = self::SMALL;
                break;

            case 'classic' :
                $this->capacity = self::CLASSIC;
                break;

            case 'large' :
                $this->capacity = self::LARGE;
                break;
            default :
                $this->capacity = self::CLASSIC;
        }

        return $this;
    }

    /**
     * Get capacity
     *
     * @return string
     */
    public function getCapacity()
    {
        return $this->capacity;
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
     * @param string $name
     *
     * @return Workshop
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
     * Set isAvailable
     *
     * @param boolean $isAvailable
     *
     * @return Workshop
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    /**
     * Get isAvailable
     *
     * @return boolean
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;

        return $this;
    }

    /**
     * Set activities
     *
     * @param \PrestationBundle\Entity\Activity $activities
     *
     * @return Workshop
     */
    public function setActivities(\PrestationBundle\Entity\Activity $activities = null)
    {
        $this->activities = $activities;

        return $this;
    }

    /**
     * Get activities
     *
     * @return \PrestationBundle\Entity\Activity
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * Add activity
     *
     * @param \PrestationBundle\Entity\Activity $activity
     *
     * @return Workshop
     */
    public function addActivity($activity)
    {
        if ($activity != null && $activity instanceof \PrestationBundle\Entity\Activity)
        {
            $this->activities[] = $activity;
        }

        return $this;
    }

    /**
     * Remove activity
     *
     * @param \PrestationBundle\Entity\Activity $activity
     */
    public function removeActivity(\PrestationBundle\Entity\Activity $activity)
    {
        $this->activities->removeElement($activity);
    }
}
