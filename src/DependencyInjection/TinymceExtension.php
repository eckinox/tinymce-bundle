<?php

namespace Eckinox\TinymceBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Routing\RouterInterface;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TinymceExtension extends Extension implements PrependExtensionInterface
{
	private function __construct(
		private RouterInterface $router
	)
	{
	}

	/**
	 * @SuppressWarnings(PHPMD.UnusedFormalParameter.configs)
	 */
	public function load(array $configs, ContainerBuilder $container): void
	{
		$loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
		$loader->load('services.yaml');

		$configuration = new Configuration();
		$tinyMceConfig = $this->processConfiguration($configuration, $configs);
		$this->loadTinyMceDefaults($tinyMceConfig, $container);
	}

	public function prepend(ContainerBuilder $container): void
	{
		$container->prependExtensionConfig('twig', [
			'form_themes' => [
				'@Tinymce/form/tinymce_type.html.twig'
			]
		]);
	}

	/**
	 * @param array<string,mixed> $defaultConfig
	 */
	private function loadTinyMceDefaults(array $defaultConfig, ContainerBuilder $container): void
	{
		if (empty($defaultConfig["images_upload_url"]) && !empty($defaultConfig["images_upload_route"])) {
			$defaultConfig["images_upload_url"] = $this->router->generate(
				$defaultConfig["images_upload_route"],
				$defaultConfig["images_upload_route_params"] ?? [],
				RouterInterface::ABSOLUTE_URL
			);
		}

		unset($defaultConfig["images_upload_route"]);
		unset($defaultConfig["images_upload_route_params"]);

		foreach ($defaultConfig as $key => $value) {
			if ($value === "") {
				unset($defaultConfig[$key]);
			}
		}

		$container
			->getDefinition('Eckinox\TinymceBundle\Form\Type\TinymceType')
			->addArgument($defaultConfig);
	}
}
