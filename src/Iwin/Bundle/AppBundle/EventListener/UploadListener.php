<?php
namespace Iwin\Bundle\AppBundle\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Intervention\Image\ImageManager;
use Iwin\Bundle\AppBundle\Entity\File;
use Iwin\Bundle\AppBundle\Entity\FileImage;
use Iwin\Bundle\AppBundle\Service\Util\FileUrlManager;
use Oneup\UploaderBundle\Event\PostPersistEvent;
use Oneup\UploaderBundle\Templating\Helper\UploaderHelper;

/**
 * @author Odesskij <odesskij1992@gmail.com>
 */
class UploadListener
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var UploaderHelper
     */
    private $helper;
    /**
     * @var ImageManager
     */
    private $manager;


    /**
     * @param EntityManagerInterface $em
     * @param UploaderHelper         $helper
     * @param ImageManager           $manager
     * @param FileUrlManager         $fileUrlManager
     */
    public function __construct(
        EntityManagerInterface $em,
        UploaderHelper $helper,
        ImageManager $manager,
        FileUrlManager $fileUrlManager
    ) {
        $this->em = $em;
        $this->helper = $helper;
        $this->manager = $manager;
        $this->fileUrlManager = $fileUrlManager;
    }

    /**
     * @param PostPersistEvent $event
     */
    public function onUpload(PostPersistEvent $event)
    {
        /** @var \Symfony\Component\HttpFoundation\File\File $file */
        $file = $event->getFile();

        if (in_array($file->getMimeType(), [
            'image/gif',
            'image/jpeg',
            'image/png',
        ])) {
            $f = new FileImage();
            $i = $this->manager->make($file->getRealPath());
            $f->setWidth($i->width());
            $f->setHeight($i->height());
        } else {
            $f = new File();
        }
        $f->setMimeType($file->getMimeType())
            ->setStorage($event->getType())
            ->setName($file->getBasename());
        $this->em->persist($f);
        $this->em->flush($f);

        $ret = $event->getResponse();
        $ret['id'] = $f->getId();
        $ret['uri'] = $this->fileUrlManager->getUrl($f);
    }
}