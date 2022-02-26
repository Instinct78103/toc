<div class="widget copyright-bar">
  <div class="copyright-bar-social">
    <ul class="social"><?php
        $nectar_options = get_nectar_theme_options();
        $social_networks = nectar_get_social_media_list();
        foreach ($social_networks as $network_name => $icon_arr) {
            $leading_fa = ('font-awesome' === $icon_arr['icon_type']) ? 'fa ' : '';
            if ('rss' === $network_name) {
                if (!empty($nectar_options['use-' . $network_name . '-icon']) && $nectar_options['use-' . $network_name . '-icon'] === '1') {
                    $nectar_rss_url_link = (!empty($nectar_options['rss-url'])) ? $nectar_options['rss-url'] : get_bloginfo('rss_url');
                    echo '<li><a target="_blank" href="' . esc_url($nectar_rss_url_link) . '"><span class="screen-reader-text">RSS</span><i class="' . esc_attr($leading_fa) . esc_attr($icon_arr['icon_class']) . '" aria-hidden="true"></i></a></li>';
                }
            } else {
                $target_attr = ('email' !== $network_name && 'phone' !== $network_name) ? 'target="_blank"' : '';
                if (!empty($nectar_options['use-' . $network_name . '-icon']) && $nectar_options['use-' . $network_name . '-icon'] === '1') {
                    if (isset($nectar_options[$network_name . '-url'])) {
                        echo '<li><a ' . $target_attr . ' href="' . esc_url($nectar_options[$network_name . '-url']) . '"><span class="screen-reader-text">' . esc_attr($network_name) . '</span><i class="' . esc_attr($leading_fa) . esc_attr($icon_arr['icon_class']) . '" aria-hidden="true"></i></a></li>';
                    } else {
                        echo '<li><a ' . $target_attr . ' href="#"><span class="screen-reader-text">' . esc_attr($network_name) . '</span><i class="' . esc_attr($leading_fa) . esc_attr($icon_arr['icon_class']) . '" aria-hidden="true"></i></a></li>';
                    }
                }
            }
        } ?>
    </ul>
  </div>
  <div class="copyright-bar-text">
    <span><?php nectar_footer_copyright_text(); ?></span>
  </div>
</div>
