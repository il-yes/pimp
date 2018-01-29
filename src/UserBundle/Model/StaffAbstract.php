<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 26/01/18
 * Time: 01:30
 */

namespace UserBundle\Model;


use UserBundle\Entity\User;

class StaffAbstract extends User
{
    use UserTrait;
}