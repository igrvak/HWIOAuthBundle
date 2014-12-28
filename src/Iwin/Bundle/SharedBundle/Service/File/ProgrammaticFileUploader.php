<?php
namespace Iwin\Bundle\SharedBundle\Service\File;

use Iwin\Bundle\AppBundle\Entity as Iwin;
use Iwin\Bundle\AppBundle\Service\Util\FileUrlManager;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @author Odesskij <odesskij1992@gmail.com>
 */
class ProgrammaticFileUploader
{
    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var string
     */
    private $webDir;

    /**
     * @var FileUrlManager
     */
    protected $urlManager;

    /**
     * @param FileManager    $fileManager
     * @param FileUrlManager $urlManager
     * @param string         $webDir
     */
    public function __construct(FileManager $fileManager, FileUrlManager $urlManager, $webDir)
    {
        $this->urlManager = $urlManager;
        $this->fileManager = $fileManager;
        $this->webDir = $webDir;
    }


    /**
     * @param string $source  full path to source file
     * @param string $gallery Gallery Id for OneupUploaderBundle
     * @return Iwin\File|Iwin\FileImage
     */
    public function upload($source, $gallery)
    {
        $f = new File($source);

        $file = $this->fileManager->createFile(
            $f,
            $gallery
        );

        $f->move($this->webDir . '/' . $this->urlManager->getUrl($file));
        return $file;
    }
}