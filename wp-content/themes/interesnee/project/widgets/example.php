<?php

namespace Aaoa\Widgets;

use Aaoa\Features\IfStatements;
use Aaoa\Features\ShopperApproved as ShopperApprovedFeature;
use WP_Widget;

/**
 * Class ShopperApproved
 * @package Aaoa\Widgets
 */
class ShopperApproved extends WP_Widget
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct(
            ShopperApprovedFeature::SHORTCODE,
            __('Aaoa', 'aaoa') . ' ' . ShopperApprovedFeature::get_shortcode_title()
        );
    }

    /**
     * Echoes the widget content.
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        echo ShopperApprovedFeature::render(array_merge($args, $instance));
    }

    /**
     * Outputs the settings update form.
     * @param array $instance
     * @return void
     */
    public function form($instance)
    {
        $instance = wp_parse_args((array) $instance, ShopperApprovedFeature::get_default_atts()); ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('view')); ?>"><?php __('View:', 'aaoa'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('view')); ?>" id="<?php echo esc_attr($this->get_field_id('view')); ?>" class="widefat">
                <?php foreach (ShopperApprovedFeature::get_views() as $view_key => $view): ?>
                    <option value="<?php echo $view_key; ?>" <?php selected($view_key, $instance['view']); ?>><?php echo $view['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('condition')); ?>"><?php __('Condition:', 'aaoa'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('condition')); ?>" id="<?php echo esc_attr($this->get_field_id('condition')); ?>" class="widefat">
                <?php foreach (IfStatements::get_conditions_params() as $condition_title => $condition_key): ?>
                    <option value="<?php echo $condition_key; ?>" <?php selected($condition_key, $instance['condition']); ?>><?php echo $condition_title; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }
}