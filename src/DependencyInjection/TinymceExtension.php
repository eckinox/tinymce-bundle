<?php

namespace Eckinox\TinymceBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TinymceExtension extends Extension implements PrependExtensionInterface
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter.configs)
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $tinymceConfig = $this->processConfiguration($configuration, $configs);

        $container
            ->getDefinition('Eckinox\TinymceBundle\Util\TinymceConfigurator')
            ->addArgument($tinymceConfig)
        ;
    }

    public function prepend(ContainerBuilder $container): void
    {
        $container->prependExtensionConfig('twig', [
            'form_themes' => [
                '@Tinymce/form/tinymce_type.html.twig',
            ],
        ]);
    }
}
