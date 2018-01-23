<?php

namespace PrestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="activity")
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
     * @ORM\ManyToMany(targetEntity="ProductBundle\Entity\Workshop", cascade={"persist"})
     * @ORM\JoinTable(name="activity_workshop",
     *      joinColumns={@ORM\JoinColumn(name="activity_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="workshop_id", referencedColumnName="id", nullable=true)})
     */
    private $workshops;

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
     * Add workshop
     *
     * @param \ProductBundle\Entity\Workshop $workshop
     *
     * @return Activity
     */
    public function addWorkshop(\ProductBundle\Entity\Workshop $workshop)
    {
        $this->workshops[] = $workshop;

        return $this;
    }

    /**
     * Remove workshop
     *
     * @param \ProductBundle\Entity\Workshop $workshop
     */
    public function removeWorkshop(\ProductBundle\Entity\Workshop $workshop)
    {
        $this->workshops->removeElement($workshop);
    }

    /**
     * Get workshops
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkshops()
    {
        return $this->workshops;
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
}
