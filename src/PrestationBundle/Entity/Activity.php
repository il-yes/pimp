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
     * Activity constructor.
     * @param $_name
     * @param $_category
     * @param $_price
     */
    public function __construct($_name, $_category, $_price)
    {
        $this->name = $_name;
        $this->price = $_price;
        $this->category = $_category;
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
     * @return float
     */
    public function getExecutionTime()
    {
        $this->executionTime;

        return $this;
    }

    /**
     * @param $executionTime
     * @return $this
     */
    public function setExecutionTime($executionTime)
    {
        $this->executionTime = $executionTime;

        return $this;
    }


}
