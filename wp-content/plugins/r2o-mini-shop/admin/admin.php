<?php
// create custom plugin settings menu
add_action('admin_menu', 'r2o_mini_shop_create_menu');

function r2o_mini_shop_create_menu() {

    //create new top-level menu
    add_menu_page(__('ubk Mini Shop',R2O_MINI_SHOP_TEXTDOMAIN), __('ubk Mini Shop',R2O_MINI_SHOP_TEXTDOMAIN), 'administrator', __FILE__, 'r2o_mini_shop_settings_page' , plugins_url('/images/icon.png', __FILE__) );

}

function r2o_mini_shop_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php __('UBK Mini Shop',R2O_MINI_SHOP_TEXTDOMAIN); ?></h1>
        <p><?php __('In this page you can view and delete recent orders.',R2O_MINI_SHOP_TEXTDOMAIN); ?></p>

        <h2><?php __('Orders',R2O_MINI_SHOP_TEXTDOMAIN); ?></h2>

        <?php

        // IMPLEMENT YOUR ORDER LISTING HERE

        ?>
    </div>
<?php } ?>