<?php
namespace Iwin\Bundle\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Iwin\Bundle\AppBundle\Entity\FaqItems;
use Iwin\Bundle\AppBundle\Entity\FaqMessage;
use Iwin\Bundle\AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Загружает список социальных сетей
 *
 * @author Igor Malinovskiy <garrykmia@gmail.com>
 */
class LoadFaqItemsData extends AbstractFixture implements
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
        foreach ($this->getData() as $drow) {
#            print_r($drow);
#            die();
            $row = new FaqItems();
            // Load base properties
            $row->setIsActive($drow['isActive']);
            $row->setPosition($drow['position']);

            // Load localizations
            foreach ($drow['questions'] as $lang => $nameFirst) {
                $trans->translate($row, 'question', $lang, $nameFirst);
            }

            foreach ($drow['answers'] as $lang => $nameLast) {
                $trans->translate($row, 'answer', $lang, $nameLast);
            }

            // Load relations
            if (!empty($drow['userOwner'])) {
                if ($this->hasReference('user-' . $drow['userOwner'])) {
                    $row->setUserOwner($this->getReference('user-' . $drow['userOwner']));
                }
            }

            if (!empty($drow['categoryUniq'])) {
                if ($this->hasReference('faq-category-' . $drow['categoryUniq'])) {
                    $row->setCategory($this->getReference('faq-category-' . $drow['categoryUniq']));
                }
            }

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
        return 8;
    }

    /**
     * @return array
     */
    protected function getData()
    {
        $path = $this->getDataDir().'faq-items.yml';

        $data = Yaml::parse(file_get_contents($path));

        return $data;
    }

    /**
     * @return string
     */
    protected function getDataDir()
    {
        return $this->container->getParameter('iwin_app.config_directory') . '/data/';
    }

}
