<?php
namespace PMS\Bundle\FixturesBundle\DataFixtures\ORM;

class LoadCarouselItemData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        $populator = new \Faker\ORM\Doctrine\Populator($this->faker, $manager);
        $populator->addEntity('\PMS\Bundle\CoreBundle\Entity\CarouselItem', 4);
        $populator->execute();

        $manager->flush();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 4;
    }
}
