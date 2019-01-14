<?php get_header(); ?>
    <div id="content_main" itemprop="mainContentOfPage" class="container">
        <div id="content_main_inner">

            <?php
            /**** Main loop *****/
            get_template_part('loop');
            ?>

        </div><!-- content_main_inner div -->
    </div><!-- content_main div -->
<?php get_footer();
