<form method="get" id="searchForm" action="<?php echo home_url('/'); ?>">
<div class="search-container">
      <div class="input_search">
          <input type="text" maxlength="30" name="s" id="s" class="search_input" value="<?php _e('Search this site', 'stalkerTheme') ?>"  onfocus="if (this.value == 'Search this site') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search this site';}" />
      </div>
      <input type="submit" id="searchSubmit" value="Search" />
      <div class="clear"></div>
</div>
</form>
