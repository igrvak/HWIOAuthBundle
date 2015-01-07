<?php
namespace Iwin\Bundle\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * Social
 *
 * @ORM\Table(name="iwin_shared_social")
 * @ORM\Entity(repositoryClass="SocialRepository")
 */
class Social
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
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive;
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    protected $type;

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
     * Set type
     *
     * @param string $type
     * @return Social
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Social
     */
    public function setIsActive($title)
    {
        $this->isActive = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

}
