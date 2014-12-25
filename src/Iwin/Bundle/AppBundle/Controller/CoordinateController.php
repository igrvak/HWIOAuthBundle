<?php
namespace Iwin\Bundle\AppBundle\Controller;

use JMS\DiExtraBundle\Annotation as DI;
use Werkint\Bundle\FrameworkExtraBundle\Annotation as Rest;

class CoordinateController
{
    // -- Actions ---------------------------------------

    /**
     * @Rest\Get("/test_coords", name="test_coords")
     * @Rest\View()
     */
    public function testIndexAction()
    {
        return [
        ];
    }
}