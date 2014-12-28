<?php
namespace Iwin\Bundle\CategoryBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Iwin\Bundle\SharedBundle\Entity\Category;
use Iwin\Bundle\SharedBundle\Service\File\ProgrammaticFileUploader;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

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
        $gen = function ($maxLevel, $level = 1, Category $parent = null) use (&$gen, &$manager) {
            $ret = [];
            $amount = mt_rand(1, 5);
            for ($i = 0; $i < $amount; $i++) {
                $cat = new Category();
                $cat->setTitle(mt_rand(100000, 999999));
                $cat->setParent($parent);

                if ($level < $maxLevel) {
                    $gen($maxLevel, $level + 1, $cat);
                }

                $manager->persist($cat);
                $ret[] = $cat;
            }
            return $ret;
        };

        $trans = $manager->getRepository('GedmoTranslatable:Translation');
        $i = 0;
        foreach ($this->getData() as $k => $row) {
            $cat = new Category();
            $cat->setImage($this->serviceUploader()->upload(
                $this->getDataDir() . '/img/category/' . $k . '.png',
                'category'
            ));
            foreach ($row['titles'] as $lang => $title) {
                $trans->translate($cat, 'title', $lang, $title);
            }

            $gen(4, 2, $cat);

            $this->addReference('category-' . $k, $cat);
            $this->addReference('category-' . (++$i), $cat);
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
        $path = $this->getDataDir() . '/category.yml';
        $data = Yaml::parse(file_get_contents($path));

        return $data;
    }

    /**
     * @return string
     */
    protected function getDataDir()
    {
        return $this->container->getParameter('iwin_shared.config_directory') . '/data';
    }

    /**
     * @return ProgrammaticFileUploader
     */
    protected function serviceUploader()
    {
        return $this->container->get('iwin_shared.file.programmaticfileuploader');
    }
}
