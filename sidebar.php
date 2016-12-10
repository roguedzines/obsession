<div class="home-sidebar">
      <div class="grid-item col-2">
        <div class="sidebar-content">
          <?php if ( is_active_sidebar( 'sidebar_widget_1' ) ) : ?>
          <div class="sidebar-widget-container">
              <?php dynamic_sidebar('sidebar_widget_1');?>
          </div>
          <?php endif; ?>
        </div>
      </div>
</div>
