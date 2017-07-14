(function($) {

  var BDWP_Cf7 = BDWP_Cf7 || {};

  BDWP_Cf7.reloadImage = function() {
    $('div.wpcf7 > form').submit(function() {
      var captchaInput = $(this).find('input.bdwp_user_input'),
          attrId = captchaInput.attr('id');

      if (typeof attrId === 'undefined') { return; }

      var capthaId = attrId.replace(/-/g, '_');
      capthaId = eval(capthaId);
      setTimeout(function() {
        capthaId.ReloadImage();
      }, 1000);
    });
  };

  $(function() {
    BDWP_Cf7.reloadImage();
  });

})(jQuery);
