<?php

namespace Iwin\Bundle\SharedBundle\Command;

use Iwin\Bundle\SharedBundle\Service\File\ProgrammaticFileUploader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * TestCommand.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class ProgrammaticFileUploaderExampleCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('iwin:programmatic:upload')
            ->addArgument('source', InputArgument::REQUIRED)
            ->addArgument('gallery', InputArgument::REQUIRED);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ProgrammaticFileUploader $uploader */
        $uploader = $this->getContainer()->get('iwin_shared.file.programmaticfileuploader');

        $file = $uploader->upload($input->getArgument('source'), $input->getArgument('gallery'));

        var_dump($file);
    }
}
