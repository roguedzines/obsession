	// Tabs
	$('.tabs-nav').delegate('span:not(.tabs-current)', 'click', function() {
		$(this).addClass('tabs-current').siblings().removeClass('tabs-current')
		.parents('.su-tabs').find('.su-tabs-pane').hide().eq($(this).index()).show();
	});
	$('.tabs-pane').hide();
	$('.tabs-nav span:first-child').addClass('tabs-current');
	$('.tabs-panes .tabs-pane:first-child').show();
