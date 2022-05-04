# Contributing

## Updating TinyMCE

To update TinyMCE to a newer version, run the following commands:

```bash
npm update tinymce
npm update @tinymce/tinymce-webcomponent
cp -r node_modules/tinymce public/ext/tinymce
cp node_modules/@tinymce/tinymce-webcomponent/dist/tinymce-webcomponent.js public/ext/tinymce-webcomponent.js
```
