<?php

namespace Eckinox\TinymceBundle\Util;

use Symfony\Component\Routing\RouterInterface;

class TinymceConfigurator
{
    /**
     * @var array<string,string>|null
     */
    private ?array $globalAttributes = null;

    /**
     * @param array<string,mixed>|null $userConfig
     */
    public function __construct(
        private ?array $userConfig,
        private RouterInterface $router,
    ) {}

    /**
     * Returns the global HTML attributes for the TinyMCE editor.
     *
     * This takes into account user configuration defined in config files,
     * and default attributes defined by the bundle.
     *
     * @return array<string,string>
     */
    public function getGlobalAttributes(): array
    {
        if ($this->globalAttributes === null) {
            $userAttributes = $this->processUserConfig($this->userConfig);
            $attributes = array_merge($this->getDefaultAttributes(), $userAttributes);
            $this->globalAttributes = array_filter($attributes, fn($value) => $value != "");
        }

        return $this->globalAttributes;
    }

    /**
     * Parses the tinymce config to generate the attributes.
     *
     * @param array<string,mixed> $config
     *
     * @return array<string,string>
     */
    private function processUserConfig(array $config): array
    {
        if (empty($config["images_upload_url"]) && !empty($config["images_upload_route"])) {
            $config["images_upload_url"] = $this->router->generate(
                $config["images_upload_route"],
                $config["images_upload_route_params"] ?? [],
                RouterInterface::ABSOLUTE_URL
            );
        }

        unset($config["images_upload_route"]);
        unset($config["images_upload_route_params"]);

        return $config;
    }

    /**
     * @return array<string,string>
     */
    private function getDefaultAttributes(): array
    {
        return [
            'plugins' => "advlist autolink link image media table lists",
            'menubar' => "false",
            'toolbar' => "bold italic underline | bullist numlist | table quickimage link",
            'height' => "12em",
            'images_upload_credentials' => "true",
        ];
    }
}
