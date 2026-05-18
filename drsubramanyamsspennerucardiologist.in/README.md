# UB's Goutham Dental Care Website

This project has been reorganized into a clean static-site architecture with clear separation between HTML, styles, scripts, assets, content data, documentation, and backend mail dependencies.

## Structure

```text
project-root/
+-- index.html
+-- mail.php
+-- assets/
|   +-- images/
|   |   +-- hero/
|   |   +-- about/
|   |   +-- services/
|   |   +-- process/
|   |   +-- projects/
|   |   +-- testimonials/
|   |   +-- contact/
|   |   +-- logos/
|   |   +-- icons/
|   |   +-- backgrounds/
|   |   +-- misc/
|   +-- fonts/
|   +-- videos/
|   +-- documents/
+-- css/
|   +-- main.css
|   +-- app.min.css
|   +-- fontawesome.min.css
|   +-- layout/
|   +-- components/
|   +-- sections/
+-- js/
|   +-- main.js
|   +-- app.min.js
|   +-- utils/
|   +-- components/
|   +-- sections/
+-- data/
+-- partials/
+-- docs/
+-- vendor/
    +-- phpmailer/
```

## Conventions

- `index.html` remains the primary entry point.
- CSS is loaded from `css/`; the site-specific stylesheet is `css/main.css`.
- JavaScript is loaded from `js/`; utility/vendor scripts live in `js/utils/`.
- Images are categorized by usage and filename keywords under `assets/images/`.
- Fonts remain in `assets/fonts/` so Font Awesome paths continue to resolve cleanly.
- Downloadable/archive files live in `assets/documents/`.
- PHPMailer is isolated under `vendor/phpmailer/` and `mail.php` references that new location.

## Notes

The reorganization updated HTML, CSS, JavaScript, PHP, XML, TXT, JSON, and Markdown references from the old locations to the new folder structure. Byte-identical duplicate image assets were collapsed and references were updated to the kept copy.