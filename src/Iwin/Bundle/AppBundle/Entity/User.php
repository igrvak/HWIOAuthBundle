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
     * @ORM\JoinColumn(name="ref_image_avatar", referencedColumnName="id", nullable=true)
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

    /**
     * @param \DateTime $birthdate
     */
    public function setBirthdate($birthdate)
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




}
