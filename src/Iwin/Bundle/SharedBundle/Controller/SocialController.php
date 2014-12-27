<?php
namespace Iwin\Bundle\SharedBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Iwin\Bundle\SharedBundle\Entity\SocialRepository;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Управление социалками
 *
 * @author Igor Malinovskiy <garrykmia@gmail.com>
 * @Rest\Route("/social")
 */
class SocialController
{
    /**
     * @DI\Inject("iwin_app.repo.social")
     * @var SocialRepository
     */
    private $socialRepo;

    // -- Actions ---------------------------------------
    /**
     * @Rest\Get("/list.json", name="iwin_social_list", defaults={"_format": "json"})
     * @Rest\View()
     */
    public function listAction()
    {
        $social = $this->socialRepo->findAll();
        return $social;
    }
}
