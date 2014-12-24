<?php
namespace Iwin\Bundle\AppBundle\Service\Util;

use Iwin\Bundle\AppBundle\Entity\File;

/**
 * @author Odesskij <odesskij1992@gmail.com>
 */
class FileUrlManager
{
    /**
     * @param File $file
     * @return string
     */
    public function getUrl(File $file)
    {
        return $file->getPath();
    }
}