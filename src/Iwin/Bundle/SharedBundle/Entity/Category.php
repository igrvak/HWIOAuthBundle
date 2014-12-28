<?php
namespace Iwin\Bundle\SharedBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Iwin\Bundle\AppBundle\Entity\FileImage;
use JMS\Serializer\Annotation as Serializer;

/**
 * Категория: общая сущность
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @ORM\Entity(repositoryClass="CategoryRepository")
 * @ORM\Table(name="iwin_shared_category")
 * @Gedmo\Tree(type="materializedPath")
 * @Serializer\ExclusionPolicy("all")
 */
class Category implements
    Translatable
{
    public function __construct()
    {
        $this->setChildren(new ArrayCollection());
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Gedmo\TreePathSource
     * @Serializer\Type("integer")
     * @Serializer\Expose
     * @var integer
     */
    protected $id;
    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent", cascade={"persist"})
     * @var Category[]|Collection
     */
    protected $children;
    /**
     * @ORM\ManyToOne(targetEntity="Iwin\Bundle\AppBundle\Entity\FileImage", cascade={"persist"})
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     * @Serializer\Expose
     * @var FileImage|null
     */
    protected $image;
    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer", nullable=true)
     * @var integer
     */
    protected $level;
    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children", cascade={"persist"})
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     * @var Category
     */
    protected $parent;
    /**
     * @Gedmo\TreePath
     * @ORM\Column(name="path", type="string", length=3000, nullable=true)
     * @var string
     */
    protected $path;
    /**
     * @Gedmo\Translatable()
     * @ORM\Column(name="title", type="string", length=100)
     * @Serializer\Expose
     * @var string
     */
    protected $title;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * {@inheritdoc}
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    // -- Accessors ---------------------------------------

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return FileImage|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param FileImage|null $image
     * @return $this
     */
    public function setImage(FileImage $image = null)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     * @return $this
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     * @return $this
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param Collection|Category[] $children
     * @return $this
     */
    public function setChildren($children)
    {
        $this->children = $children;
        return $this;
    }
}
