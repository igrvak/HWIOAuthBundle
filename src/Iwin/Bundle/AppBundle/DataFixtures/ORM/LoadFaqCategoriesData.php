<?php
namespace Iwin\Bundle\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Iwin\Bundle\AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;
use Iwin\Bundle\AppBundle\Entity\FaqCategory;

/**
 * Загружает список категорий для faq
 *
 * @author Igor Malinovskiy <garrykmia@gmail.com>
 */
class LoadFaqCategoriesData extends AbstractFixture implements
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

            $row = new FaqCategory();
            // Load base properties
            $row->setPosition($drow['position']);
            $row->setIsActive($drow['isActive']);
            $row->setUniqName($drow['uniq_name']);

            // Load localizations
            foreach ($drow['titles'] as $lang => $title) {
                $trans->translate($row, 'title', $lang, $title);
            }
            $manager->persist($row);

            // Create reference
            $this->addReference('faq-category-'.$drow['uniq_name'], $row);
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
        $path = $this->container->getParameter('iwin_app.config_directory');
        $path .= '/data/faq-categories.yml';

        $data = Yaml::parse(file_get_contents($path));

        return $data;
    }

}
