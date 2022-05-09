# TinyMCE for your Symfony apps and forms

## Getting started

### 1. Install this package via Composer

```bash
composer require eckinox/tinymce-bundle
```

### 2. Start using TinyMCE!

#### Using TinyMCE in Symfony forms

Adding a TinyMCE editor in your Symfony forms works like any other form types:


```php
public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder->add("comment", TinymceType::class, [
        "attr" => [
            "toolbar" => "bold italic underline | bullist numlist",
        ],
    ])
    // ...
```

#### Using TinyMCE in templates or in Javascript

@TODO: Add example of basic usage in templates


## Configuring TinyMCE

This bundle includes and uses the web component version of TinyMCE. 

You can configure TinyMCE by setting HTML attributes on the editor element itself (`<tinymce-editor>`).

When using the form type, you can use the `attr` option to set the attributes.  
For example, you can set the toolbar's actions like so:

```php
public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder->add("comment", TinymceType::class, [
        "attr" => [
            "toolbar" => "bold italic underline | bullist numlist",
        ],
    ])
    // ...
```

For more information on the different configurations that TinyMCE offers, refer 
to [Tiny's web component documentation](https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/).

### Default configurations

You can set the following default options in a configuration file:

```yaml
tinymce:
    skin: "oxide" # https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/#setting-the-editor-skin
    content_css: "default" # https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/#setting-content-stylesheets
    plugins: "advlist autolink link image media table lists" # https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/#loading-plugins
    toolbar: "bold italic underline | bullist numlist" # https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/#setting-the-toolbar
    images_upload_url: "https://yoursite.com/upload" # https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/#setting-the-images-upload-url
    images_upload_route: "" # The name of the route for `images_upload_url` (leave `images_upload_url` blank if using this)
    images_upload_route_params: "" # The params of the route for `images_upload_url` (leave `images_upload_url` blank if using this)
    images_upload_handler: "" # https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/#setting-the-images-upload-handler
    images_upload_base_path: "" # https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/#setting-the-images-upload-base-path
    images_upload_credentials: "true" # https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/#setting-the-images-upload-to-have-credentials
    images_reuse_filename: "" # https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/#setting-the-images-upload-to-reuse-filenames
```


### File uploads (optional)

File uploads are not handled by default, as the process will vary from project to project.

To set this up, take a look at [Tiny's web component file upload documentation](https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/#setting-the-images-upload-url).

To help you get started, we have provided an example of what the implementation may look like. 
You can find this example in [`docs/file-upload-example.md`](./docs/file-upload-example.md).


## AppStack skin

This bundle comes with an `appstack` skin, which matches the style of the 
[AppStack Bootstrap template](https://appstack-bs5.bootlab.io/index.html). 

This skin is an extension of the tinymce-5, and it has dark mode support built-in.

To use it, simply specify it in your configuration:
```yaml
# config/packages/tinymce.yaml
tinymce:
    skin: appstack
    content_css: appstack
```


## Versions

| Bundle version | TinyMCE version | TinyMCE Web Component version |
|----------------|-----------------|-------------------------------|
| **1.0**        | 6.0.2           | 2.0.0                         |


## Contributing

Feel free to submit issues and PRs to the [eckinox/tinymce-bundle](https://github.com/eckinox/tinymce-bundle) repository on GitHub.

For more information on how to contribute, check out [CONTRIBUTING.md](./CONTRIBUTING.md).


## License

This bundle is distributed under the MIT license.

[TinyMCE](https://github.com/tinymce/tinymce) and the [TinyMCE web component](https://github.com/tinymce/tinymce-webcomponent) are developed and distributed by [Tiny®](https://www.tiny.cloud/) under the MIT license.
