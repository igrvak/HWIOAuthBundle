<?php
namespace Iwin\Bundle\AdvertBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Iwin\Bundle\AdvertBundle\Entity\Advert;
use Iwin\Bundle\AdvertBundle\Entity\AdvertRepository;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Управление объявлениями
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @Rest\Route("/advertapi")
 */
class AdvertController
{
    /**
     * @DI\Inject("iwin_advert.repo.advert")
     * @var AdvertRepository
     */
    private $repoAdvert;
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
    /**
     * @DI\Inject("doctrine.orm.entity_manager")
     * @var EntityManagerInterface
     */
    private $manager;

    // -- Actions ---------------------------------------

    /**
     * @ApiDoc(
     *   description="Создает пустое объявление"
     * )
     * @Rest\Get("/", defaults={"_format": "json"})
     * @Rest\View()
     */
    public function createAction()
    {
        return new Advert();
    }

    /**
     * @ApiDoc(
     *   description="Возвращает объявление"
     * )
     * @Rest\Get("/{advert}", defaults={"_format": "json"})
     * @Rest\View()
     */
    public function getAction($advert)
    {
        return $this->repoAdvert->find($advert);
    }

    /**
     * @ApiDoc(
     *   description="Создание объявления"
     * )
     * @Rest\Post("/", name="iwin_advert_save")
     * @Rest\View()
     */
    public function saveAction(Request $req)
    {
        $advert = $this->serializer->deserialize(
            $req->getContent(),
            'Iwin\\Bundle\\AdvertBundle\\Entity\\Advert',
            'json'
        );
        /** @var Advert $advert */

        $this->manager->merge($advert->getCategory());

        $this->manager->persist($advert);
        $this->manager->flush();

        die();
    }
}
