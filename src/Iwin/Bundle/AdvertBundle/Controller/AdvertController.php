<?php
namespace Iwin\Bundle\AdvertBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

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
     * @Rest\Get("/{advert}")
     * @Rest\View()
     */
    public function indexAction($advert)
    {
        return new Response(json_encode([
            'id'      => $advert,
            'gallery' => [
                'images' => [],
                'videos' => [],
            ],
            'coupons' => [
                [
                    'hash'=>'test',
                ],
            ],
        ]));
    }
}
