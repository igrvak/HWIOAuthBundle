<?php
namespace Iwin\Bundle\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Iwin\Bundle\AppBundle\Entity\User;
use Iwin\Bundle\AppBundle\Entity\UserSocial;
use Iwin\Bundle\SharedBundle\Entity\Location;
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
        $trans = $manager->getRepository('GedmoTranslatable:Translation');

        foreach ($this->getData() as $drow) {
            $row = new User();

            // Load base properties
            $date = new \DateTime($drow['birthdate']);
            $row->setBirthdate($date);
            $row->setChatSkype($drow['chatSkype']);
            $row->setUsername($drow['username']);
            $row->setPhone($drow['phone']);
            $row->setEmail($drow['email']);
            $row->setPlainPassword($drow['password']);

            // Load localizations
            foreach ($drow['nameFirst'] as $lang => $nameFirst) {
                $trans->translate($row, 'nameFirst', $lang, $nameFirst);
            }

            foreach ($drow['nameLast'] as $lang => $nameLast) {
                $trans->translate($row, 'nameLast', $lang, $nameLast);
            }

            // Load assigned entities
            if (isset($drow['imageAvatar']) and !empty($drow['imageAvatar'])) {
                $image = $this->serviceUploader()->upload($this->getDataDir() . 'images/' . $drow['imageAvatar'], 'users');
                if (!empty($image))
                    $row->setImageAvatar($image);

            }

            if (isset($drow['location']) and !empty($drow['location'])) {
                $location = new Location();
                $location->setAddress($drow['location']['address']);
                $location->setPosLat($drow['location']['posLat']);
                $location->setPosLong($drow['location']['posLong']);

                $row->setLocation($location);
            }

            // Set data for user
            $manager->persist($row);

            // Load relations
            // $row->setImageAvatar(null);

            foreach ($drow['socials'] as $social => $socialData) {
                $userSocial = new UserSocial();
                $userSocial->setUser($row)
                    ->setSocial($this->getReference('social-' . $social))
                    ->setIdSocial($socialData['idSocial'])
                    ->setNickname($socialData['nickname'])
                    ->setUrlProfile($socialData['urlProfile'])
                    ->setUrlImage($socialData['urlImage']);

                // Set data for userSocial
                $manager->persist($userSocial);
            }

            // Create reference
            $this->addReference('user-' . $drow['username'], $row);
        }

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 6;
    }

    /**
     * @return array
     */
    protected function getData()
    {
        $path = $this->getDataDir() . 'users.yml';

        $data = Yaml::parse(file_get_contents($path));

        return $data;
    }


    /**
     * @return string
     */
    protected function getDataDir()
    {
        return $this->container->getParameter('iwin_app.config_directory') . '/data/user/';
    }

    /**
     * @return \Iwin\Bundle\SharedBundle\Service\File\ProgrammaticFileUploader
     */
    protected function serviceUploader()
    {
        return $this->container->get('iwin_shared.file.programmaticfileuploader');
    }

}
