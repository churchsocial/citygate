<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description')?>">
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url') ?>/css/all.css?v=<?=wp_get_theme()->get('Version')?>" />
    <script src="<?php bloginfo('template_url') ?>/js/respond.js"></script>
    <?php wp_head() ?>
</head>

<body>

<div class="header">
    <div class="center">

        <a href="/" class="logo"><?php bloginfo('blogname')?></a>

        <ul class="quick_links">
            <?php if (get_theme_mod('facebook')): ?>
                <li class="social">
                    <a href="<?=get_theme_mod('facebook')?>" class="socicon socicon-facebook"></a>
                </li>
            <?php endif ?>
            <?php if (get_theme_mod('twitter')): ?>
                <li class="social">
                    <a href="<?=get_theme_mod('twitter')?>" class="socicon socicon-twitter"></a>
                </li>
            <?php endif ?>
            <?php if (get_theme_mod('instagram')): ?>
                <li class="social">
                    <a href="<?=get_theme_mod('instagram')?>" class="socicon socicon-instagram"></a>
                </li>
            <?php endif ?>
            <?php if (get_theme_mod('livestream')): ?>
                <li class="social">
                    <a href="<?=get_theme_mod('livestream')?>" class="socicon socicon-youtube"></a>
                </li>
            <?php endif ?>
            <?php if (get_theme_mod('member_login')): ?>
                <li class="login">
                    <a href="<?=get_theme_mod('member_login')?>">Member Login</a>
                </li>
            <?php endif ?>
        </ul>

        <?php wp_nav_menu([
            'theme_location' => 'main_menu',
            'depth' => 1,
            'menu_class' => 'menu',
            'container' => '',
        ]) ?>

    </div>
</div>

<div class="center">

    <div class="page">

        <div class="banner <?php if (!has_post_thumbnail($post->ID)) echo 'missing' ?>">
            <?=get_the_post_thumbnail($post->ID, is_front_page() ? 'banner_large' : 'banner_small') ?>
        </div>

        <?php if (is_front_page()): ?>
            <ul class="callouts">
                <li class="ad left">
                    <?php if (get_theme_mod('homepage_ad_left_img')): ?>
                        <?php if (get_theme_mod('homepage_ad_left_url')): ?>
                            <a href="<?=get_theme_mod('homepage_ad_left_url')?>">
                                <?php echo wp_get_attachment_image(get_theme_mod('homepage_ad_left_img'), 'homepage_ad') ?>
                            </a>
                        <?php else: ?>
                            <?php echo wp_get_attachment_image(get_theme_mod('homepage_ad_left_img'), 'homepage_ad') ?>
                        <?php endif ?>
                    <?php endif ?>
                </li>
                <li class="ad middle">
                    <?php if (get_theme_mod('homepage_ad_middle_img')): ?>
                        <?php if (get_theme_mod('homepage_ad_middle_url')): ?>
                            <a href="<?=get_theme_mod('homepage_ad_middle_url')?>">
                                <?php echo wp_get_attachment_image(get_theme_mod('homepage_ad_middle_img'), 'homepage_ad') ?>
                            </a>
                        <?php else: ?>
                            <?php echo wp_get_attachment_image(get_theme_mod('homepage_ad_middle_img'), 'homepage_ad') ?>
                        <?php endif ?>
                    <?php endif ?>
                </li>
                <li class="ad right">
                    <?php if (get_theme_mod('homepage_ad_right_img')): ?>
                        <?php if (get_theme_mod('homepage_ad_right_url')): ?>
                            <a href="<?=get_theme_mod('homepage_ad_right_url')?>">
                                <?php echo wp_get_attachment_image(get_theme_mod('homepage_ad_right_img'), 'homepage_ad') ?>
                            </a>
                        <?php else: ?>
                            <?php echo wp_get_attachment_image(get_theme_mod('homepage_ad_right_img'), 'homepage_ad') ?>
                        <?php endif ?>
                    <?php endif ?>
                </li>
            </ul>
        <?php endif ?>

        <?=get_sub_menu()?>

        <div class="content">