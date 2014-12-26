<?php

namespace Iwin\Bundle\AdvertBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * DefaultController.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class DefaultController
{
    /**
     * @Rest\Get("/hello/{name}")
     * @Rest\View()
     */
    public function indexAction($name)
    {
        return ['name' => $name];
    }
}
