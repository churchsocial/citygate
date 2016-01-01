<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right') . bloginfo('name') ?></title>
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url') ?>/css/all.css" />
    <link href="<?php bloginfo('template_url') ?>/vendor/socicon/styles.css" rel="stylesheet">
    <?php wp_head() ?>
</head>
<body>

<div class="header">
    <div class="center">

        <a href="/" class="logo"><?php bloginfo('blogname')?></a>

        <ul class="quick_links">
            <?php if (get_theme_mod('facebook')){ ?>
                <li class="social">
                    <a href="<?=get_theme_mod('facebook')?>" target="_blank" class="socicon socicon-facebook"></a>
                </li>
            <?php } ?>
            <?php if (get_theme_mod('twitter')){ ?>
                <li class="social">
                    <a href="<?=get_theme_mod('twitter')?>" target="_blank" class="socicon socicon-twitter"></a>
                </li>
            <?php } ?>
            <?php if (get_theme_mod('instagram')){ ?>
                <li class="social">
                    <a href="<?=get_theme_mod('instagram')?>" target="_blank" class="socicon socicon-instagram"></a>
                </li>
            <?php } ?>
            <?php if (get_theme_mod('member_login')){ ?>
                <li class="login">
                    <a href="<?=get_theme_mod('member_login')?>">Member Login</a>
                </li>
            <?php } ?>
        </ul>

        <?php wp_nav_menu(['theme_location' => 'main_menu', 'depth' => 1]) ?>

    </div>
</div>

<div class="center">

    <div class="page">

        <div class="banner <?php if(!has_post_thumbnail($post->ID)) echo 'missing' ?>">
            <?=get_the_post_thumbnail($post->ID, is_front_page() ? 'banner_large' : 'banner_small') ?>
        </div>

        <?=get_sub_menu()?>

        <div class="content">