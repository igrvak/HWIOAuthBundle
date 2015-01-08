<?php
namespace Iwin\Bundle\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Купон
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @ORM\Entity(repositoryClass="CouponRepository")
 * @ORM\Table(name="iwin_shared_coupontranslation")
 */
class CouponTranslation
{
    use ORMBehaviors\Translatable\Translation;

    /**
     * @ORM\Column(type="string",length=200)
     * @var string
     */
    protected $description;
    /**
     * @ORM\Column(type="string",length=100)
     * @Assert\NotBlank(message="iwin_app.coupon.name")
     * @var string
     */
    protected $name;

    // -- Accessors ---------------------------------------

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
}
