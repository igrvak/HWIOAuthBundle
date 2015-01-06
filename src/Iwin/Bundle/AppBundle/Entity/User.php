<?php
namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Iwin\Bundle\SharedBundle\Entity\FileImage;
use Iwin\Bundle\SharedBundle\Entity\Location;
use Iwin\Bundle\SharedBundle\Entity\Social;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="iwin_app_user")
 * @ORM\Entity(repositoryClass="UserRepository")
 * @Gedmo\TranslationEntity(class="Iwin\Bundle\AppBundle\Entity\UserTranslation")
 */
class User extends BaseUser implements Translatable
{
    public function __construct()
    {
        parent::__construct();

        $this->socials = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Type("string")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date")
     * @Serializer\Type("DateTime<'Y-m-d'>")
     */
    protected $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="chatSkype", type="string", length=255)
     * @Serializer\Type("string")
     */
    protected $chatSkype;

    /**
     * @var FileImage|null
     *
     * @ORM\OneToOne(targetEntity="Iwin\Bundle\SharedBundle\Entity\FileImage")
     * @ORM\JoinColumn(name="ref_image_avatar", referencedColumnName="id", nullable=true)
     * @Serializer\Type("Iwin\Bundle\SharedBundle\Entity\FileImage")
     */
    protected $imageAvatar;

    /**
     * @var Location|null
     *
     * @ORM\OneToOne(targetEntity="Iwin\Bundle\SharedBundle\Entity\Location", cascade={"persist"})
     * @ORM\JoinColumn(name="location", referencedColumnName="id", nullable=true)
     *
     * @Serializer\Type("Iwin\Bundle\SharedBundle\Entity\Location")
     */
    protected $location;

    /**
     * @var string
     *
     * @ORM\Column(name="nameFirst", type="string", length=255)
     * @Gedmo\Translatable()
     * @Serializer\Type("string")
     */
    protected $nameFirst;
    /**
     * @var string
     *
     * @ORM\Column(name="nameLast", type="string", length=255)
     * @Gedmo\Translatable()
     * @Serializer\Type("string")
     */
    protected $nameLast;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    protected $phone;

    /**
     * @var Social[]|Collection
     *
     * @ORM\OneToMany(targetEntity="UserSocial", mappedBy="user", cascade={"persist"})
     * @Serializer\Type("array<Iwin\Bundle\AppBundle\Entity\UserSocial>")
     **/
    protected $socials;


    /**
     * @ORM\OneToMany(
     *   targetEntity="Iwin\Bundle\AppBundle\Entity\UserTranslation", mappedBy="object",
     *   cascade={"persist", "remove"}
     * )
     */
    private $translations;

    /**
     * @param UserTranslation $t
     */
    public function addTranslation(UserTranslation $t)
    {
        if (!$this->translations->contains($t)) {
            $this->translations[] = $t;
            $t->setObject($this);
        }
    }
    /*
     *   Accessories
     * */

    /**
     * @param \DateTime $birthdate
     */
    public function setBirthdate(\DateTime $birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param string $chatSkype
     */
    public function setChatSkype($chatSkype)
    {
        $this->chatSkype = $chatSkype;
    }

    /**
     * @return string
     */
    public function getChatSkype()
    {
        return $this->chatSkype;
    }

    /**
     * @param \Iwin\Bundle\SharedBundle\Entity\FileImage|null $imageAvatar
     */
    public function setImageAvatar($imageAvatar)
    {
        $this->imageAvatar = $imageAvatar;
    }

    /**
     * @return \Iwin\Bundle\SharedBundle\Entity\FileImage|null
     */
    public function getImageAvatar()
    {
        return $this->imageAvatar;
    }

    /**
     * @param \Iwin\Bundle\SharedBundle\Entity\Location|null $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return \Iwin\Bundle\SharedBundle\Entity\Location|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $nameFirst
     */
    public function setNameFirst($nameFirst)
    {
        $this->nameFirst = $nameFirst;
    }

    /**
     * @return string
     */
    public function getNameFirst()
    {
        return $this->nameFirst;
    }

    /**
     * @param string $nameLast
     */
    public function setNameLast($nameLast)
    {
        $this->nameLast = $nameLast;
    }

    /**
     * @return string
     */
    public function getNameLast()
    {
        return $this->nameLast;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection|\Iwin\Bundle\SharedBundle\Entity\Social[] $socials
     */
    public function setSocials($socials)
    {
        $this->socials = $socials;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|\Iwin\Bundle\SharedBundle\Entity\Social[]
     */
    public function getSocials()
    {
        return $this->socials;
    }

}
