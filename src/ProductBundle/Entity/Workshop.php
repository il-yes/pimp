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
    }

    /**
     * Add prestation
     *
     * @param \PrestationBundle\Entity\Prestation $prestation
     *
     * @return Workshop
     */
    public function addPrestation(\PrestationBundle\Entity\Prestation $prestation)
    {
        $this->prestation[] = $prestation;

        return $this;
    }

    /**
     * Remove prestation
     *
     * @param \PrestationBundle\Entity\Prestation $prestation
     */
    public function removePrestation(\PrestationBundle\Entity\Prestation $prestation)
    {
        $this->prestation->removeElement($prestation);
    }

    /**
     * Get prestation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrestation()
    {
        return $this->prestation;
    }
}
