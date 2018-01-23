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
     * @ORM\Column(name="reference", type="string", length=255, nullable=true)
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity="PrestationBundle\Entity\Activity", inversedBy="prestation")
     */
    private $activity;

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
     * @return array
     */
    public function isActivityValid()
    {
        if (!$this->getActivity() instanceof Activity)
        {
            return [
                'result' => false,
                'type' => 'error_activity'
            ];
        }
        if (!$this->activity->isAWorkshopAssignedToHim())
        {
            return [
                'result' => false,
                'type' => 'error_workshop'
            ];
        }

        return [
            'result' => true,
            'type' => 'success'
        ];
    }

}
