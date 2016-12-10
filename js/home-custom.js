jQuery(function($) {
  $(document).ready(function() {

    var $grid = $('.grid-container').masonry({
      itemSelector: '.grid-item',
      columnWidth: '.grid-item',
      percentPosition: true
    });
    $grid.imagesLoaded().progress(function() {
      $grid.masonry('layout');
    });

    $(function() {
      //var $container = $('.grid-container');
      $grid.infinitescroll({

          navSelector: '.loadmore-wrap',
          nextSelector: '.load-more a',

          itemSelector: '.grid-item',
          // selector for all items you'll retrieve

          behavior: 'twitter',


          loading: {
            finished: undefined,
            finishedMsg: 'Finished',
            img: '',
            msg: null,
            msgText: '',
            selector: null,
            speed: 'slow',
            start: undefined

          }
        },
        // trigger Masonry as a callback

        function(newElements) {
          // hide new items while they are loading
          var $newElems = $(newElements).css({
            opacity: 0
          });
          // ensure that images load before adding to masonry layout
          $newElems.imagesLoaded(function() {
            $newElems.animate({
              opacity: 1
            });
            $grid.masonry('appended', $newElems, true);
          });
          //start callbacks for masonry elements
          $(".posts-slider").slick();
          $("a[rel^='prettyPhoto']").prettyPhoto({
            deeplinking: false
          });
            $(".video-container").fitVids();
        });
    });
    // 
    // $(".posts-slider").slick();
    // $(".new-slider").slick({
    //   autoplay: true,
    //   fade: true,
    //   speed: 1000
    // });
  });
});
