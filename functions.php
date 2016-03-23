<?php

add_action('after_setup_theme', function () {

    // Enable title tag support
    add_theme_support('title-tag');

    // Register main menu
    register_nav_menu('main_menu', 'Main Menu');

    // Register sidebars
    register_sidebar(['name' => 'Page']);
    register_sidebar(['name' => 'Blog']);

    // Register custom images sizes
    add_theme_support('post-thumbnails');
    add_image_size('banner_large', 900, 450, true);
    add_image_size('banner_small', 900, 260, true);
});

// Force upscaling of images
add_filter(
    'image_resize_dimensions',
    function ($default, $orig_w, $orig_h, $new_w, $new_h, $crop) {
        if (!$crop) {
            return;
        }

        $aspect_ratio = $orig_w / $orig_h;
        $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

        $crop_w = round($new_w / $size_ratio);
        $crop_h = round($new_h / $size_ratio);

        $s_x = floor(($orig_w - $crop_w) / 2);
        $s_y = floor(($orig_h - $crop_h) / 2);

        return [ 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h ];
    },
    10,
    6
);

// Set content width
if (!isset($content_width)) {
    $content_width = 840;
}

// Setup sub menu
add_filter('wp_nav_menu_objects', function ($sorted_menu_items) {
    foreach ($sorted_menu_items as $menu_item) {
        if (in_array('current_page_ancestor', $menu_item->classes, true) and $menu_item->menu_item_parent === 0) {
            $GLOBALS['menu_item_id'] = $menu_item->ID;
            break;
        }
        if (in_array('current-menu-item', $menu_item->classes, true)) {
            $GLOBALS['menu_item_id'] = $menu_item->ID;
            break;
        }
    }

    return $sorted_menu_items;

});

// Setup sub menu
add_filter('wp_nav_menu_objects', function ($sorted_menu_items) {
    foreach ($sorted_menu_items as $menu_item) {
        if (in_array('current_page_ancestor', $menu_item->classes, true) and (int) $menu_item->menu_item_parent === 0) {
            $GLOBALS['menu_item_id'] = $menu_item->ID;
            break;
        }
        if (in_array('current-menu-item', $menu_item->classes, true)) {
            $GLOBALS['menu_item_id'] = $menu_item->ID;
            break;
        }
    }

    return $sorted_menu_items;

});

// Generate sub menu
function get_sub_menu()
{
    global $post;
    global $menu_item_id;

    $menu_items = [];

    foreach (wp_get_nav_menu_items('Main Menu') as $menu_item) {
        if ((string) $menu_item->ID === (string) $menu_item_id or (string) $menu_item->menu_item_parent === (string) $menu_item_id) {
            $menu_items[] = [
                'url' => $menu_item->url,
                'title' => $menu_item->title,
                'selected' => (string) $menu_item->object_id === (string) $post->ID,
            ];
        }
    }

    if (count($menu_items) === 1) {
        return '';
    }

    return '<ul class="sub_menu">'.array_reduce($menu_items, function ($html, $item) {
        $html .= $item['selected'] ? '<li class="selected">' : '<li>';
        $html .= '<a href="'.$item['url'].'">'.$item['title'].'</a>';
        $html .= '</li>';

        return $html;
    }).'</ul>';
}

// Setup custom theme options
add_action('customize_register', function ($wp_customize) {

    class WP_Textarea_Control extends WP_Customize_Control
    {
        public $type = 'textarea';
        public $wrap = 'on';
        public $rows;

        public function render_content()
        {
            echo '<label>';
            echo '<span class="customize-control-title">'.esc_html($this->label).'</span>';
            echo '<textarea wrap="'.$this->wrap.'" rows="'.$this->rows.'" style="width:100%;" '.$this->get_link().'>'.esc_textarea($this->value()).'</textarea>';
            echo '</label>';
        }
    }

    $wp_customize->add_section('social_media', [
        'title' => 'Social Media',
        'priority' => 1,
    ]);

    $wp_customize->add_setting('twitter');
    $wp_customize->add_control(
        new WP_Customize_Control($wp_customize, 'twitter', [
            'label' => 'Twitter',
            'section' => 'social_media',
            'settings' => 'twitter',
            'priority' => 1,
        ])
    );

    $wp_customize->add_setting('facebook');
    $wp_customize->add_control(
        new WP_Customize_Control($wp_customize, 'facebook', [
            'label' => 'Facebook',
            'section' => 'social_media',
            'settings' => 'facebook',
            'priority' => 2,
        ])
    );

    $wp_customize->add_setting('instagram');
    $wp_customize->add_control(
        new WP_Customize_Control($wp_customize, 'instagram', [
            'label' => 'Instagram',
            'section' => 'social_media',
            'settings' => 'instagram',
            'priority' => 3,
        ])
    );

    $wp_customize->add_setting('livestream');
    $wp_customize->add_control(
        new WP_Customize_Control($wp_customize, 'livestream', [
            'label' => 'Livestream',
            'section' => 'social_media',
            'settings' => 'livestream',
            'priority' => 4,
        ])
    );

    $wp_customize->add_setting('member_login');
    $wp_customize->add_control(
        new WP_Customize_Control($wp_customize, 'member_login', [
            'label' => 'Member login',
            'section' => 'social_media',
            'settings' => 'member_login',
            'priority' => 5,
        ])
    );

    $wp_customize->add_section('join_us', [
        'title' => 'Join us this Sunday',
        'priority' => 1,
    ]);

    $wp_customize->add_setting('church_address');
    $wp_customize->add_control(
        new WP_Customize_Control($wp_customize, 'church_address', [
            'label' => 'Church Address',
            'section' => 'join_us',
            'settings' => 'church_address',
            'priority' => 1,
        ])
    );

    $wp_customize->add_setting('service_times');
    $wp_customize->add_control(
        new WP_Customize_Control($wp_customize, 'service_times', [
            'label' => 'Service Times',
            'section' => 'join_us',
            'settings' => 'service_times',
            'priority' => 2,
        ])
    );
});
