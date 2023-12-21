# BitSpecter Base Theme for WordPress

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
4. **Create a child theme** ⚠️

## Creating a Child Theme

To customize the BitSpecter Base Theme, it is recommended to create a child theme. This allows you to make changes without affecting the parent theme, making updates easier and preserving your customizations.

### Steps to Create a Child Theme: 

1. **Create a Child Theme Directory**: In your WordPress themes directory, create a new folder for your child theme, e.g., `bitspecter-child`.

2. **Create a `style.css` File**: Inside the child theme directory, create a `style.css` file with the following header:

   ```css
   /*
   Theme Name: BitSpecter Child
   Theme URI: https://www.yoursite.com/
   Description: Child theme for the BitSpecter Base Theme
   Author: Your Name
   Author URI: https://www.yoursite.com/
   Template: bitspecter-base
   Version: 1.0.0
   */
   ```

3. Replace bitspecter-base with the actual directory name of the BitSpecter Base Theme.

4. Ceate a functions.php File: Create a functions.php file in your child theme directory. Add the following code to enqueue the parent and child theme stylesheets:
    ```php
    add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array('parent-style') );
    ```

5. Activate Your Child Theme: Go back to Appearance > Themes in your WordPress dashboard and activate your new child theme.

6. Customize: You can now add custom styles to style.css and modify functions.php as needed without affecting the parent theme.


## Contributions

Contributions are welcome! If you would like to contribute, please fork the repository and issue a pull request.

## License

The BitSpecter Base Theme is open-source software licensed under the [GPLv2 license](LICENSE).

## Support

For support, please open an issue in the repository or contact us directly at support@bitspecter.com.

## Secuity

Your security is our top priority. If you discover any security related issues within the theme, we strongly encourage you to report them to us privately. Please do not disclose these issues publicly. Contact us directly at security@bitspecter.com with a detailed description of the problem. 

---

Developed with ❤ by [BitSpecter Team](https://www.bitspecter.com)
