<?php
namespace Iwin\Bundle\QualBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Iwin\Bundle\AppBundle\Entity\Gallery;
use Iwin\Bundle\AppBundle\Entity\Location;
use JMS\Serializer\Annotation as Serializer;

/**
 * Таск
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @ORM\Entity(repositoryClass="TaskRepository")
 * @ORM\Table(name="iwin_qual_task")
 */
class Task
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setLocations(new ArrayCollection());

        if (!$this->gallery) {
            $this->setGallery(new Gallery());
        }
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     * @Serializer\Type("string")
     * @var string
     */
    protected $id;
    /**
     * @ORM\ManyToMany(targetEntity="\Iwin\Bundle\AppBundle\Entity\Location",cascade={"all"})
     * @ORM\JoinTable(name="iwin_qual_task_locations",
     *   joinColumns={@ORM\JoinColumn(name="task_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="location_id", referencedColumnName="id")}
     * )
     * @Serializer\Type("array<Iwin\Bundle\AppBundle\Entity\Location>")
     * @var Location[]|Collection
     */
    protected $locations;
    /**
     * @ORM\OneToOne(targetEntity="\Iwin\Bundle\AppBundle\Entity\Gallery",cascade={"all"})
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id", nullable=false)
     * @Serializer\Type("Iwin\Bundle\AppBundle\Entity\Gallery")
     * @var Gallery
     */
    protected $gallery;

    // -- Accessors ---------------------------------------

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param Gallery $gallery
     * @return $this
     */
    public function setGallery(Gallery $gallery = null)
    {
        $this->gallery = $gallery;
        return $this;
    }

    /**
     * @return Collection|Location[]
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @param Collection|Location[] $locations
     * @return $this
     */
    public function setLocations(Collection $locations)
    {
        $this->locations = $locations;
        return $this;
    }
}
