<?php

namespace PrestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="pres_activity")
 * @ORM\Entity(repositoryClass="PrestationBundle\Repository\ActivityRepository")
 */
class Activity
{
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
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=100)
     */
    private $category;

    /**
     * @var float
     *
     * @ORM\Column(name="execution_time", type="float", nullable=true)
     */
    private $executionTime;

    /**
     * @ORM\ManyToOne(targetEntity="ProductBundle\Entity\Workshop", inversedBy="activity")
     */
    private $workshop;

    /**
     * @ORM\OneToMany(targetEntity="PrestationBundle\Entity\Prestation", mappedBy="activity", cascade={"persist"})
     */
    private $prestation;




    /**
     * Activity constructor.
     * @param $_name
     * @param $_category
     * @param $_price
     */
    public function __construct($_name, $_category, $_price)
    {
        $this->name = $_name;
        $this->category = $_category;
        $this->price = $_price;
        $this->setWorkshop(null);
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
     * @return Activity
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
     * Set price
     *
     * @param float $price
     *
     * @return Activity
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Activity
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set executionTime
     *
     * @param float $executionTime
     *
     * @return Activity
     */
    public function setExecutionTime($executionTime)
    {
        $this->executionTime = $executionTime;

        return $this;
    }

    /**
     * Get executionTime
     *
     * @return float
     */
    public function getExecutionTime()
    {
        return $this->executionTime;
    }


    /**
     * Add prestation
     *
     * @param \PrestationBundle\Entity\Prestation $prestation
     *
     * @return Activity
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


    /**
     * Get workshop
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkshop()
    {
        $this->workshop;

        return $this;
    }

    /**
     * Set workshop
     *
     * @param \ProductBundle\Entity\Workshop $workshop
     *
     * @return Activity
     */
    public function setWorkshop(\ProductBundle\Entity\Workshop $workshop = null)
    {
        $this->workshop = $workshop;

        return $this;
    }

    public function isAWorkshopAssignedToHim()
    {
        if ($this->workshop != null)
        {
            return true;
        }
        return false;
    }

}
