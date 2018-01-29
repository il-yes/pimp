<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Model\UserTrait;

/**
 * Client
 *
 * @ORM\Table(name="user_client")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ClientRepository")
 */
class Client extends User
{
    use UserTrait;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->setType(parent::TYPE_CLIENT);
        $this->addRole("ROLE_CLIENT");
    }


    /**
     * @ORM\OneToMany(targetEntity="EventBundle\Entity\Event", mappedBy="client", cascade={"persist"})
     */
    private $events;

    /**
     * Add event
     *
     * @param \EventBundle\Entity\Event $event
     *
     * @return Client
     */
    public function addEvent(\EventBundle\Entity\Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \EventBundle\Entity\Event $event
     */
    public function removeEvent(\EventBundle\Entity\Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }
}
