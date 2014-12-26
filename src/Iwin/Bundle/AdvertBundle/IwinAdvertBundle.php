<?php

namespace Iwin\Bundle\AdvertBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * IwinAdvertBundle.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class IwinAdvertBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }
}
