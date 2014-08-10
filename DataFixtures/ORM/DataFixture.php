<?php
namespace PMS\Bundle\FixturesBundle\DataFixtures\ORM;

use Faker\Factory as FakerFactory;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

/** @TODO add FileLocator and i/o */

abstract class DataFixture extends \Doctrine\Common\DataFixtures\AbstractFixture implements \Symfony\Component\DependencyInjection\ContainerAwareInterface, \Doctrine\Common\DataFixtures\OrderedFixtureInterface
{
    /**
     * Container
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Faker
     *
     * @var Generator
     */
    protected $faker;
    
    /**
     * Repository
     * @var Doctrine\ORM\EntityRepository
     */
    protected $repository;
    
    /**
     * Entity
     * @var mixed
     */
    protected $entity;
    
    /**
     * configuration settings
     * @var ArrayCollection
     */
    private $configs;

    /**
     * config file locator
     * @var FileLocater
     */
    private $locator;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->faker = FakerFactory::create();
        $path = __DIR__ .DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
                'app' . DIRECTORY_SEPARATOR;
        $configDirectories = array(
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'config',
            $path . 'config'
        );
        $this->locator = new FileLocator($configDirectories);
    }

    /**
     * @{inheritdoc}
     */
    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null)
    {
        $this->container = $container;
    }

//    public function __call($method, $arguments)
//    {
//        $matches = array();
//        if (preg_match('/^get(.*)Repository$/', $method, $matches)) {
//            return $this->get('volleyball.repository.'.$matches[1]);
//        }
//
//        return call_user_func_array(array($this, $method), $arguments);
//    }

    /**
     * Get service by id.
     *
     * @param string $id
     *
     * @return object
     */
    protected function get($id)
    {
        return $this->container->get($id);
    }
    
    /**
     * Set repository
     * @param Doctrine\ORM\EntityRepository $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Get repository
     * @return Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }
    
    /**
     * Set entity
     * @param mixed $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }
    
    /**
     * Get entity
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }
    
    /**
     * Get configuration file parameter
     * @param string $parameter
     * @return type
     */
    public function getFixtureMax($parameter)
    {
        if (!$this->configs instanceof ArrayCollection) {
            $this->generateConfigs('parameters.yml', null, false);
        }

        if ($this->configs->has('volleyball.fixtures.'.$parameter.'.total')) {
            return $this->configs->has('volleyball.fixtures.'.$parameter.'.total');
        } else {
            return $this->configs->has('volleyball.fixtures.'.$parameter);
        }
    }

    /**
     * Generate configuration array
     * @param string $file
     * @param string $path
     * @param bool $retFile
     */
    private function generateConfigs($file, $path = null, $retFile = false)
    {
        $configs = Yaml::parse($this->locator->locate($file, $path, $retFile)[0]);

        $this->configs = new ArrayCollection($configs['parameters']);
    }
}
