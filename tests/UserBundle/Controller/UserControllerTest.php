<?php

namespace UserBundle\Tests\Controller;

use Tests\Framework\WebTestCase;
use UserBundle\Entity\User;
use UserBundle\Factory\UserFactory;

class UserControllerTest extends WebTestCase
{
    const USERNAME_1 = 'John Doe';
    const USERNAME_2 = 'Jessica traoré';

    /**
     * @test
     */
    public function newUser()
    {
        $userFactory = new UserFactory();
        $technician = $userFactory->createUser(User::TECHNICIEN);
        $technician->setUsername(self::USERNAME_1);

        $this->visit('/technicians/new')
            ->assertResponseOk();

        $this->assertEquals(User::TECHNICIEN, $technician->getType());
        $this->assertEquals(self::USERNAME_1, $technician->getUsername());
    }
}
