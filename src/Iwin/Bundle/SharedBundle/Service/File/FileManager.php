<?php
namespace Iwin\Bundle\SharedBundle\Service\File;

use Doctrine\ORM\EntityManagerInterface;
use Intervention\Image\ImageManager;
use Iwin\Bundle\SharedBundle\Entity as Iwin;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @author Odesskij <odesskij1992@gmail.com>
 */
class FileManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ImageManager
     */
    private $manager;

    /**
     * @param EntityManagerInterface $em
     * @param ImageManager $manager
     */
    public function __construct(
        EntityManagerInterface $em,
        ImageManager $manager
    )
    {
        $this->em = $em;
        $this->manager = $manager;
    }

    /**
     * @param File $file
     * @param string $gallery Gallery Id for OneupUploaderBundle
     * @return Iwin\File
     */
    public function createFile(File $file, $gallery)
    {
        if (in_array($file->getMimeType(), [
            'image/gif',
            'image/jpeg',
            'image/png',
        ])) {
            $f = new Iwin\FileImage();
            $i = $this->manager->make($file->getRealPath());
            $f->setWidth($i->width());
            $f->setHeight($i->height());
        } else {
            $f = new Iwin\File();
        }
        $f->setMimeType($file->getMimeType())
            ->setStorage($gallery)
            ->setName($file->getBasename());
        $this->em->persist($f);
        $this->em->flush($f);

        return $f;
    }
}