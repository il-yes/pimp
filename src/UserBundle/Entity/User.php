<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Model\UserTrait;

/**
 * User
 *
 */
class User extends BaseUser
{
    const TYPE_ADMIN = 'admin';
    const TYPE_CLIENT = 'customer';
    const TYPE_DEVELOPER = 'developer';
    const TYPE_TECHNICIEN_MANAGER = 'technician_manager';
    const TYPE_TECHNICIEN_MEMBER = 'technician_member';
    const TYPE_PARTNER_TRANSPORTER = "partner_transporter";

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

