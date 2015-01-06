<?php

namespace Iwin\Bundle\AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Yaml\Yaml;

/**
 * LanguagesCompilerPass.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class LanguagesCompilerPass implements CompilerPassInterface
{

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $data = $this->getData($container);


        $locales = [];
        $localesSelfName = [];
        foreach ($data as $class => $language) {
            $locales[] = $class;
            $localesSelfName[$class] = $language['titles'][$class];
        }

        $container->setParameter('locales', $locales);
        $container->setParameter('locales_self_name', $localesSelfName);
    }

    /**
     * @param ContainerBuilder $container
     * @return array
     */
    public function getData(ContainerBuilder $container)
    {
        $path = $container->getParameter('iwin_app.config_directory');
        $path .= '/data/languages.yml';
        $data = Yaml::parse(file_get_contents($path));

        return $data;
    }
}
