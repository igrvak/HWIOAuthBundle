<?php
namespace __GENERIC\Model;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * AppKernel.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = [];
        $addBundles = function ($list) use (&$bundles) {
            $bundles = array_merge($bundles, $list);
        };

        // Should be first
        $addBundles([
            new \Werkint\Bundle\RequireJSBundle\WerkintRequireJSBundle(),
        ]);

        // Framework
        $addBundles([
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new \Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
            new \Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new \Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),

            new \FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new \FOS\RestBundle\FOSRestBundle(),

            new \JMS\AopBundle\JMSAopBundle(),
            new \JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new \JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new \JMS\SerializerBundle\JMSSerializerBundle(),

            new \Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new \Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),

            new \Bazinga\Bundle\JsTranslationBundle\BazingaJsTranslationBundle(),
            new \Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
        ]);

        // Debug
        if ($this->isDebug()) {
            $addBundles([
                new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle(),
                new \Sensio\Bundle\DistributionBundle\SensioDistributionBundle(),
            ]);
        }

        // Werkint
        $addBundles([
            new \Werkint\Bundle\FrameworkExtraBundle\WerkintFrameworkExtraBundle(),
            new \Werkint\Bundle\FormBundle\WerkintFormBundle(),
            new \Werkint\Bundle\RedisBundle\WerkintRedisBundle(),
            new \Werkint\Bundle\SpritesBundle\WerkintSpritesBundle(),
            new \Werkint\Bundle\WebappBundle\WerkintWebappBundle(),
        ]);
        // Основные
        $addBundles([
            new \__GENERIC\Bundle\AppBundle\__GENERICAppBundle(),
        ]);

        $addBundles([
            new \Lexik\Bundle\MonologBrowserBundle\LexikMonologBrowserBundle(),
        ]);

        return $bundles;
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $configDir = $this->getConfigDir();

        $env = explode('_', $this->getEnvironment())[0];
        $loader->load($configDir . '/config_' . $env . '.yml');
    }

    /**
     * @return string
     */
    protected function getConfigDir()
    {
        return SYMFONY_ROOT . '/config';
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function getRootDir()
    {
        return SYMFONY_ROOT;
    }
}
