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
     * @ORM\JoinColumn(name="ref_imageAvatar", referencedColumnName="id", nullable=true)
     * @Serializer\Type("Iwin\Bundle\SharedBundle\Entity\FileImage")
     */
    protected $imageAvatar;
    /**
     * @var Location|null
     *
     * @ORM\OneToOne(targetEntity="Iwin\Bundle\SharedBundle\Entity\Location")
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
     * @ORM\OneToMany(targetEntity="UserSocial", mappedBy="user")
     * @Serializer\Type("array<Iwin\Bundle\AppBundle\Entity\UserSocial>")
     **/
    protected $socials;

    // -- Accessors ---------------------------------------

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nameFirst
     *
     * @param string $nameFirst
     * @return User
     */
    public function setNameFirst($nameFirst)
    {
        $this->nameFirst = $nameFirst;

        return $this;
    }

    /**
     * Get nameFirst
     *
     * @return string
     */
    public function getNameFirst()
    {
        return $this->nameFirst;
    }

    /**
     * Set nameLast
     *
     * @param string $nameLast
     * @return User
     */
    public function setNameLast($nameLast)
    {
        $this->nameLast = $nameLast;

        return $this;
    }

    /**
     * Get nameLast
     *
     * @return string
     */
    public function getNameLast()
    {
        return $this->nameLast;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set chatSkype
     *
     * @param string $chatSkype
     * @return User
     */
    public function setChatSkype($chatSkype)
    {
        $this->chatSkype = $chatSkype;

        return $this;
    }

    /**
     * Get chatSkype
     *
     * @return string
     */
    public function getChatSkype()
    {
        return $this->chatSkype;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return User
     */
    public function setBirthdate(\DateTime $birthdate = null)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @param FileImage|null $imageAvatar
     */
    public function setImageAvatar(FileImage $imageAvatar = null)
    {
        $this->imageAvatar = $imageAvatar;
    }

    /**
     * @return FileImage|null
     */
    public function getImageAvatar()
    {
        return $this->imageAvatar;
    }

    /**
     * @param Location|null $location
     */
    public function setLocation(Location $location = null)
    {
        $this->location = $location;
    }

    /**
     * @return Location|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Collection|Social[] $socials
     */
    public function setSocials(Collection $socials)
    {
        $this->socials = $socials;
    }

    /**
     * @return Collection|Social[]
     */
    public function getSocials()
    {
        return $this->socials;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }
}
