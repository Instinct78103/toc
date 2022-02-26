<?php

namespace Ct\Features;

/**
 * Class CopyrightBar
 * @package Ct\Features
 */
class CopyrightBar
{
    /**
     * Shortcode name.
     */
    const SHORTCODE = 'ct_copyright_bar';

    /**
     * Shortcode title.
     * @var string
     */
    protected static string $title = 'Copyright Bar';

    /**
     * Init feature.
     */
    public static function init(): void
    {
        /**
         * Add copyright bar shortcode - [ct_copyright_bar].
         */
        add_shortcode(static::SHORTCODE, function ($atts): string {
            return static::render($atts ?: []);
        });
    }

    /**
     * Get shortcode title.
     * @return string
     */
    public static function get_shortcode_title(): string
    {
        return __(static::$title, 'aaoa');
    }

    /**
     * Render element.
     * @param array $atts
     * @return string
     */
    public static function render(array $atts = []): string
    {
        return ct_get_template('copyright-bar', $atts);
    }
}
