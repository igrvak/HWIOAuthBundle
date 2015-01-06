<?php
namespace Iwin\Bundle\AppBundle;

use Iwin\Bundle\AppBundle\DependencyInjection\Compiler\LanguagesCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * IwinAppBundle.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class IwinAppBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {

        $container->addCompilerPass(new LanguagesCompilerPass());
        parent::build($container);
    }
}
