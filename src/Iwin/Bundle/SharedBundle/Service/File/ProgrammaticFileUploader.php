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
     * @param FileManager $fileManager
     * @param FileUrlManager $urlManager
     * @param string $webDir
     */
    public function __construct(FileManager $fileManager, FileUrlManager $urlManager, $webDir)
    {
        $this->urlManager = $urlManager;
        $this->fileManager = $fileManager;
        $this->webDir = $webDir;
    }


    /**
     * @param string $source full path to source file
     * @param string $gallery Gallery Id for OneupUploaderBundle
     * @return Iwin\File
     */
    public function upload($source, $gallery)
    {

        $oldFile = sys_get_temp_dir() . '/' . uniqid() . '.' . pathinfo($source, PATHINFO_EXTENSION);
        copy($source, $oldFile);
        $f = new File($oldFile);

        $file = $this->fileManager
            ->createFile(
                $f,
                $gallery
            );

        $newFile = $this->webDir . '/' . $this->urlManager->getDir($file);
        $f->move($newFile);
        return $file;
    }
}