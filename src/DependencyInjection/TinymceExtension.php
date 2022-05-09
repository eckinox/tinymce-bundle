<?php

namespace Eckinox\TinymceBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TinymceExtension extends Extension
{
	/**
	 * @SuppressWarnings(PHPMD.UnusedFormalParameter.configs)
	 */
	public function load(array $configs, ContainerBuilder $container): void
	{
		$loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
		$loader->load('services.yaml');
		$loader->load('packages/twig.yaml');

		$configuration = new Configuration();
		$config = $this->processConfiguration($configuration, $configs);

		if (!empty($config['api_key'])) {
			$container
				->getDefinition('Eckinox\TinymceBundle\Form\Type\TinymceType')
				->addArgument($config['api_key']);
		}
	}
}
