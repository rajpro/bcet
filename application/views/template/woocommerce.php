<?php

// =============================================================================
// VIEWS/INTEGRITY/WOOCOMMERCE.PHP
// -----------------------------------------------------------------------------
// WooCommerce page output for Integrity.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-container max width offset">

    <?php get_sidebar(); ?>

    <div class="<?php x_main_content_class(); ?>" role="main">

      <?php woocommerce_content(); ?>

    </div>

  </div>

<?php get_footer(); ?>