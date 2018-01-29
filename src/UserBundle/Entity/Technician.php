<?php

namespace UserBundle\Entity;

use UserBundle\Model\StaffAbstract;
use UserBundle\Model\UserTrait;

/**
 * Technician
 *
 */
class Technician extends StaffAbstract
{
    use UserTrait;

    const HIERARCHIE_MANAGER = "manager";
    const HIERARCHIE_MEMBER = "member";

    private $hierarchy;

    /**
     * @return mixed
     */
    public function getHierarchy()
    {
        return $this->hierarchy;
    }

    /**
     * @param mixed $hierarchy
     */
    public function setHierarchy($hierarchy)
    {
        $this->hierarchy = $hierarchy;
    }


}

