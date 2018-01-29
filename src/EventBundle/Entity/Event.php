<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PrestationBundle\Entity\Prestation;
use ProductBundle\Model\Vehicule;
use UserBundle\Entity\Client;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\EventRepository")
 */
class Event
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Client", inversedBy="events")
     */
    private $client;

    private $vehicule;

    /**
     * @var int
     *
     * @ORM\Column(name="vehicule_id", type="integer")
     */
    private $vehiculeId;

    /**
     * @ORM\OneToOne(targetEntity="PrestationBundle\Entity\Prestation", cascade={"persist"})
     */
    private $prestation;

    /**
     * Event constructor.
     * @param Client $client
     * @param Vehicule $vehicule
     * @param Prestation $prestation
     */
    public function __construct(Client $client, Vehicule $vehicule, Prestation $prestation)
    {
        $this->client = $client;
        $this->vehicule = $vehicule;
        $this->vehiculeId = $this->vehicule->getId();
        $this->prestation = $prestation;
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
     * Set vehiculeId
     *
     * @param integer $vehiculeId
     *
     * @return Event
     */
    public function setVehiculeId($vehiculeId)
    {
        $this->vehiculeId = $vehiculeId;

        return $this;
    }

    /**
     * Get vehiculeId
     *
     * @return integer
     */
    public function getVehiculeId()
    {
        return $this->vehiculeId;
    }

    /**
     * Set client
     *
     * @param \UserBundle\Entity\Client $client
     *
     * @return Event
     */
    public function setClient(\UserBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \UserBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set prestation
     *
     * @param \PrestationBundle\Entity\Prestation $prestation
     *
     * @return Event
     */
    public function setPrestation(\PrestationBundle\Entity\Prestation $prestation = null)
    {
        $this->prestation = $prestation;

        return $this;
    }

    /**
     * Get prestation
     *
     * @return \PrestationBundle\Entity\Prestation
     */
    public function getPrestation()
    {
        return $this->prestation;
    }

    /**
     * @return Vehicule
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * @param Vehicule $vehicule
     */
    public function setVehicule($vehicule)
    {
        $this->vehicule = $vehicule;
    }


}
