<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Model\UserTrait;

/**
 * Admin
 *
 * @ORM\Table(name="user_admin")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\AdminRepository")
 */
class Admin extends User
{
    use UserTrait;

    public function __construct()
    {
        parent::__construct();

        $this->setType(parent::ADMIN);
        $this->addRole("ROLE_ADMIN");

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
