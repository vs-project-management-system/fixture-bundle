<?php
namespace PMS\Bundle\FixturesBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

class LoadAddressData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $populator = new \Faker\ORM\Doctrine\Populator($this->faker, $manager);
        $populator->addEntity('\PMS\Bundle\CoreBundle\Entity\Address', 5);
        $populator->execute();

        $manager->flush();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 3;
    }
}
