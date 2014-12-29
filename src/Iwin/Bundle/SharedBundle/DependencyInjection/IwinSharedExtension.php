<?php
namespace Iwin\Bundle\SharedBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * IwinSharedExtension.
 *
 * @author Igor Malinovskiy <garrykmia@gmail.com>
 */
class IwinSharedExtension extends Extension implements
    PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        // TODO: remove нафиг
        $baseDir = realpath(__DIR__ . '/../Resources/scripts/jsmodel');

        $container->prependExtensionConfig(
            'werkint_require_js', [
                'base_dir' => $baseDir,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configDir = realpath(__DIR__ . '/../Resources/config');
        $container->setParameter(
            $this->getAlias() . '.scripts_dir',
            realpath(__DIR__ . '/../Resources/scripts')
        );
        $container->setParameter(
            $this->getAlias() . '.jsmodeldir',
            realpath(__DIR__ . '/../Resources/scripts/jsmodel')
        );

        $container->setParameter(
            $this->getAlias() . '.config_directory',
            $configDir
        );
        $loader = new YamlFileLoader(
            $container,
            new FileLocator($configDir)
        );
        $loader->load('services.yml');
        $loader->load('doctrine.yml');
    }
}
