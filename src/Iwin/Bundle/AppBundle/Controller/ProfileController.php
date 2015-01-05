<?php
namespace Iwin\Bundle\AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\DiExtraBundle\Annotation as DI;

use Iwin\Bundle\AppBundle\Entity\User;
use Iwin\Bundle\AppBundle\Entity\UserRepository;

use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ValidatorInterface;


/**
 * Управление профайлами
 *
 * @author Igor Malinovskiy <garrykmia@gmail.com>
 *
 * @Rest\Route("/profileapi")
 */
class ProfileController
{
    /**
     * @DI\Inject("iwin_app.repo.profile")
     * @var UserRepository
     */
    private $repoProfile;

    /**
     * @DI\Inject("jms_serializer")
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @DI\Inject("validator")
     * @var ValidatorInterface
     */
    private $validator;

    // -- Actions ---------------------------------------

    /**
     * @Rest\Get("/save", name="iwin_profile_save")
     * @Rest\View()
     */
    public function saveAction()
    {
        $userData = [
            //'id' => 1,
            'nameFirst' => 'Garyk',
            'nameLast' => 'Malinovskiy',
            'phone' => '+30660476275',
            'chatSkype' => 'garryk71',
            'birthdate' => '1983-08-15',

            /*
            'image_avatar' => [
                'height' => '34',
                'ordinal' => '56',
                'width' => '4534'
            ],
            */

            'location' => [
                'id' => '5e8fd4d4-8f3f-11e4-8acc-e06995d8233e'
            ],
            /*
            'socials' => [
                ["id"=> 1],
                ["id" => 2],
                ["id" => 3],
                ["id" => 4],
            ]
            */
        ];

        $strSerialize = json_encode($userData);
        //die($strSerialize);

        $user = $this->serializer->deserialize($strSerialize, 'Iwin\\Bundle\\AppBundle\\Entity\\User', 'json');

        print_r($user);
        die();




    }
}
