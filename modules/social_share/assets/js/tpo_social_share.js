(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.tpoSocialShare = {
    attach: function (context, settings) {
      $('body', context).once('tpoSocialShare').each(function () {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "https://s7.addthis.com/js/300/addthis_widget.js#pubid="+drupalSettings.tpo_social_share.addthis_api_key;
        document.body.appendChild(script);
      });
    }
  };
})(jQuery, Drupal, drupalSettings);
