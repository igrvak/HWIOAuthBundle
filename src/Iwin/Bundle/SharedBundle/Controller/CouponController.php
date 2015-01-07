<?php
namespace Iwin\Bundle\SharedBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Iwin\Bundle\SharedBundle\Entity\Coupon;
use Iwin\Bundle\SharedBundle\Entity\CouponTypeRepository;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Управление купонами
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @Rest\Route("/coupon")
 */
class CouponController
{
    /**
     * @DI\Inject("iwin_shared.repo.coupontype")
     * @var CouponTypeRepository
     */
    private $repoCouponType;

    // -- Actions ---------------------------------------

    /**
     * @Rest\Get("/types.json", name="iwin_coupon_types", defaults={"_format": "json"})
     * @Rest\View()
     */
    public function typesAction()
    {
        $types = $this->repoCouponType->findAll();
        return $types;
    }
}
