<?php

namespace Ct\Widgets;

use Ct\Features\CopyrightBar as CopyrightBarFeature;
use WP_Widget;

/**
 * Class WebinarsCalendar
 * @package Aaoa\Widgets
 */
class CopyrightBar extends WP_Widget
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct(CopyrightBarFeature::SHORTCODE, __('Ct', 'ac') . ' ' . CopyrightBarFeature::get_shortcode_title());
    }

    /**
     * Echoes the widget content.
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance): void
    {
        echo CopyrightBarFeature::render(array_merge($args, $instance));
    }
}
