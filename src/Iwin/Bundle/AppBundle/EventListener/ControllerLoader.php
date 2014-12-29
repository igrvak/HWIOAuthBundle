<?php
namespace Iwin\Bundle\AppBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Выполняет настройку веб-приложения
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class ControllerLoader
{
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    // -- Services ---------------------------------------

    protected function serviceWebapp()
    {
        return $this->container->get('werkint.webapp');
    }

    // -- Methods ---------------------------------------

    protected function par($name)
    {
        return $this->container->getParameter($name);
    }

    // -- Actions ---------------------------------------

    protected $init = false;

    public function initController()
    {
        if ($this->init) {
            return;
        }
        $this->init = true;

        date_default_timezone_set($this->par('timezone'));

        // Подключаем скрипты
        $webapp = $this->serviceWebapp();

        $webapp->getLoader()->blockStart('_root');

        // Скрипты бандла
        $dir = $this->par('iwin_app.scripts_dir');

        // Переменные для JS
        $webapp->addVar('debug', $this->par('kernel.debug'));
        $webapp->addVar('socials', $this->par('socials_pub'));

        $webapp->attachFile($dir . '/frontend/defines.scss');
        $webapp->attachFile($dir . '/frontend/messages.scss');
        $webapp->attachFile($dir . '/frontend/tooltip.scss');

        $webapp->getLoader()->blockStart('page');
    }

}
