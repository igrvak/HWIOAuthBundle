<?php
namespace Iwin\Bundle\AppBundle\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Intervention\Image\ImageManager;
use Iwin\Bundle\AppBundle\Entity\File;
use Iwin\Bundle\AppBundle\Entity\FileImage;
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
     * @param UploaderHelper $helper
     * @param ImageManager $manager
     */
    public function __construct(
        EntityManagerInterface $em,
        UploaderHelper $helper,
        ImageManager $manager
    )
    {
        $this->em = $em;
        $this->helper = $helper;
        $this->manager = $manager;
    }

    /**
     * @param PostPersistEvent $event
     */
    public function onUpload(PostPersistEvent $event)
    {
        /** @var \Symfony\Component\HttpFoundation\File\File $file */
        $file = $event->getFile();

        if(in_array($file->getMimeType(), [
            'image/gif',
            'image/jpeg',
            'image/png',
        ])){
            $f = new FileImage();
            $i =  $this->manager->make($file->getRealPath());
            $f->setWidth($i->width());
            $f->setHeight($i->height());
        }
        else{
            $f = new File();
        }
        $f->setMimeType($file->getMimeType());
        $f->setPath(
            $this->helper->endpoint($event->getType()) . '/' . $file->getBasename()
        );
        $this->em->persist($f);
        $this->em->flush($f);

        $ret = $event->getResponse();
        $ret['hash'] = $f->getHash();
        $ret['uri'] = 'https://www.google.com.ua/intl/en_ALL/images/srpr/logo11w.png';
    }
}