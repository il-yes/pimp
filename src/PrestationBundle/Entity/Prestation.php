<?php

namespace PrestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prestation
 *
 * @ORM\Table(name="prestation")
 * @ORM\Entity(repositoryClass="PrestationBundle\Repository\PrestationRepository")
 */
class Prestation
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
     * @ORM\Column(name="reference", type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity="PrestationBundle\Entity\Activity", inversedBy="prestation")
     */
    private $activity;

    /**
     * @ORM\ManyToOne(targetEntity="ProductBundle\Entity\Workshop", inversedBy="prestation")
     */
    private $workshop;



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
     * Set reference
     *
     * @param string $reference
     *
     * @return Prestation
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set activity
     *
     * @param \PrestationBundle\Entity\Activity $activity
     *
     * @return Prestation
     */
    public function setActivity(\PrestationBundle\Entity\Activity $activity = null)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \PrestationBundle\Entity\Activity
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set workshop
     *
     * @param \ProductBundle\Entity\Workshop $workshop
     *
     * @return Prestation
     */
    public function setWorkshop(\ProductBundle\Entity\Workshop $workshop = null)
    {
        $this->workshop = $workshop;

        return $this;
    }

    /**
     * Get workshop
     *
     * @return \ProductBundle\Entity\Workshop
     */
    public function getWorkshop()
    {
        return $this->workshop;
    }
}
