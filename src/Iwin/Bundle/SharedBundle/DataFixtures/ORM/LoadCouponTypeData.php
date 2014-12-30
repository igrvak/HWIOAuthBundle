<?php
namespace Iwin\Bundle\SharedBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Iwin\Bundle\SharedBundle\Entity\CouponType;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Грузит список купонов
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class LoadCouponTypeData extends AbstractFixture implements
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
        $trans = $manager->getRepository('GedmoTranslatable:Translation');
        foreach ($this->getData() as $name => $drow) {
            $row = new CouponType();
            $row->setClass($name);
            $row->setHasDiscount($drow['hasDiscount']);

            foreach ($drow['titles'] as $lang => $title) {
                $trans->translate($row, 'title', $lang, $title);
            }

            $manager->persist($row);
            $this->addReference('coupon-type-' . $row->getClass(), $row);
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

    /**
     * @return array
     */
    protected function getData()
    {
        $path = $this->container->getParameter('iwin_app.config_directory');
        $path .= '/data/couponTypes.yml';
        $data = Yaml::parse(file_get_contents($path));

        return $data;
    }

}
