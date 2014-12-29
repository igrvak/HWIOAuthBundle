<?php
namespace Iwin\Bundle\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity()
 * @ORM\Table(name="iwin_shared_location")
 */
class Location
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
     * @ORM\Column(type="string")
     * @var string
     */
    protected $address;

    /**
     * @ORM\Column(type="float")
     * @var float
     */
    protected $posLat;
    /**
     * @ORM\Column(type="float")
     * @var float
     */
    protected $posLong;

    // -- Accessors ---------------------------------------

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return float
     */
    public function getPosLat()
    {
        return $this->posLat;
    }

    /**
     * @param float $posLat
     * @return $this
     */
    public function setPosLat($posLat)
    {
        $this->posLat = $posLat;
        return $this;
    }

    /**
     * @return float
     */
    public function getPosLong()
    {
        return $this->posLong;
    }

    /**
     * @param float $posLong
     * @return $this
     */
    public function setPosLong($posLong)
    {
        $this->posLong = $posLong;
        return $this;
    }
}
