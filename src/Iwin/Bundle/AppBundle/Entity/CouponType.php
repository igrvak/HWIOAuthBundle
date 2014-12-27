<?php
namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * Тип купона
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @ORM\Entity(repositoryClass="CouponTypeRepository")
 * @ORM\Table(name="iwin_shared_coupon_type")
 */
class CouponType implements
    Translatable
{
    public function __construct()
    {
        $this->hasDiscount = false;
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $class;
    /**
     * @ORM\Column(type="string")
     * @Gedmo\Translatable()
     * @var string
     */
    protected $title;
    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    protected $hasDiscount;

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
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return boolean
     */
    public function hasDiscount()
    {
        return $this->hasDiscount;
    }

    /**
     * @param boolean $hasDiscount
     * @return $this
     */
    public function setHasDiscount($hasDiscount)
    {
        $this->hasDiscount = $hasDiscount;
        return $this;
    }
}
