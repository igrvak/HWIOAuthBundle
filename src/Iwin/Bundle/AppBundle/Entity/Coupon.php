<?php
namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Iwin\Bundle\AppBundle\Service\Util\IdGenerator;

/**
 * Купон
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @ORM\Entity(repositoryClass="CouponRepository")
 * @ORM\Table(name="iwin_app_coupon")
 */
class Coupon implements
    Translatable
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hash = IdGenerator::getId();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id;
    /**
     * @ORM\Column(type="string",length=200)
     * @Gedmo\Translatable()
     * @var string
     */
    protected $description;
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $expires;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $hash;
    /**
     * @ORM\Column(type="string",length=100)
     * @Gedmo\Translatable()
     * @var string
     */
    protected $name;
    /**
     * @ORM\ManyToOne(targetEntity="CouponType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * @var CouponType
     */
    protected $type;
    /**
     * @ORM\OneToOne(targetEntity="CouponDiscount", inversedBy="coupon")
     * @ORM\JoinColumn(name="discount_id", referencedColumnName="id", nullable=true)
     * @var CouponDiscount|null
     */
    protected $discount;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * {@inheritdoc}
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    // -- Accessors ---------------------------------------

    /**
     * @return int
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
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return $this
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
