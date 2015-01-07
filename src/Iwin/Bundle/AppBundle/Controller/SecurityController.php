<?php

namespace Iwin\Bundle\AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @Rest\Route("/security")
 */
class SecurityController {

    /**
     * @Rest\Get("/check", name="security_check")
     * @Rest\View()
     */
    public function checkAction(){
        var_dump(func_get_args());die();        
    }
    
}