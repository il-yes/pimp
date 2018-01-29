<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Model\UserTrait;

/**
 * Manager
 *
 * @ORM\Table(name="manager")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ManagerRepository")
 */
class Manager extends Technician
{
    use UserTrait;

    public function __construct()
    {
        parent::__construct();
        $this->addRole("ROLE_WORKER");
        $this->setType(self::TYPE_TECHNICIEN_MANAGER);
        $this->setHierarchy(parent::HIERARCHIE_MANAGER);
    }


}
