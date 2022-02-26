<?php

/**
 * Get js url.
 * @param string $file_name (js file name)
 * @return string
 */
function ct_js_url(string $file_name): string
{
    return CT_ASSETS_JS_URL . '/' . $file_name;
}

/**
 * Get css url.
 * @param string $file_name (css file name)
 * @return string
 */
function ct_css_url(string $file_name): string
{
    return CT_ASSETS_CSS_URL . '/' . $file_name;
}

/**
 * Get url of libraries.
 * @param string $file_name (file name)
 * @return string
 */
function ct_lib_url(string $file_name): string
{
    return CT_ASSETS_LIB . '/' . $file_name;
}

/**
 * Get icon url.
 * @param string $file_name (icon file name)
 * @return string
 */
function ct_icon_url(string $file_name): string
{
    return CT_ASSETS_ICONS_URL . '/' . $file_name;
}

/**
 * Get image url.
 * @param string $file_name (image file name)
 * @return string
 */
function ct_image_url(string $file_name): string
{
    return CT_ASSETS_IMAGES_URL . '/' . $file_name;
}

/**
 * Get image path.
 * @param string $file_name (image file name)
 * @return string
 */
function ct_image_path(string $file_name): string
{
    return CT_ASSETS_IMAGES . '/' . $file_name;
}

/**
 * Get no image url.
 * @return string
 */
function ct_no_image_url(): string
{
    return ct_image_url('no-image.png');
}

/**
 * @param string $file_name
 * @return string
 */
function ct_image_to_base64(string $file_name): string
{
    $path = ct_image_path($file_name);
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    return 'data:image/' . $type . ';base64,' . base64_encode($data);
}

/**
 * Get template.
 * @param string $template
 * @param array $args
 * @return string
 */
function ct_get_template(string $template, array $args = []): string
{
    ob_start();

    if (!empty($args)) {
        extract($args);
    }

    include(CT_TEMPLATES . "/$template.php");

    return ob_get_clean();
}

/**
 * Get template part.
 * @param string $slug
 * @param string|null $name
 * @param array $args
 * @return string
 */
function ct_get_template_part(string $slug, ?string $name = null, array $args = []): string
{
    ob_start();
    get_template_part($slug, $name, $args);
    return ob_get_clean();
}

/**
 * Mutate camelize string.
 * @param string $string
 * @param string $explodeDelimiter
 * @param string $implodeDelimiter
 * @param string $caseDelimiter
 * @return string
 */
function ct_mutate_camelize_string(string $string, string $explodeDelimiter = '\\', string $implodeDelimiter = '/', string $caseDelimiter = '-'): string
{
    $data = [];
    $chunks = array_filter(explode($explodeDelimiter, $string));

    foreach ($chunks as $chunk) {
        $data[] = strtolower(preg_replace('/(.)([A-Z])/', "$1" . $caseDelimiter . "$2", $chunk));
    }

    return implode($implodeDelimiter, $data);
}

/**
 * Return true if current page has shortcode.
 * @param string $shortcode
 * @param string|null $content
 * @return bool
 */
function ct_has_shortcode(string $shortcode, ?string $content = null): bool
{
    if (!$content) {
        $queried_object = get_queried_object();
        if (!($queried_object instanceof WP_Post)) {
            return false;
        }
        $content = $queried_object->post_content;
    }

    return has_shortcode($content, $shortcode);
}

/**
 * Get shortcode atts.
 * @param string $shortcode
 * @param string|null $content
 * @return array
 */
function ct_get_shortcode_atts(string $shortcode, ?string $content = null): array
{
    if (!$content) {
        $queried_object = get_queried_object();
        if (!($queried_object instanceof WP_Post)) {
            return [];
        }
        $content = $queried_object->post_content;
    }

    preg_match_all('/' . get_shortcode_regex() . '/', $content, $matches, PREG_SET_ORDER);
    if (empty($matches)) {
        return [];
    }

    $atts_list = [];
    foreach ($matches as $match) {
        if ($shortcode === $match[2]) {
            $atts_list[] = empty($match[3]) ? [] : shortcode_parse_atts($match[3]);
        } else if (!empty($match[5])) {
            $atts_list = array_merge($atts_list, ct_get_shortcode_atts($shortcode, $match[5]));
        }
    }

    return $atts_list;
}
