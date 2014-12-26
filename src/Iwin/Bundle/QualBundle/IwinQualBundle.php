<?php
namespace Iwin\Bundle\QualBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * IwinQualBundle.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class IwinQualBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }
}
