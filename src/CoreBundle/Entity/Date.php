<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Date
 *
 * @ORM\Table(name="date")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\DateRepository")
 */
class Date
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
     * @var \DateTime
     *
     * @ORM\Column(name="startsAt", type="datetime")
     */
    private $startsAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endsAt", type="datetime", nullable=true)
     */
    private $endsAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cancelsAt", type="datetime", nullable=true)
     */
    private $cancelsAt;


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
     * Set startsAt
     *
     * @param \DateTime $startsAt
     *
     * @return Date
     */
    public function setStartsAt($startsAt)
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    /**
     * Get startsAt
     *
     * @return \DateTime
     */
    public function getStartsAt()
    {
        return $this->startsAt;
    }

    /**
     * Set endsAt
     *
     * @param \DateTime $endsAt
     *
     * @return Date
     */
    public function setEndsAt($endsAt)
    {
        $this->endsAt = $endsAt;

        return $this;
    }

    /**
     * Get endsAt
     *
     * @return \DateTime
     */
    public function getEndsAt()
    {
        return $this->endsAt;
    }

    /**
     * Set cancelsAt
     *
     * @param \DateTime $cancelsAt
     *
     * @return Date
     */
    public function setCancelsAt($cancelsAt)
    {
        $this->cancelsAt = $cancelsAt;

        return $this;
    }

    /**
     * Get cancelsAt
     *
     * @return \DateTime
     */
    public function getCancelsAt()
    {
        return $this->cancelsAt;
    }
}

