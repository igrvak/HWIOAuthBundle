<?php

namespace Iwin\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Iwin\Bundle\UserBundle\Entity\UserRepository")
 * @Gedmo\TranslationEntity(class="Iwin\Bundle\UserBundle\Entity\UserTranslation")
 */
class User extends BaseUser implements Translatable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nameFirst", type="string", length=255)
     * @Gedmo\Translatable()
     */
    private $nameFirst;

    /**
     * @var string
     *
     * @ORM\Column(name="nameLast", type="string", length=255)
     * @Gedmo\Translatable()
     */
    private $nameLast;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="chatSkype", type="string", length=255)
     */
    private $chatSkype;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date")
     */
    private $birthdate;


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
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
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
