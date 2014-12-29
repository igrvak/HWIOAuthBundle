<?php

namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Iwin\Bundle\SharedBundle\Entity\Social;

/**
 * UserSocial
 *
 * @ORM\Table(name="iwin_app_users_socials")
 * @ORM\Entity(repositoryClass="UserSocialRepository")
 */
class UserSocial
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Iwin\Bundle\AppBundle\Entity\User", inversedBy="socials")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var Social
     * @ORM\ManyToOne(targetEntity="Iwin\Bundle\SharedBundle\Entity\Social")
     * @ORM\JoinColumn(name="social_id", referencedColumnName="id")
     */
    protected $social;

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=255)
     */
    protected $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="url_image", type="string", length=255)
     */
    protected $urlImage;

    /**
     * @var string
     * @ORM\Column(name="url_profile", type="string", length=255)
     */
    protected $urlProfile;


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
     * @param \Iwin\Bundle\SharedBundle\Entity\Social $social
     */
    public function setSocial($social)
    {
        $this->social = $social;
    }

    /**
     * @return \Iwin\Bundle\SharedBundle\Entity\Social
     */
    public function getSocial()
    {
        return $this->social;
    }

    /**
     * @param \Iwin\Bundle\AppBundle\Entity\User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return \Iwin\Bundle\AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
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
