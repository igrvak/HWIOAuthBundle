<?php

namespace Iwin\Bundle\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Iwin\Bundle\AppBundle\Entity\UtilLanguage;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * LoadUtilLanguageData.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class LoadUtilLanguageData extends AbstractFixture implements
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

            $row = new UtilLanguage();
            $row->setClass($name)
                ->setIsDefault($this->getDefaultLocale() == $name);

            foreach ($drow['titles'] as $lang => $title) {
                $trans->translate($row, 'title', $lang, $title);
            }

            $this->addReference('language_' . $name, $row);
            $manager->persist($row);
        }

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 0;
    }

    /**
     * @return array
     */
    protected function getData()
    {
        $path = $this->container->getParameter('iwin_app.config_directory');
        $path .= '/data/languages.yml';
        $data = Yaml::parse(file_get_contents($path));

        return $data;
    }

    /**
     * @return string
     */
    protected function getDefaultLocale()
    {
        return $this->container
            ->getParameter('kernel.default_locale');
    }


}
