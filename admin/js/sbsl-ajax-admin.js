(function () {
  var platform;

  jQuery(document).ready(() => {
    jQuery("#button-verify").on("click", () => {
      let apiKey = document.getElementById('apikey');

      platform2 = new H.service.Platform({
        apikey: apiKey.value,
      });

      let defaultLayers = platform2.createDefaultLayers();

      console.log(platform2)
    });
  });
})(jQuery);
