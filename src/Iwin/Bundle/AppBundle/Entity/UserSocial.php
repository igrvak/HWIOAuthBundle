<?php
namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Iwin\Bundle\SharedBundle\Entity\Social;
use JMS\Serializer\Annotation as Serializer;

/**
 * UserSocial
 *
 * @ORM\Table(name="iwin_app_users_socials")
 * @ORM\Entity(repositoryClass="UserSocialRepository")
 */
class UserSocial
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
     * @ORM\Column(name="id_social", type="string")
     * @var string
     */
    protected $idSocial;
    /**
     * @ORM\Column(name="nickname", type="string", length=255)
     * @var string
     */
    protected $nickname;
    /**
     * @ORM\ManyToOne(targetEntity="Iwin\Bundle\SharedBundle\Entity\Social")
     * @ORM\JoinColumn(name="social_id", referencedColumnName="id")
     * @var Social
     */
    protected $social;
    /**
     * @ORM\Column(name="url_image", type="string", length=255)
     * @var string
     */
    protected $urlImage;
    /**
     * @ORM\Column(name="url_profile", type="string", length=255)
     * @var string
     */
    protected $urlProfile;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="socials")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    protected $user;

    // -- Accessors ---------------------------------------

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIdSocial()
    {
        return $this->idSocial;
    }

    /**
     * @param string $idSocial
     * @return $this
     */
    public function setIdSocial($idSocial)
    {
        $this->idSocial = $idSocial;
        return $this;
    }

    /**
     * @return Social
     */
    public function getSocial()
    {
        return $this->social;
    }

    /**
     * @param Social $social
     * @return $this
     */
    public function setSocial(Social $social)
    {
        $this->social = $social;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Set urlProfile
     *
     * @param string $urlProfile
     * @return UserSocial
     */
    public function setUrlProfile($urlProfile)
    {
        $this->urlProfile = $urlProfile;

        return $this;
    }

    /**
     * Get urlProfile
     *
     * @return string
     */
    public function getUrlProfile()
    {
        return $this->urlProfile;
    }

    /**
     * Set urlImage
     *
     * @param string $urlImage
     * @return UserSocial
     */
    public function setUrlImage($urlImage)
    {
        $this->urlImage = $urlImage;

        return $this;
    }

    /**
     * Get urlImage
     *
     * @return string
     */
    public function getUrlImage()
    {
        return $this->urlImage;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     * @return UserSocial
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }
}
