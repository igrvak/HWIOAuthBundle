<?php
namespace Iwin\Bundle\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

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
class LoadFaqMessagesData extends AbstractFixture implements
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
            $row = new FaqMessage();

            $row->setEmail($drow['email']);

            $row->setLang($drow['ref_lang']);
            $row->setName($drow['name']);
            $row->setQuestion($drow['question']);
            $row->setAnswer($drow['answer']);

            // Load relations
            if (!empty($drow['refUserAnswer'])) {
                if ($this->hasReference('user-' . $drow['refUserAnswer'])) {
                    $row->setUserAnswer($this->getReference('user-' . $drow['refUserAnswer']));
                }
            }

            // Load assigned files
            $files = [];
            if (isset($drow['files']) and count($drow['files']) > 0) {
                foreach ($drow['files'] as $file) {
                    $file = $this->serviceUploader()->upload($this->getDataDir() . 'files/'. $file,
                        'faq_messages'
                    );

                    if (!empty($file)) {
                        $files[] = $file;
                    }
                }
            }

            if (count($files) > 0) {
                $row->setFiles($files);
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
        return 7;
    }

    /**
     * @return array
     */
    protected function getData()
    {
        $path = $this->getDataDir().'faq-messages.yml';
        $data = Yaml::parse(file_get_contents($path));

        return $data;
    }

    /**
     * @return string
     */
    protected function getDataDir()
    {
        return $this->container->getParameter('iwin_app.config_directory') . '/data/faq_messages/';
    }

    /**
     * @return \Iwin\Bundle\SharedBundle\Service\File\ProgrammaticFileUploader
     */
    protected function serviceUploader()
    {
        return $this->container->get('iwin_shared.file.programmaticfileuploader');
    }

}
