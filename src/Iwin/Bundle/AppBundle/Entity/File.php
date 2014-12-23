<?php

namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Iwin\Bundle\AppBundle\Service\Util\IdGenerator;

/**
 * File Entity.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 *
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\Entity(repositoryClass="FileRepository")
 * @ORM\Table(name="iwin_app_file")
 */
class File
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hash = IdGenerator::getId();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $path;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $hash;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }


}
