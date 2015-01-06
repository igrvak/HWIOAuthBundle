<?php
namespace Iwin\Bundle\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Iwin\Bundle\AppBundle\Entity\User;
use Iwin\Bundle\AppBundle\Entity\UserSocial;
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
        //print_r($trans);
        //die();

        foreach ($this->getData() as $drow) {
            $row = new User();

            $date = new \DateTime($drow['birthdate']);
            $row->setBirthdate($date);

            $row->setChatSkype($drow['chatSkype']);
            $row->setUsername($drow['username']);
            $row->setPhone($drow['phone']);
            $row->setEmail($drow['email']);
            $row->setPlainPassword($drow['password']);
            //$row->setImageAvatar(null);

            foreach ($drow['location']['nameFirst'] as $lang => $nameFirst) {
                $trans->translate($row, 'nameFirst', $lang, $nameFirst);
            }

            foreach ($drow['location']['nameLast'] as $lang => $nameLast) {
                $trans->translate($row, 'nameLast', $lang, $nameLast);
            }

            // Set data for user
            $manager->persist($row);

            foreach($drow['socials'] as $social => $socialData) {
                $userSocial = new UserSocial() ;
                $userSocial->setUser($row)
                           ->setSocial($this->getReference('social-'.$social))
                           ->setNickname($socialData['nickname'])
                           ->setUrlProfile($socialData['urlProfile'])
                           ->setUrlImage($socialData['urlImage']);

                $manager->persist($userSocial);
            }
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
        $path = $this->container->getParameter('iwin_app.config_directory');
        $path .= '/data/user/users.yml';

        $data = Yaml::parse(file_get_contents($path));

        return $data;
    }

}
