<div class="clear"></div>
<div class="footer-wrapper">
  <div class="footer-container">
    <div class="row">
        <?php if ( is_active_sidebar( 'footer_widget' ) ) : ?>
      <!-- <div class="col-2"> -->

        <div class="footer-widget-container">
            <?php dynamic_sidebar('footer_widget');?>
        </div>

      <!-- </div> -->
      <?php endif; ?>
      <div class="clear"></div>
    </div>
  </div>
</div>
<div id="instagram-footer"><?php include_once get_template_directory().'/includes/footer/instagram.php';?></div>
<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
</div>
<?php wp_footer();?>
</body>
</html>
