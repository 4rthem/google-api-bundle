<?php

namespace Arthem\Bundle\GoogleApiBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ArthemGoogleApiExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('infrastructure/client.yml');

        $apiKey   = $config['api_key'];
        $services = $config['services'];
        if (true === $services['places']['enabled']) {
            $this->loadPlaces($container, $loader, $apiKey);
        }
    }

    /**
     * @param LoaderInterface $loader
     */
    private function loadPlaces(ContainerBuilder $container, LoaderInterface $loader, $apiKey)
    {
        $loader->load('domain/places.yml');
        $loader->load('infrastructure/places.yml');

        $definition = $container->getDefinition('arthem.google_api.place.client');
        $definition->replaceArgument(2, $apiKey);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'arthem_google_api';
    }
}
