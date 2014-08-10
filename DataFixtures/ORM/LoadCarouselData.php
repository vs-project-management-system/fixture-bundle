<?php
namespace PMS\Bundle\FixturesBundle\DataFixtures\ORM;

class LoadCarouselData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        $populator = new \Faker\ORM\Doctrine\Populator($this->faker, $manager);
        $populator->addEntity('\PMS\Bundle\CoreBundle\Entity\Carousel', 2);
        $populator->execute();

        $manager->flush();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 5;
    }
}
