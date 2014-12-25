<?php
namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Скидка в купоне
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @ORM\Entity()
 * @ORM\Table(name="iwin_app_coupon_discount")
 */
class CouponDiscount
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id;
    /**
     * @ORM\Column(type="float")
     * @var float
     */
    protected $amount;
    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    protected $isAbsolute;
    /**
     * @ORM\OneToOne(targetEntity="Coupon", mappedBy="discount")
     * @var Coupon
     */
    protected $coupon;

    // -- Accessors ---------------------------------------

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Coupon
     */
    public function getCoupon()
    {
        return $this->coupon;
    }

    /**
     * @param Coupon $coupon
     * @return $this
     */
    public function setCoupon(Coupon $coupon)
    {
        $this->coupon = $coupon;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isAbsolute()
    {
        return $this->isAbsolute;
    }

    /**
     * @param boolean $isAbsolute
     * @return $this
     */
    public function setIsAbsolute($isAbsolute)
    {
        $this->isAbsolute = $isAbsolute;
        return $this;
    }
}
