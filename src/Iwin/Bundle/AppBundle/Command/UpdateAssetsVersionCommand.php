<?php
namespace Iwin\Bundle\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Обновляет версию ассетов
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class UpdateAssetsVersionCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('iwin:app:updateassetsversion')
            ->addArgument('hash')
            ->setDescription('UpdateAssetsVersion');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $hash = $input->getArgument('hash');
        $file = $this->getContainer()->getParameter('kernel.root_dir');
        $file .= '/config/parameters_hash.yml';

        if (!$hash) {
            throw new \Exception('Wrong arguments');
        }

        file_put_contents($file, join("\n", [
            'parameters:',
            '  iwin_app_lastcommithash: ' . $hash,
        ]));
    }
}
