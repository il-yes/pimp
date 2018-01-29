<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Model\UserTrait;

/**
 * Member
 *
 * @ORM\Table(name="member")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\MemberRepository")
 */
class Member extends Technician
{
    use UserTrait;

    public function __construct()
    {
        parent::__construct();
        $this->addRole("ROLE_WORKER");
        $this->setType(self::TYPE_TECHNICIEN_MEMBER);
        $this->setHierarchy(parent::HIERARCHIE_MEMBER);
    }




}
