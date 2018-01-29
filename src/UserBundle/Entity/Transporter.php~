<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Model\PartnerAbstract;
use UserBundle\Model\UserTrait;

/**
 * Transporter
 *
 * @ORM\Table(name="transporter")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\TransporterRepository")
 */
class Transporter extends PartnerAbstract
{
    use UserTrait;

    public function __construct()
    {
        parent::__construct();
        $this->addRole("ROLE_PARTNER");
        $this->setType(self::TYPE_PARTNER_TRANSPORTER);
    }



}
