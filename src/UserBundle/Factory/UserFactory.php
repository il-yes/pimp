<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 24/01/18
 * Time: 18:06
 */

namespace UserBundle\Factory;


use UserBundle\Entity\Admin;
use UserBundle\Entity\Client;
use UserBundle\Entity\Technician;
use UserBundle\Entity\User;

class UserFactory
{
    public function createUser($type)
    {
       return $this->userDeterminator($type);
    }

    private function createAdmin()
    {
        return new Admin();
    }
    private function createTechnician()
    {
        return new Technician();
    }
    private function createClient()
    {
        return new Client();
    }

    public function userDeterminator($type)
    {
        switch ($type)
        {
            case User::ADMIN :
                return $this->createAdmin();
                break;

            case User::CLIENT :
                return $this->createClient();
                break;

            case User::TECHNICIEN :
                return $this->createTechnician();
                break;
        }
    }
}