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
    ) {}

    /**
     * @return array<int,TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('tinymce', [$this, 'tinymceEditor'], ['needs_environment' => true]),
            new TwigFunction('tinymce_scripts', [$this, 'tinymceScripts'], ['needs_environment' => true]),
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
            'attributes' => new Markup($htmlAttributes, "utf-8"),
        ]);

        return new Markup($elementHtml, 'utf-8');
    }

    /**
     * Renders the two scripts for TinyMCE to prepare for injection of TinyMCE
     * editor in Javascript.
     */
    public function tinymceScripts(Environment $environment): Markup
    {
        $elementHtml = $environment->render('@Tinymce/twig/tinymce_scripts.html.twig');

        return new Markup($elementHtml, 'utf-8');
    }
}
