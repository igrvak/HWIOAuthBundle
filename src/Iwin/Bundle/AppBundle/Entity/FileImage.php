<?php
namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * FileImage Entity.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 *
 * @ORM\Entity(repositoryClass="ImageRepository")
 * @Serializer\ExclusionPolicy("none")
 */
class FileImage extends File
{
    /**
     * @ORM\Column(type="integer")
     * @Serializer\Type("integer")
     * @var string
     */
    protected $height;
    /**
     * @ORM\Column(type="integer")
     * @Serializer\Type("integer")
     * @var string
     */
    protected $ordinal;
    /**
     * @ORM\Column(type="integer")
     * @Serializer\Type("integer")
     * @var string
     */
    protected $width;

    // -- Accessors ---------------------------------------

    /**
     * @return string
     */
    public function getOrdinal()
    {
        return $this->ordinal;
    }

    /**
     * @param string $ordinal
     * @return $this
     */
    public function setOrdinal($ordinal)
    {
        $this->ordinal = $ordinal;
        return $this;
    }

    /**
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param string $width
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param string $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }
}
