<?php
namespace Iwin\Bundle\CategoryBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Iwin\Bundle\SharedBundle\Entity\Category;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Грузит список категорий
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class LoadCategoryData extends AbstractFixture implements
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
        # TODO: нормальные имена
        $gen = function ($maxLevel, $level = 1) use (&$gen, &$manager) {
            $ret = [];
            $amount = mt_rand(1,5);
            for ($i = 0; $i < $amount; $i++) {
                $cat = new Category();
                $cat->setTitle(mt_rand(100000, 999999));

                if ($level < $maxLevel) {
                    foreach ($gen($maxLevel, $level + 1) as $row) {
                        /** @var Category $row */
                        $row->setParent($cat);
                    }
                }

                $manager->persist($cat);
                $ret[] = $cat;
            }
            return $ret;
        };

        $gen(4);

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
