<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui" />

    <?php
    wp_head();
    ?>
</head>
<body <?php body_class(); ?>>
<div id="container">
    <div id="container_inner">
        <header id="header">
            <div id="header_inner" class="container">
                <div id="logo">
                    <a href="<?php /*the_permalink(); 
                    
                   <img src="<?php bloginfo('template_url'); ?>/images/" alt="Logo" />*/
                    ?>">
                        UBK HEADER
                    </a>
                </div>
            </div>
        </header>
        <main id="content" class="clear">
