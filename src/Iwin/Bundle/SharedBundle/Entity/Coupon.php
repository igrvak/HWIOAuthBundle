<?php
namespace Iwin\Bundle\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Купон
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @ORM\Entity(repositoryClass="CouponRepository")
 * @ORM\Table(name="iwin_shared_coupon")
 *
 * Переводные методы:
 * @method CouponTranslation translate
 * @method string getName()
 * @method string setName(string $name)
 */
class Coupon
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     * @Serializer\Type("string")
     * @var string
     */
    protected $id;
    /**
     * @ORM\OneToOne(targetEntity="CouponDiscount", inversedBy="coupon")
     * @ORM\JoinColumn(name="discount_id", referencedColumnName="id", nullable=true)
     * @var CouponDiscount|null
     */
    protected $discount;
    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message="iwin_app.coupon.expires")
     * @var \DateTime
     */
    protected $expires;
    /**
     * @ORM\ManyToOne(targetEntity="CouponType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull(message="iwin_app.coupon.type")
     * @var CouponType
     */
    protected $type;

    // -- Translations ---------------------------------------

    /**
     * @Serializer\Type("array<Iwin\Bundle\SharedBundle\Entity\CouponTranslation>")
     * @var array
     */
    protected $translations;

    // Мы - переводимы!
    use Translatable;

    // -- Accessors ---------------------------------------

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return CouponDiscount|null
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param CouponDiscount|null $discount
     * @return $this
     */
    public function setDiscount(CouponDiscount $discount = null)
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @return CouponType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param CouponType $type
     * @return $this
     */
    public function setType(CouponType $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param \DateTime $expires
     * @return $this
     */
    public function setExpires(\DateTime $expires)
    {
        $this->expires = $expires;
        return $this;
    }
}
