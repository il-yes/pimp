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
        $technicianMember = $userFactory->createUser(User::TYPE_TECHNICIEN_MEMBER);
        $technicianMember->setUsername(self::USERNAME_1);

        $this->visit('/technicians/new')
            ->assertResponseOk();

        $this->assertEquals(User::TYPE_TECHNICIEN_MEMBER, $technicianMember->getType());
        $this->assertEquals(self::USERNAME_1, $technicianMember->getUsername());
        $this->assertContains("ROLE_WORKER", $technicianMember->getRoles());
        self::assertTrue($technicianMember instanceof User);
        var_dump($technicianMember);
    }
}
