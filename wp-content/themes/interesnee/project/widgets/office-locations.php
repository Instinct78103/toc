<?php

namespace Ct\Widgets;

use Ct\Features\OfficeLocations as OfficeLocationsFeature;
use WP_Widget;

/**
 * Class WebinarsCalendar
 * @package Aaoa\Widgets
 */
class OfficeLocations extends WP_Widget
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct(OfficeLocationsFeature::SHORTCODE, __('Ct', 'ac') . ' ' . OfficeLocationsFeature::get_shortcode_title());
    }

    /**
     * Echoes the widget content.
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance): void
    {
        echo OfficeLocations::render(array_merge($args, $instance));
    }

    /**
     * Outputs the settings update form.
     * @param array $instance
     * @return void
     */
    public function form($instance)
    {
//        $instance = wp_parse_args((array) $instance, ShopperApprovedFeature::get_default_atts()); ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('view')); ?>"><?php __('View:', 'aaoa'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('view')); ?>" id="<?php echo esc_attr($this->get_field_id('view')); ?>" class="widefat">
                    <option value="10" <?php selected(10, $instance['view']); ?>>10</option>
                    <option value="20" <?php selected(20, $instance['view']); ?>>20</option>
            </select>
        </p>
        <?php
    }
}
