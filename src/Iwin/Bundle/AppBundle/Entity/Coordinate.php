<?php
namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\Entity(repositoryClass="CoordinateRepository")
 * @ORM\Table(name="iwin_app_coordinate")
 */
class Coordinate {

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
    protected $address;
    /**
     * @ORM\Column(type="float")
     * @var float
     */
    protected $latitude;
    /**
     * @ORM\Column(type="float")
     * @var float
     */
    protected $longitude;
}