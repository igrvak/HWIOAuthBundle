<?php
namespace Iwin\Bundle\AdvertBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Iwin\Bundle\AdvertBundle\Entity\Advert;
use Iwin\Bundle\AppBundle\Entity\Coupon;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Грузит список объявлений
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class LoadAdvertData extends AbstractFixture implements
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
        $advert = new Advert();
        $manager->persist($advert);

        $coupon = new Coupon();
        $coupon->setDescription('test');
        $coupon->setName('test');
        $coupon->setExpires(new \DateTime());
        $coupon->setType($this->getReference('coupon-type-discount'));
        $advert->getCoupons()->add($coupon);

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
