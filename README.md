# BitSpecter Base Theme for WordPress + Sage

Welcome to the BitSpecter Base Theme, a robust and adaptable foundation for your WordPress website projects. This theme is crafted to provide a strong starting point for developing unique, efficient, and secure WordPress websites.

## Key Features

- **Modern and Clean Code**: Developed with clean, maintainable, and modern coding practices.
- **Enhanced Security**: Essential security features to safeguard your website.
- **Performance Focused**: Optimized for speed and efficiency.
- **Customization Ready**: Easily adaptable to suit specific design and functionality needs.
- **Regular Updates**: Keeping the theme compatible with the latest WordPress versions.

## Installation

1. Download the BitSpecter Base Theme files from the repository.
2. In your WordPress dashboard, go to `Appearance > Themes`.
3. Click `Add New` and upload the downloaded BitSpecter Base Theme file.
4. Create a child theme (optional)

# Theme Structure

```
themes/podnikatel/   # → Root of your Sage based theme
├── app/                  # → Theme PHP
│   ├── Providers/        # → Service providers
│   ├── View/             # → View models
│   ├── filters.php       # → Theme filters
│   └── setup.php         # → Theme setup
├── composer.json         # → Autoloading for `app/` files
├── public/               # → Built theme assets (never edit)
├── functions.php         # → Theme bootloader
├── index.php             # → Theme template wrapper
├── node_modules/         # → Node.js packages (never edit)
├── package.json          # → Node.js dependencies and scripts
├── resources/            # → Theme assets and templates
│   ├── fonts/            # → Theme fonts
│   ├── images/           # → Theme images
│   ├── scripts/          # → Theme javascript
│   ├── styles/           # → Theme stylesheets
│   └── views/            # → Theme templates
│       ├── components/   # → Component templates
│       ├── forms/        # → Form templates
│       ├── layouts/      # → Base templates
│       └── partials/     # → Partial templates
├── screenshot.png        # → Theme screenshot for WP admin
├── style.css             # → Theme meta information
├── vendor/               # → Composer packages (never edit)
└── bud.config.js         # → Bud configuration
```

### The app/ directory
The majority of your theme functionality lives in the `app` directory. By default, this directory is namespaced under `App` and is automatically loaded by Composer using the PSR-4 autoloading standard. See our blog post on Namespacing and Autoloading if you aren't familiar with these methods.

### The public/ directory

The public directory contains the compiled assets for your theme. This directory will never be manually modified.

### The resources/ directory

The `resources` directory contains your Blade views as well as the un-compiled assets of your theme such as CSS, JavaScript, images, and fonts.

# Deployment

To deploy a Sage theme you'll need to make sure two things are covered:

1. Run `composer install` from the theme directory on the remote server if you have Acorn installed in your theme directory

2. Generate production ready assets with `npm build`.

### Nginx 

If you are using Nginx, add the following to your site configuration before the final location directive:

```
location ~* \.(blade\.php)$ {
    deny all;
}
```

### Apache
If you are using Apache, add the following to your virtual host configuration or the .htaccess file at the root of your web application:

```
<FilesMatch ".+\.(blade\.php)$">
    # Apache 2.4
    <IfModule mod_authz_core.c>
        Require all denied
    </IfModule>

    # Apache 2.2
    <IfModule !mod_authz_core.c>
        Order deny,allow
        Deny from all
    </IfModule>
</FilesMatch>
```

## Contributions

Contributions are welcome! If you would like to contribute, please fork the repository and issue a pull request.

## License

The BitSpecter Base Theme is open-source software licensed under the [GPLv2 license](LICENSE).

## Support

For support, please open an issue in the repository or contact us directly at support@bitspecter.com.

## Secuity

Your security is our top priority. If you discover any security related issues within the theme, we strongly encourage you to report them to us privately. Please do not disclose these issues publicly. Contact us directly at security@bitspecter.com with a detailed description of the problem. 

## Thanks
Special thanks to the [Sage](https://roots.io/sage/) theme by Roots, a WordPress starter theme that has significantly influenced the development of our BitSpecter Base Theme. 

---

Developed with ❤ by [BitSpecter Team](https://www.bitspecter.com)
