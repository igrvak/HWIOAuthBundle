<?php
namespace Iwin\Bundle\SharedBundle\Service\File;

use Iwin\Bundle\AppBundle\Entity\File;
use Iwin\Bundle\AppBundle\Service\Util\FileUrlManager;

/**
 * @author Odesskij <odesskij1992@gmail.com>
 */
class ProgrammaticFileUploader
{

    /**
     * @var FileUrlManager
     */
    protected $urlManager;

    /**
     * @param FileUrlManager $urlManager
     */
    public function __construct(FileUrlManager $urlManager)
    {
        $this->urlManager = $urlManager;
    }


    /**
     * @param string $source full path to source file
     * @param string $gallery Gallery Id for OneupUploaderBundle
     * @return File
     */
    public function upload($source, $gallery)
    {
        return new File();
    }
}