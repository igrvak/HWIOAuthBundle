<?php
namespace Iwin\Bundle\AppBundle\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Iwin\Bundle\AppBundle\Entity\Image;
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
     * @param EntityManagerInterface $em
     * @param UploaderHelper $helper
     */
    public function __construct(EntityManagerInterface $em, UploaderHelper $helper)
    {
        $this->em = $em;
        $this->helper = $helper;
    }

    /**
     * @param PostPersistEvent $event
     */
    public function onUpload(PostPersistEvent $event)
    {
        /** @var \Symfony\Component\HttpFoundation\File\File $file */
        $file = $event->getFile();
        $image = new Image();
        $image->setPath(
            $this->helper->endpoint($event->getType()) . '/' . $file->getBasename()
        );
        $this->em->persist($image);
        $this->em->flush($image);

        $event->getResponse()['reference'] = $image->getHash();
    }
}