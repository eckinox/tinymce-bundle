# Contributing

## Updating TinyMCE

To update TinyMCE to a newer version, run the following commands:

```bash
# Remove existing TinyMCE files
rm -rf public/ext/tinymce public/ext/tinymce-webcomponent.js
# Download latest versions
npm update tinymce
npm update @tinymce/tinymce-webcomponent
# Copy dist files to public directory
cp -r node_modules/tinymce public/ext/tinymce
cp node_modules/@tinymce/tinymce-webcomponent/dist/tinymce-webcomponent.js public/ext/tinymce-webcomponent.js
# Reinstall additional skins
cp -r public/skins/ui/* public/ext/tinymce/skins/ui
cp -r public/skins/content/* public/ext/tinymce/skins/content
```


## Coding standards

This project uses the coding standards and linting tools defined by [eckinox/eckinox-cs](https://github.com/eckinox/eckinox-cs).

