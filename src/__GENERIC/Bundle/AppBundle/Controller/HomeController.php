<?php
namespace __GENERIC\Bundle\AppBundle\Controller;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Werkint\Bundle\FrameworkExtraBundle\Annotation as Rest;

/**
 * Структура сайта
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class HomeController
{
    // -- Actions ---------------------------------------

    /**
     * @Rest\Get("/", name="home")
     * @Rest\View()
     */
    public function homeAction()
    {
        return [
        ];
    }
}
