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
use UserBundle\Entity\Developer;
use UserBundle\Entity\Manager;
use UserBundle\Entity\Member;
use UserBundle\Entity\Technician;
use UserBundle\Entity\Transporter;
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
    private function createClient()
    {
        return new Client();
    }
    private function createTechnianMember()
    {
        return new Member();
    }
    private function createTechnicianManager()
    {
        return new Manager();
    }
    private function createDeveloper()
    {
        return new Developer();
    }
    private function createTransporter()
    {
        return new Transporter();
    }

    public function userDeterminator($type)
    {
        switch ($type)
        {
            case User::TYPE_ADMIN :
                return $this->createAdmin();
                break;

            case User::TYPE_CLIENT :
                return $this->createClient();
                break;

            case User::TYPE_TECHNICIEN_MEMBER  :
                return $this->createTechnianMember();
                break;

            case User::TYPE_TECHNICIEN_MANAGER  :
                return $this->createTechnicianManager();
                break;

            case User::TYPE_DEVELOPER  :
                return $this->createDeveloper();
                break;

            case User::TYPE_PARTNER_TRANSPORTER  :
                return $this->createTransporter();
                break;
        }
    }
}