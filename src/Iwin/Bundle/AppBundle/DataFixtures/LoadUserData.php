<?php
namespace Iwin\Bundle\SharedBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Iwin\Bundle\AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Загружает список социальных сетей
 *
 * @author Igor Malinovskiy <garrykmia@gmail.com>
 */
class LoadUserData extends AbstractFixture implements
    FixtureInterface,
    OrderedFixtureInterface,
    ContainerAwareInterface
{
    /** @var ContainerInterface */
    protected $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $drow) {
            $row = new User();

            // Set data for user

            $manager->persist($row);
        }

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 2;
    }

    /**
     * @return array
     */
    protected function getData()
    {
        $path = $this->container->getParameter('iwin_shared.config_directory');
        $path .= '/data/users.yml';
        $data = Yaml::parse(file_get_contents($path));

        return $data;
    }

}
