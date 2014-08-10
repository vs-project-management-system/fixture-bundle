<?php
namespace PMS\Bundle\FixturesBundle\DataFixtures\ORM;

use \Doctrine\Common\Persistence\ObjectManager;

class LoadAdminData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new \PMS\Bundle\UserBundle\Entity\Admin();

        $user->setUsername('admin');
        $user->setFirstName($this->faker->firstName);
        $user->setLastName($this->faker->lastName);
        $user->setEmail('pms@daviddurost.net');
        $user->setPassword('v0l1ey8a1l');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setGender('male');
        $user->setBirthdate($this->faker->datetime());

        $manager->persist($user);
        $manager->flush();

        $this->setReference('User-Administrator', $user);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
