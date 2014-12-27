<?php

namespace Iwin\Bundle\QualBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration for IwinQualBundle.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    protected $alias;

    /**
     * @param string $alias
     */
    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        // @formatter:off
        $treeBuilder
            ->root($this->alias)
            ->children()
            ->end()
        ;
        // @formatter:on

        return $treeBuilder;
    }
}
