<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Workshop
 *
 * @ORM\Table(name="workshop")
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
     * @ORM\OneToMany(targetEntity="PrestationBundle\Entity\Prestation", mappedBy="workshop", cascade={"persist"})
     */
    private $prestation;

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

        if ($isAvailable)
        {
            $this->isAvailable = true;
        }
    }


    /**
     * Get id
     *
     * @return int
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
     * Set activity
     *
     * @param string $activity
     *
     * @return Workshop
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return string
     */
    public function getActivity()
    {
        return $this->activity;
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
     * @return bool
     */
    public function isAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * @param bool $isAvailable
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;
    }

}
