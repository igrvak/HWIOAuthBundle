<?php
namespace Iwin\Bundle\AppBundle\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Intervention\Image\ImageManager;
use Iwin\Bundle\SharedBundle\Entity\File;
use Iwin\Bundle\SharedBundle\Entity\FileImage;
use Iwin\Bundle\AppBundle\Service\Util\FileUrlManager;
use Iwin\Bundle\SharedBundle\Service\File\FileManager;
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
     * @var FileManager
     */
    private $fileManager;
    /**
     * @var FileUrlManager
     */
    private $fileUrlManager;
    /**
     * @var ImageManager
     */
    private $manager;

    /**
     * @param EntityManagerInterface $em
     * @param ImageManager $manager
     * @param FileUrlManager $fileUrlManager
     * @param FileManager $fileManager
     */
    public function __construct(
        EntityManagerInterface $em,
        ImageManager $manager,
        FileUrlManager $fileUrlManager,
        FileManager $fileManager
    )
    {
        $this->em = $em;
        $this->manager = $manager;
        $this->fileUrlManager = $fileUrlManager;
        $this->fileManager = $fileManager;
    }

    /**
     * @param PostPersistEvent $event
     */
    public function onUpload(PostPersistEvent $event)
    {
        /** @var \Symfony\Component\HttpFoundation\File\File $file */
        $file = $event->getFile();

        $f = $this->fileManager->createFile($file, $event->getType());

        $ret = $event->getResponse();
        $ret['id'] = $f->getId();
        $ret['uri'] = $this->fileUrlManager->getUrl($f);
    }
}