<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Model\StaffAbstract;
use UserBundle\Model\UserTrait;

/**
 * Developer
 *
 * @ORM\Table(name="developer")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\DeveloperRepository")
 */
class Developer extends StaffAbstract
{
    use UserTrait;

    public function __construct()
    {
        parent::__construct();

        $this->setType(parent::TYPE_DEVELOPER);
        $this->addRole("ROLE_WORKER");
    }

}
