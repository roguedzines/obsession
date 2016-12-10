<?php
function saxonGallerySettings(){
	if(has_post_format('gallery') && is_single()) {
?>
    <script type="text/javascript">
      jQuery(function($) {
        $(document).ready(function() {
          jQuery(function($) {
            // We only want these styles applied when javascript is enabled
            $('.thumb-wrapper').each(function() {
              var gallery = $(this).galleriffic({
                imageContainerSel: $(this).parent().children('.slideshow'),

                numThumbs: <?php if($data['gallery_home_num_thumb']!=''){ echo $data['gallery_home_num_thumb'];} else { echo '4'; } ?>,
                preloadAhead: 10,
                enableBottomPager: false,
                renderSSControls: false,
                autoStart: <?php if($data['gallery_home_auto_start']!=''){ echo 'false';} else { echo 'true'; } ?>,
                renderNavControls: false,
                nextPageLinkText: 'Next',
                prevPageLinkText: 'Prev',

                onPageTransitionIn: function() {
                  // var prevPageLink = $(this).parent().find('a.prev-thumbs').css('visibility', 'hidden');
                  // var nextPageLink = $(this).parent().find('a.next-thumbs').css('visibility', 'hidden');
									//
                  // // Show appropriate next / prev page links
                  // if (this.displayedPage > 0)
                  //   prevPageLink.css('visibility', 'visible');
									//
                  // var lastPage = this.getNumPages() - 1;
                  // if (this.displayedPage < lastPage)
                  //   nextPageLink.css('visibility', 'visible');
                }
              });
              /**************** Event handlers for custom next / prev page links **********************/

              $(this).parent().children('a.prev-thumbs').click(function(e) {
                gallery.previousPage();
                e.preventDefault();
              });

              $(this).parent().children('a.next-thumbs').click(function(e) {
                gallery.nextPage();
                e.preventDefault();
              });
            });
          });
        });
      });
    </script>
    <?
}
}
function sliderSingleOptions(){
  global $data;
?>
      <script type="text/javascript">
        jQuery(function($) {
          $(document).ready(function() {
            // $('#secondary-slider').flexslider({
            //   animation: 'slide',
            //   animationSpeed: <?php if($data['gallery_slider_speed']!=''){echo $data['gallery_slider_speed'];} else { echo 800 ;} ?>,
            //   smoothHeight: true,
            //   directionNav:<?php if($data['gallery_slider_controls']==0) { ?>false <?php } else { ?> true<?php }?>,
            //   easing:"<?php if($data['gallery_slider_easing']!='linear'){ echo $data['gallery_slider_easing'];} else { echo 'linear'; } ?>",
            //   animationLoop: <?php if($data['gallery_slider_loop']!=true){ ?> false <?php } else { ?> true <?php } ?>,
            //   controlNav: <?php if($data['gallery_slider_pagination']!=true){ ?> false <?php } else { ?> true <?php } ?>,
            // });
						  $('.bxslider').bxSlider({
								speed: <?php if($data['gallery_slider_speed']!=''){echo $data['gallery_slider_speed'];} else { echo 800 ;} ?>,
								easing:"<?php if($data['gallery_slider_easing']!='linear'){ echo $data['gallery_slider_easing'];} else { echo 'linear'; } ?>",
								useCSS: false,
								infiniteLoop: <?php if($data['gallery_slider_loop']!=true){ ?> false <?php } else { ?> true <?php } ?>,
								pager: <?php if($data['gallery_slider_pagination']!=true){ ?> false <?php } else { ?> true <?php } ?>,
								auto:<?php if($data['gallery_slider_auto']==0) { ?>false <?php } else { ?> true<?php }?>,
								controls:<?php if($data['gallery_slider_controls']==0) { ?>false <?php } else { ?> true<?php }?>,
							});
          });

        });
      </script>
      <?
}

function sliderSingleOptionsArchive(){


?>
        <script type="text/javascript">
          jQuery(function($) {
        // $('#secondary-slider').flexslider({
        //       animation: 'slide',
        //       controlNav: false,
        //       directionNav: true,
        //     });
						  $('.bxslider').bxSlider();
          });

        </script>
        <?

}

function loadInstafeed(){
global $data;
?>
        <script type="text/javascript">
				jQuery(function($) {
          $(document).ready(function() {
				    var footerFeed = new Instafeed({
				      get:'user',
							target:'footerInsta',
				      userId:<?php if($data['instagram_feeduserid']!=''){echo $data['instagram_feeduserid'];} ?>,
				      accessToken:'<?php if ($data['instagram_feed_accesstoken']!=''){echo $data['instagram_feed_accesstoken'];}?>',
				      limit:30,
								resolution:'thumbnail',
				      template: '<li><a href="{{link}}"><img src="{{image}}" class="instafeed" target="_blank" /></a></li>',
				      after: function () {
				     $('.instafeed-footer').slick({
				       slidesToShow: 8,
				       slidesToScroll: 3,
				       infinite: false,
							 autoplay: <?php if ($data['instagram_feed_autoplay']!=1){ ?> false <?php } else { ?> true <?php } ?>,
 						 	 autoplaySpeed: 5000,

				     });
				 }
				  });
				  footerFeed.run();
});
});
        </script>
        <?
//31109743
//'31109743.415422a.70e5c72c741841d8bfe322a821b4849c'
}
?>
