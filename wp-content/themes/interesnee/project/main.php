<?php

use Ct\Features\CopyrightBar as CopyrightBarFeature;
use Ct\Widgets\CopyrightBar as CopyrightBarWidget;
use Ct\Features\OfficeLocations as OfficeLocationsFeature;
use Ct\Widgets\OfficeLocations as OfficeLocationsWidget;

add_filter('the_content', function ($content) {

    if (is_single()) {
        $pattern = '/<h([1-6])*[^>]*>(.*?)<\/h[1-6]>/';
        preg_match_all($pattern, $content, $matches);

        $heads_list = [];

        foreach ($matches[2] as $key => $item) {

            $anchor = '#' . ctl_sanitize_title($item);

            $heads_list[] = '<li class="toc-item toc' . $matches[1][$key] . '"><a href="' . $anchor . '">' . $item . '</a></li>';
        }

        $contents = '
                    <div class="toc_block">
                    <h3>Содержание:</h3>
                    <ul id="toc">' . join('', $heads_list) . '</ul>
                    </div>';

        $content = preg_replace_callback($pattern, function ($matches) {
            return "<h{$matches[1]}><span id=\"" . ctl_sanitize_title($matches[2]) . "\" data-hash=\"" . ctl_sanitize_title($matches[2]) . "\" class=\"heading\">{$matches[2]}</span></h{$matches[1]}>";
        }, $content);

        return
            $contents . '<div class="content">' . $content . '</div>';

    }

    return $content;
});

function ctl_sanitize_title($title)
{
    $iso9_table = [
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G',
        'Ґ' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
        'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J',
        'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K',
        'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
        'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '',
        'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
        'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
        'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j',
        'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k',
        'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
        'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '',
        'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
    ];

    $title = html_entity_decode($title, ENT_NOQUOTES, 'UTF-8');
    $title = strtr($title, $iso9_table);


    $title = preg_replace("/[^A-Za-z0-9'_\-\.]/", '-', $title);
    $title = preg_replace('/\-+/', '-', $title);
    $title = preg_replace('/^-+/', '', $title);
    $title = preg_replace('/-+$/', '', $title);

    return strtolower($title);
}

add_filter('use_block_editor_for_post', '__return_false', 10);

add_filter('get_custom_logo', function ($html, $blog_id = 0) {
    return '
    <a href="/">
    <picture class="logo">
        <source srcset="" alt="Логотип" type="image/webp">
        <img srcset="' . get_stylesheet_directory_uri() . '/project/assets/images/logo.svg, " alt="Логотип" decoding="async">
    </picture>
    <picture class="logo_mobile">
        <source srcset="" alt="Логотип" type="image/webp">
        <img srcset="' . get_stylesheet_directory_uri() . '/project/assets/images/logo_mobile.svg, " alt="Логотип" decoding="async">
    </picture>
    </a>';
});

add_action('wp_print_scripts', function () {
    wp_dequeue_script('twentynineteen-priority-menu');
    wp_deregister_script('twentynineteen-priority-menu');

    wp_dequeue_script('twentynineteen-touch-navigation');
    wp_deregister_script('twentynineteen-touch-navigation');


    wp_dequeue_script('jquery-smooth-scroll');
    wp_deregister_script('jquery-smooth-scroll');
});

add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('parent-styles');
});

function remove_parent_filter($nav_menu, $args)
{
    global $wp_filter;
    foreach ($wp_filter["wp_nav_menu"]->callbacks as $key => $item) {
        unset($wp_filter["wp_nav_menu"]->callbacks[$key]['twentynineteen_add_ellipses_to_nav']);
    }

    if ('menu-1' === $args->theme_location && !$args->container_class) {
        $nav_menu .=
            '<a class="mobile-menu-toggle" href="#">
                <i class="lines-button">
                    <i class="lines"></i>
                    <i class="lines"></i>
                    <i class="lines"></i>
                </i>
            </a>';
    }

    return $nav_menu;
}

add_filter('wp_nav_menu', 'remove_parent_filter', 9, 2);

/**
 * Enqueue frontend scripts and styles.
 */
add_action('wp_enqueue_scripts', function (): void {

    wp_register_script('owl-carousel', CT_ASSETS_JS_URL . '/owl.carousel.min.js', ['jquery'], CT_VERSION, true);
    wp_register_script('owl-init', CT_ASSETS_JS_URL . '/owl-init.min.js', ['jquery', 'owl-carousel'], CT_VERSION, true);
    wp_register_script('highlight-lib', CT_ASSETS_JS_URL . '/highlight.min.js', [], CT_VERSION, true);
    wp_register_script('highlight-init', CT_ASSETS_JS_URL . '/highlight-init.min.js', ['highlight-lib'], CT_VERSION, true);

    /**
     * Owl Carousel
     */
    wp_enqueue_style('owl-carousel-min', CT_ASSETS_CSS_URL . '/owl.carousel.min.css', ['ct-layout'], CT_VERSION);
    wp_enqueue_style('owl-default-min', CT_ASSETS_CSS_URL . '/owl.theme.default.min.css', ['ct-layout'], CT_VERSION);

    /**
     * Highlight code library
     */
    wp_enqueue_style('highlight-default', CT_ASSETS_CSS_URL . '/default.min.css', ['ct-layout'], CT_VERSION);
    wp_enqueue_script('highlight-lib', ct_js_url('highlight.min.js'), [], CT_VERSION, true);
    wp_enqueue_script('highlight-init', ct_js_url('highlight.min.js'), ['ct-layout', 'highlight-lib'], CT_VERSION, true);

    wp_enqueue_script('owl-carousel', CT_ASSETS_JS_URL . '/owl.carousel.min.js', ['jquery'], CT_VERSION, true);
    wp_enqueue_script('owl-init', CT_ASSETS_JS_URL . '/owl-init.min.js', ['jquery', 'owl-carousel'], CT_VERSION, true);

    // Enqueue main fronted styles and scripts.
    wp_enqueue_style('ct-layout', CT_ASSETS_CSS_URL . '/layout.min.css', CT_VERSION);
    wp_enqueue_style('ct-frontend', ct_css_url('frontend.min.css'), ['ct-layout'], CT_VERSION);

    wp_enqueue_script('ct-frontend', ct_js_url('frontend.min.js'), ['jquery'], CT_VERSION, true);

    wp_localize_script('ct-frontend', 'ctFrontend', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ]);
});

/**
 * Init theme features.
 */
CopyrightBarFeature::init();
OfficeLocationsFeature::init();

/**
 * Register sidebars and widgets.
 */
add_action('widgets_init', function (): void {
    register_widget(CopyrightBarWidget::class);
    register_widget(OfficeLocationsWidget::class);
});

/**
 * Page slug body class.
 */
add_filter('body_class', function (array $classes): array {
    global $post;
    if (isset($post) && $post instanceof WP_Post) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
});

/**
 * Allow upload mimes.
 */
add_filter('upload_mimes', function (array $mimes): array {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['webp'] = 'image/webp';
    return $mimes;
});

function twentynineteen_posted_by()
{
    global $post;
    $meta_value = get_user_meta($post->post_author, 'avatar_manager_custom_avatar');
    $image_id = array_shift($meta_value);
    $image_url = wp_get_attachment_image_url($image_id, 'full');

    printf(
    /* translators: 1: SVG icon. 2: Post author, only visible to screen readers. 3: Author link. */
        '<span class="byline">%1$s<span class="screen-reader-text">%2$s</span><span class="author vcard"><a class="url fn n" href="%3$s">%4$s</a></span></span>',
        '<img src="' . $image_url . '" width="50" height="50" class="custom_avatar">',
        __('Posted by', 'twentynineteen'),
        esc_url(get_author_posts_url(get_the_author_meta('ID'))),
        esc_html(get_the_author() . ', ' . get_the_author_meta('description'))
    );
}


function twentynineteen_entry_footer()
{
    // Hide author, post date, category and tag text for pages.
    if ('post' === get_post_type()) {

        // Posted by.
//        twentynineteen_posted_by();

        // Posted on.
        twentynineteen_posted_on();

        /* translators: Used between list items, there is a space after the comma. */
//        $categories_list = get_the_category_list(__(', ', 'twentynineteen'));
//        if ($categories_list) {
//            printf(
//            /* translators: 1: SVG icon. 2: Posted in label, only visible to screen readers. 3: List of categories. */
//                '<span class="cat-links">%1$s<span class="screen-reader-text">%2$s</span>%3$s</span>',
//                twentynineteen_get_icon_svg('archive', 16),
//                __('Posted in', 'twentynineteen'),
//                $categories_list
//            ); // WPCS: XSS OK.
//        }

        /* translators: Used between list items, there is a space after the comma. */
        $tags_list = get_the_tag_list('', __(', ', 'twentynineteen'));
        if ($tags_list && !is_wp_error($tags_list)) {
            printf(
            /* translators: 1: SVG icon. 2: Posted in label, only visible to screen readers. 3: List of tags. */
                '<span class="tags-links">%1$s<span class="screen-reader-text">%2$s </span>%3$s</span>',
                twentynineteen_get_icon_svg('tag', 16),
                __('Tags:', 'twentynineteen'),
                $tags_list
            ); // WPCS: XSS OK.
        }
    }

    // Comment count.
    if (!is_singular()) {
        twentynineteen_comment_count();
    }

    // Edit post link.
//    edit_post_link(
//        sprintf(
//            wp_kses(
//            /* translators: %s: Post title. Only visible to screen readers. */
//                __('Edit <span class="screen-reader-text">%s</span>', 'twentynineteen'),
//                [
//                    'span' => [
//                        'class' => [],
//                    ],
//                ]
//            ),
//            get_the_title()
//        ),
//        '<span class="edit-link">' . twentynineteen_get_icon_svg('edit', 16),
//        '</span>'
//    );
}

function new_excerpt_more($more)
{
    global $post;
    return '<p class="link-more">
                <a class="more-link" href="' . get_permalink($post->ID) . '">' . 'Читать далее' . '</a>
            </p>';
}

add_filter('excerpt_more', 'new_excerpt_more', 11);

add_filter('get_the_excerpt', 'do_shortcode'); //Enable shortcodes in excerpts

add_shortcode('read_more', function ($atts, $content) {
    global $post;
    $href = get_permalink($post->ID);

    $out =
        '<p class="link-more">
            <a class="more-link" href="' . $href . '">' . $content . '</a>
        </p>';

    wp_reset_postdata();
    return $out;
});

function post_rating($content)
{
    if (is_singular()) {

        $likes = array_shift(get_post_meta(get_the_ID(), 'post_rating_likes')) ?: 0;
        $dislikes = array_shift(get_post_meta(get_the_ID(), 'post_rating_dislikes')) ?: 0;

        return
            $content . '
            <div class="post-rating">
                <button data-button="like" data-postid="' . get_the_ID() . '"><i class="far fa-thumbs-up"></i><span class="like">' . $likes . '</span></button>
                <button data-button="dislike" data-postid="' . get_the_ID() . '"><i class="far fa-thumbs-down"></i><span class="dislike">' . $dislikes . '</span></button>
            </div>';
    }
    return $content;
}

add_filter('the_content', 'post_rating');

function refresh_post_rating()
{
    $postid = $_POST['param']['postid'];
    $button_clicked = $_POST['param']['button_clicked'];

    $likes = get_post_meta($postid, 'post_rating_likes')[0] ?: 0;
    $dislikes = get_post_meta($postid, 'post_rating_dislikes')[0] ?: 0;

    switch ($button_clicked) {
        case 'like':
            if ($_COOKIE['rating'][$postid]['dislike'] !== 'yes') {
                if ($_COOKIE['rating'][$postid]['like'] === 'yes') {
                    update_post_meta($postid, 'post_rating_likes', $likes - 1);
                    setcookie("rating[$postid][like]", 'no', time() + (86400 * 30), '/');
                } else {
                    update_post_meta($postid, 'post_rating_likes', $likes + 1);
                    setcookie("rating[$postid][like]", 'yes', time() + (86400 * 30), '/');
                }
            }
            break;
        case 'dislike':
            if ($_COOKIE['rating'][$postid]['like'] !== 'yes') {
                if ($_COOKIE['rating'][$postid]['dislike'] === 'yes') {
                    update_post_meta($postid, 'post_rating_dislikes', $dislikes - 1);
                    setcookie("rating[$postid][dislike]", 'no', time() + (86400 * 30), '/');
                } else {
                    update_post_meta($postid, 'post_rating_dislikes', $dislikes + 1);
                    setcookie("rating[$postid][dislike]", 'yes', time() + (86400 * 30), '/');
                }
            }
            break;
        default:
            break;
    }

    echo json_encode([
        'likes' => get_post_meta($postid, 'post_rating_likes')[0] ?: 0,
        'dislikes' => get_post_meta($postid, 'post_rating_dislikes')[0] ?: 0,
    ], JSON_UNESCAPED_UNICODE);

    wp_die();
}

add_action('wp_ajax_refresh_post_rating', 'refresh_post_rating');
add_action('wp_ajax_nopriv_refresh_post_rating', 'refresh_post_rating');
