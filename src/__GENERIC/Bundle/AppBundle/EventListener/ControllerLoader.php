<?php
namespace __GENERIC\Bundle\AppBundle\EventListener;

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
        $dir = $this->par('[[APP_NAME]]_app.scripts_dir');

        // Шрифты
        $webapp->addVar('debug', $this->par('kernel.debug'));

        $webapp->attachFile($dir . '/frontend/defines.scss');
        $webapp->attachFile($dir . '/frontend/main.scss');

        $webapp->getLoader()->blockStart('page');
    }

}
