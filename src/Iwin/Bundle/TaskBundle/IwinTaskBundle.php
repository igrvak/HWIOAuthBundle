<?php

namespace Iwin\Bundle\TaskBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * IwinTaskBundle.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class IwinTaskBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }
}
