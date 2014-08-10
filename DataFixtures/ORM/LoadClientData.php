<?php
namespace PMS\Bundle\FixturesBundle\DataFixtures\ORM;

class LoadClientData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        $populator = new \Faker\ORM\Doctrine\Populator($this->faker, $manager);
        $populator->addEntity('\PMS\Bundle\UserBundle\Entity\Client', 2);
        $populator->execute();

        $manager->flush();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 8;
    }
}
