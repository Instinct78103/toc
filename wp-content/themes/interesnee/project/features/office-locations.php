<?php

namespace Ct\Features;

/**
 * Class OfficeLocation
 * @package Ct\Features
 */
class OfficeLocations
{
    /**
     * Shortcode name.
     */
    const SHORTCODE = 'ct_office_locations';

    /**
     * Shortcode title.
     * @var string
     */
    protected static string $title = 'Office Locations';

    /**
     * Init feature.
     */
    public static function init(): void
    {
        /**
         * Add office locations shortcode - [ct_office_locations].
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
        return __(static::$title, 'ct');
    }

    /**
     * Render element.
     * @param array $atts
     * @return string
     */
    public static function render(array $atts = []): string
    {
        return ct_get_template('office-locations', $atts);
    }
}
