<?php
namespace Iwin\Bundle\AppBundle\Service\Util;

use Composer\Script\Event;

/**
 * Создает симлинки длля хуков Git
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class ComposerHook
{
    /**
     * @param Event $event
     * @throws \InvalidArgumentException
     */
    public static function installSymlinks(Event $event)
    {
        //$extras = $event->getComposer()->getPackage()->getExtra();
        $root = realpath(getcwd());
        $hooksDir = $root . '/.git/hooks';

        $commandRev = 'git rev-parse --short=12 HEAD';
        $command = 'app/console iwin:app:updateassetsversion $(' . $commandRev . ')';
        file_put_contents($root.'/app/config/parameters_hash.yml',
            "parameters:\n  iwin_app_lastcommithash: 1");
        exec($command);
        $data = join("\n", [
            '#!/bin/bash',
            '# Do not touch! generated automatically,',
            '# see ' . __FILE__,
            $command,
            '',
        ]);

        file_put_contents($hooksDir . '/post-merge', $data);
        chmod($hooksDir . '/post-merge', 0755);
        file_put_contents($hooksDir . '/post-commit', $data);
        chmod($hooksDir . '/post-commit', 0755);
    }
} 