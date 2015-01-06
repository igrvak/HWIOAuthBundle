<?php
namespace Iwin\Bundle\SharedBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * Галерея видео/картинок
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @ORM\Entity()
 * @ORM\Table(name="iwin_shared_gallery")
 */
class Gallery
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
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
     * @ORM\ManyToMany(targetEntity="FileImage")
     * @ORM\JoinTable(name="iwin_app_gallery_images",
     *   joinColumns={@ORM\JoinColumn(name="gallery_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id")}
     * )
     * @Serializer\Type("array<Iwin\Bundle\SharedBundle\Entity\FileImage>")
     * @var FileImage[]|Collection
     */
    protected $images;
    /**
     * @ORM\ManyToMany(targetEntity="Video")
     * @ORM\JoinTable(name="iwin_app_gallery_videos",
     *   joinColumns={@ORM\JoinColumn(name="gallery_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="video_id", referencedColumnName="id")}
     * )
     * @Serializer\Type("array<Iwin\Bundle\SharedBundle\Entity\Video>")
     * @var Video[]|Collection
     */
    protected $videos;

    // -- Accessors ---------------------------------------

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Collection|FileImage[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Collection|FileImage[] $images
     * @return $this
     */
    public function setImages(Collection $images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param Collection|Video[] $videos
     * @return $this
     */
    public function setVideos(Collection $videos)
    {
        $this->videos = $videos;
        return $this;
    }
}
