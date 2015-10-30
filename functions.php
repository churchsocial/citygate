<?php

// Register main menu
register_nav_menu('main_menu', 'Main Menu');

// Add post thumbnail support
add_theme_support('post-thumbnails');

// Register sidebars
register_sidebar(['name' => 'Page']);
register_sidebar(['name' => 'Blog']);

// Register custom images sizes
add_image_size('banner_large', 900, 450, true);
add_image_size('banner_small', 900, 260, true);

// Set content width
if (!isset($content_width)) {
    $content_width = 840;
}

// Setup sub menu
add_filter('wp_nav_menu_objects', function ($sorted_menu_items) {
    foreach ($sorted_menu_items as $menu_item) {
        if (in_array('current_page_ancestor', $menu_item->classes) and $menu_item->menu_item_parent == 0) {
            $GLOBALS['menu_item_id'] = $menu_item->ID;
            break;
        }
        if (in_array('current-menu-item', $menu_item->classes)) {
            $GLOBALS['menu_item_id'] = $menu_item->ID;
            break;
        }
    }

    return $sorted_menu_items;

});

function get_sub_menu()
{
    global $post;
    global $menu_item_id;

    $html = '<ul class="sub_menu">';

    foreach (wp_get_nav_menu_items('Main Menu') as $menu_item) {
        if ($menu_item->ID == $menu_item_id or $menu_item->menu_item_parent == $menu_item_id) {
            if ($menu_item->object_id == $post->ID) {
                $html .= '<li class="selected"><a href="'.$menu_item->url.'">'.$menu_item->title.'</a></li>';
            } else {
                $html .= '<li><a href="'.$menu_item->url.'">'.$menu_item->title.'</a></li>';
            }
        }
    }

    $html .= '</ul>';

    return $html;
}

// Setup custom theme options
add_action('customize_register', function ($wp_customize) {

    // Add custom textarea control
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

    $wp_customize->add_setting('member_login');
    $wp_customize->add_control(
        new WP_Customize_Control($wp_customize, 'member_login', [
            'label' => 'Member login',
            'section' => 'social_media',
            'settings' => 'member_login',
            'priority' => 3,
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

    $wp_customize->add_section('home_page', [
        'title' => 'Home Page',
        'priority' => 1,
    ]);

    $wp_customize->add_setting('banner', [
        'default' => '1',
    ]);

    $wp_customize->add_control(
        new WP_Customize_Control($wp_customize, 'banner', [
            'label' => 'Show large banner',
            'section' => 'static_front_page',
            'settings' => 'banner',
            'priority' => 1,
            'type' => 'select',
            'choices' => [
                '1' => 'Yes',
                '0' => 'No',
            ],
        ])
    );
});
