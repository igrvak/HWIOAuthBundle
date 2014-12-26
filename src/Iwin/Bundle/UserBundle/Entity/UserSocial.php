<?php

namespace Iwin\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserSocial
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Iwin\Bundle\UserBundle\Entity\UserSocialRepository")
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
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="social_id", type="integer")
     */
    private $socialId;

    /**
     * @var string
     *
     * @ORM\Column(name="url_profile", type="string", length=255)
     */
    private $urlProfile;

    /**
     * @var string
     *
     * @ORM\Column(name="url_image", type="string", length=255)
     */
    private $urlImage;

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=255)
     */
    private $nickname;


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
     * Set userId
     *
     * @param integer $userId
     * @return UserSocial
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set socialId
     *
     * @param integer $socialId
     * @return UserSocial
     */
    public function setSocialId($socialId)
    {
        $this->socialId = $socialId;

        return $this;
    }

    /**
     * Get socialId
     *
     * @return integer 
     */
    public function getSocialId()
    {
        return $this->socialId;
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
