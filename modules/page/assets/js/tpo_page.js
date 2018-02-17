(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.tpoPage = {
    attach: function (context, settings) {
      $('body', context).once('tpoPage').each(function () {
        // autoplay any background videos
        $('.tpo-page-background-video').each(function() {
          $(this).get(0).play();
        });

        // sidebar menu: expand active link path
        $('#tpo-page-sidebar-menu li.active').parents('ul.nav-list.collapse').collapse("show");
      });
    }
  };
})(jQuery, Drupal, drupalSettings);
