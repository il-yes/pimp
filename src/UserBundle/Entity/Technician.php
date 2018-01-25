<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Model\UserTrait;

/**
 * Technician
 *
 * @ORM\Table(name="user_technician")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\TechnicianRepository")
 */
class Technician extends User
{
    use UserTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->setType(parent::TECHNICIEN);
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
}

