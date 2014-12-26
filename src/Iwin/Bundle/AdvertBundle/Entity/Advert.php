<?php
namespace Iwin\Bundle\AdvertBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Iwin\Bundle\AppBundle\Entity\Coupon;
use Iwin\Bundle\AppBundle\Entity\Gallery;
use JMS\Serializer\Annotation as Serializer;

/**
 * Объявление
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @ORM\Entity(repositoryClass="AdvertRepository")
 * @ORM\Table(name="iwin_advert_advert")
 */
class Advert
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setCoupons(new ArrayCollection());

        if (!$this->gallery) {
            $this->setGallery(new Gallery());
        }
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     * @Serializer\Type("string")
     * @var string
     */
    protected $id;
    /**
     * @ORM\ManyToMany(targetEntity="\Iwin\Bundle\AppBundle\Entity\Coupon",cascade={"all"})
     * @ORM\JoinTable(name="iwin_advert_advert_coupons",
     *   joinColumns={@ORM\JoinColumn(name="advert_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="coupon_id", referencedColumnName="id")}
     * )
     * @Serializer\Type("array<Iwin\Bundle\AppBundle\Entity\Coupon>")
     * @var Coupon[]|Collection
     */
    protected $coupons;
    /**
     * @ORM\OneToOne(targetEntity="\Iwin\Bundle\AppBundle\Entity\Gallery",cascade={"all"})
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id", nullable=false)
     * @Serializer\Type("Iwin\Bundle\AppBundle\Entity\Gallery")
     * @var Gallery
     */
    protected $gallery;

    // -- Accessors ---------------------------------------

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param Gallery $gallery
     * @return $this
     */
    public function setGallery(Gallery $gallery = null)
    {
        $this->gallery = $gallery;
        return $this;
    }

    /**
     * @return Collection|Coupon[]
     */
    public function getCoupons()
    {
        return $this->coupons;
    }

    /**
     * @param Collection|Coupon[] $coupons
     * @return $this
     */
    public function setCoupons(Collection $coupons)
    {
        $this->coupons = $coupons;
        return $this;
    }
}
