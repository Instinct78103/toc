<?php

/**
 * Common constants.
 */
if (!defined('CT_PROJECT')) {
    define('CT_PROJECT', dirname(__FILE__));
}
if (!defined('CT_FEATURES')) {
    define('CT_FEATURES', CT_PROJECT . '/features');
}
define('CT_VERSION', '1.0.0');
define('CT_TEMPLATES', CT_PROJECT . '/templates');
define('CT_ASSETS_IMAGES', CT_PROJECT . '/assets/images');
define('CT_ASSETS_URL', get_stylesheet_directory_uri() . '/project/assets');
define('CT_ASSETS_JS_URL', CT_ASSETS_URL . '/js');
define('CT_ASSETS_CSS_URL', CT_ASSETS_URL . '/css');
define('CT_ASSETS_LIB', CT_ASSETS_URL . '/lib');
define('CT_ASSETS_ICONS_URL', CT_ASSETS_URL . '/icons');
define('CT_ASSETS_IMAGES_URL', CT_ASSETS_URL . '/images');
define('CT_UPLOAD_DIR', wp_upload_dir()['basedir']);

/**
 * Register autoloader.
 */
spl_autoload_register(function (string $class): void {
    if (strpos($class, 'Ct\\') === 0) {
        $fileName = ct_mutate_camelize_string(
            str_replace('Ct\\', '', $class)
        );
        $file = CT_PROJECT . '/' . $fileName . '.php';
        if (file_exists($file)) {
            require_once($file);
        }
    }
});

/**
 * Require vendors.
 */
require_once(CT_PROJECT . '/vendor/autoload.php');

/**
 * Require functions.
 */
require_once(CT_PROJECT . '/functions.php');
require_once(CT_PROJECT . '/functions-theme.php');

/**
 * Require main logic.
 */
require_once(CT_PROJECT . '/main.php');
