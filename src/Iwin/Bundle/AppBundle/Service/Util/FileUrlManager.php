<?php
namespace Iwin\Bundle\AppBundle\Service\Util;

use Iwin\Bundle\AppBundle\Entity\File;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\GenericSerializationVisitor;

/**
 * @author Odesskij <odesskij1992@gmail.com>
 */
class FileUrlManager implements
    EventSubscriberInterface
{
    /**
     * @param File $file
     * @return string
     */
    public function getUrl(File $file)
    {
        return $this->getDir($file) . '/' . $file->getName();
    }

    /**
     * @param File $file
     * @return string
     */
    public function getDir(File $file)
    {
        return '/uploads/' . $file->getStorage();
    }

    /**
     * {@inheritdoc}
     */
    static public function getSubscribedEvents()
    {
        return [[
            'event'  => 'serializer.post_serialize',
            'class'  => 'Iwin\Bundle\AppBundle\Entity\FileImage',
            'method' => 'onPostSerialize',
        ]];
    }

    /**
     * @param ObjectEvent $event
     * @throws \Exception
     */
    public function onPostSerialize(ObjectEvent $event)
    {
        $visitor = $event->getVisitor();
        /** @var GenericSerializationVisitor $visitor */
        $object = $event->getObject();
        if (!$object instanceof File) {
            throw new \Exception('Wrong class');
        }
        $visitor->addData('uri', $this->getUrl($object));
    }
}