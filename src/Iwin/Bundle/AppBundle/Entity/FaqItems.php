<?php
namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FaqItems
 *
 * @author Garyk Malinovskiy <garrykmia@gmail.com>
 *
 * @ORM\Entity(repositoryClass="FaqItemsRepository")
 * @ORM\Table(name="iwin_app_faq_items")
 */
class FaqItems implements Translatable
{
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
     *  @var integer
     *
     * @ORM\Column(name="position", type="integer")
     * @Serializer\Type("integer")
     */
    protected $position;

    /**
     * @var boolean
     * @Serializer\Type("boolean")
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="date_created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="date_update", type="datetime")
     */
    protected $updatedAt;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=200)
     * @Gedmo\Translatable()
     * @Serializer\Type("string")
     */
    protected $question;

    /**
     * @var string
     *
     * @ORM\Column(type="text",length=200)
     * @Gedmo\Translatable()
     * @Serializer\Type("string")
     */
    protected $answer;

    /**
     * @var User|null
     *
     * @ORM\OneToOne(targetEntity="Iwin\Bundle\AppBundle\Entity\User")
     * @ORM\JoinColumn(name="ref_user_owner", referencedColumnName="id", nullable=true)
     * @Serializer\Type("Iwin\Bundle\AppBundle\Entity\User")
     */
    protected $userOwner;

    /**
     * @var FaqCategory|null
     *
     * @ORM\OneToOne(targetEntity="Iwin\Bundle\AppBundle\Entity\FaqCategory")
     * @ORM\JoinColumn(name="ref_category", referencedColumnName="id", nullable=true)
     * @Serializer\Type("Iwin\Bundle\AppBundle\Entity\FaqCategory")
     */
    protected $category;


    /***************  Accessories  **************/


    /**
     * @param string $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    /**
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param \Iwin\Bundle\AppBundle\Entity\FaqCategory|null $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return \Iwin\Bundle\AppBundle\Entity\FaqCategory|null
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \Iwin\Bundle\AppBundle\Entity\User|null $userOwner
     */
    public function setUserOwner($userOwner)
    {
        $this->userOwner = $userOwner;
    }

    /**
     * @return \Iwin\Bundle\AppBundle\Entity\User|null
     */
    public function getUserOwner()
    {
        return $this->userOwner;
    }

}
