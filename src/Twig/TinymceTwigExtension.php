<?php

namespace Eckinox\TinymceBundle\Twig;

use Eckinox\TinymceBundle\Util\TinymceConfigurator;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\Markup;
use Twig\TwigFunction;

class TinymceTwigExtension extends AbstractExtension
{
	public function __construct(
		private TinymceConfigurator $tinymceConfigurator,
	)
	{
	}

	public function getFunctions()
	{
		return [
			new TwigFunction('tinymce', [$this, 'tinymceEditor'], ['needs_environment' => true]),
		];
	}

	/**
	 * @param array<string,string> $customAttributes
	 */
	public function tinymceEditor(Environment $environment, mixed $data, array $customAttributes = []): Markup
	{
		$globalAttributes = $this->tinymceConfigurator->getGlobalAttributes();
		$attributes = array_merge($globalAttributes, $customAttributes);
		$htmlAttributes = "";

		foreach ($attributes as $key => $value) {
			$htmlAttributes .= "$key=\"$value\" ";
		}

		$elementHtml = $environment->render('@Tinymce/twig/tinymce_editor.html.twig', [
			'data' => $data,
			'attributes' => new Markup($htmlAttributes, "utf-8")
		]);

		return new Markup($elementHtml, 'utf-8');
	}
}
