(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.tpoParagraph = {
    attach: function (context, settings) {
      $('body', context).once('tpoParagraph').each(function () {
        // autoplay any background videos
        $('.tpo-paragraph-video-background').each(function() {
          $(this).get(0).play();
        });

        // swipe controls for carousel
        $(".tpo-paragraph-carousel-swipe").swipe({
          swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
            if (direction == 'left') $(this).carousel('next');
            if (direction == 'right') $(this).carousel('prev');
          },
          allowPageScroll:"vertical"
        });
      });
    }
  };
})(jQuery, Drupal, drupalSettings);
