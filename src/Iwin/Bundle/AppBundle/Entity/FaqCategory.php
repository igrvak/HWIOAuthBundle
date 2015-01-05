<?php
namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Faq-category
 *
 * @author Garyk Malinovskiy <garrykmia@gmail.com>
 *
 * @ORM\Entity(repositoryClass="FaqCategoryRepository")
 * @ORM\Table(name="iwin_app_faq_category")
 */
class FaqCategory implements Translatable
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
     * @ORM\Column(type="string",length=100, unique=true)
     * @Gedmo\Translatable()
     *
     * @var string
     */
    protected $uniqName;


    /**
     * @ORM\Column(type="string",length=200)
     * @Gedmo\Translatable()
     * @var string
     */
    protected $title;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param string $isActive
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
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $uniqName
     */
    public function setUniqName($uniqName)
    {
        $this->uniqName = $uniqName;
    }

    /**
     * @return string
     */
    public function getUniqName()
    {
        return $this->uniqName;
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



}
