<?php
namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
class FaqMessage
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
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="date_created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @Serializer\Type("DateTime")
     */
    protected $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="date_update", type="datetime")
     *
     * @Serializer\Type("DateTime")
     */
    protected $updatedAt;

    /**
     * @var User|null
     *
     * @ORM\ManyToOne(targetEntity="Iwin\Bundle\AppBundle\Entity\User")
     * @ORM\JoinColumn(name="ref_user_answer", referencedColumnName="id")
     * @Serializer\Type("Iwin\Bundle\AppBundle\Entity\User")
     */
    protected $userAnswer;

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=255)
     * @Gedmo\Translatable()
     * @Serializer\Type("string")
     */
    protected $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ref_lang", type="string")
     * @Serializer\Type("string")
     */
    protected $lang;

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=200)
     * @Gedmo\Translatable()
     * @Serializer\Type("string")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text",length=200)
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

    /**
     * @param null|string $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * @return null|string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * @param \Iwin\Bundle\AppBundle\Entity\User|null $userAnswer
     */
    public function setUserAnswer(User $userAnswer)
    {
        $this->userAnswer = $userAnswer;
    }

    /**
     * @return \Iwin\Bundle\AppBundle\Entity\User|null
     */
    public function getUserAnswer()
    {
        return $this->userAnswer;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }


}
