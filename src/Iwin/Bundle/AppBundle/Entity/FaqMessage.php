<?php
namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FaqMessages
 *
 * @author Garyk Malinovskiy <garrykmia@gmail.com>
 *
 * @ORM\Entity(repositoryClass="FaqMessageRepository")
 * @ORM\Table(name="iwin_app_faq_message")
 */
class FaqMessage implements Translatable
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
     * @var User|null
     *
     * @ORM\OneToOne(targetEntity="Iwin\Bundle\AppBundle\Entity\User")
     * @ORM\JoinColumn(name="ref_user_answer", referencedColumnName="id", nullable=true)
     * @Serializer\Type("Iwin\Bundle\AppBundle\Entity\User")
     */
    protected $userAnswer;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=200)
     * @Gedmo\Translatable()
     */
    protected $name;

    /**
     * @ORM\Column(type="text",length=200)
     * @Gedmo\Translatable()
     * @var string
     */
    protected $question;

    /**
     * @ORM\Column(type="text",length=200)
     * @Gedmo\Translatable()
     * @var string
     */
    protected $answer;

    /**
     * @ORM\ManyToMany(targetEntity="Iwin\Bundle\SharedBundle\Entity\File")
     * @ORM\JoinTable(name="iwin_app_faq_message_files",
     *   joinColumns={@ORM\JoinColumn(name="ref_faq_message_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="ref_file_id", referencedColumnName="id")}
     * )
     * @Serializer\Type("array<Iwin\Bundle\SharedBundle\Entity\File>")
     * @var File[]|Collection
     */
    protected $files;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->files = new ArrayCollection();
    }

    /******************* Accessories *****************/
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

    /**
     * @param \Iwin\Bundle\AppBundle\Entity\Collection|\Iwin\Bundle\AppBundle\Entity\File[] $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * @return \Iwin\Bundle\AppBundle\Entity\Collection|\Iwin\Bundle\AppBundle\Entity\File[]
     */
    public function getFiles()
    {
        return $this->files;
    }

}
