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
        $gen = function ($maxLevel, $level = 1, $forceAmount = null) use (&$gen, &$manager) {
            $ret = [];
            $amount = $forceAmount ? $forceAmount : mt_rand(1, 5);
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

        foreach ($gen(4, 1, 10) as $i => $cat) {
            $this->addReference('category-' . $i, $cat);
        }

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
