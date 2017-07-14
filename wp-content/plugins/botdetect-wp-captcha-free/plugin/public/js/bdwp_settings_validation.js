(function($) {

  var BDWP_Settings = BDWP_Settings || {};

  BDWP_Settings.init = function() {

    var self = this,
        defValues = self.defCodeLengthValues;

    // validate captcha code length for user is anonymous
    $('#min_code_length').focusout(function() {
      self.minCodeLengthValidate(
                    $('#min_code_length'),
                    $('#max_code_length'),
                    defValues.defMin,
                    defValues.defMax);
    });

    $('#max_code_length').focusout(function() {
      self.maxCodeLengthValidate(
                    $('#min_code_length'),
                    $('#max_code_length'),
                    defValues.defMin,
                    defValues.defMax);
    });

    // validate captcha code length for user is logged in
    $('#min_code_length_for_user_logged_in').focusout(function() {
      self.minCodeLengthValidate(
                    $('#min_code_length_for_user_logged_in'),
                    $('#max_code_length_for_user_logged_in'),
                    defValues.defMinForUserLoggedIn,
                    defValues.defMaxForUserLoggedIn);
    });

    $('#max_code_length_for_user_logged_in').focusout(function() {
      self.maxCodeLengthValidate(
                    $('#min_code_length_for_user_logged_in'),
                    $('#max_code_length_for_user_logged_in'),
                    defValues.defMinForUserLoggedIn,
                    defValues.defMaxForUserLoggedIn);
    });

    // show or hide captcha code length option for user is logged in
    self.showHideCodeLengthOptionForUserLoggedIn();
  };

  BDWP_Settings.defCodeLengthValues = {
    minimum: 1,
    maximum: 15,
    defMin: 3,
    defMax: 5,
    defMinForUserLoggedIn: 2,
    defMaxForUserLoggedIn: 3
  };

  BDWP_Settings.showHideCodeLengthOptionForUserLoggedIn = function() {
    $('#captcha_for_user_logged_in').on('click', function() {
      $('#bdwp_code_length_option_container2').toggle();
    });
  }

  BDWP_Settings.minCodeLengthValidate = function(minInput, maxInput,defValueMinInput, defValueMaxInput) {

    var minValue = $.trim(minInput.val()),
        maxValue  = $.trim(maxInput.val()),
        defMinValue = defValueMinInput,
        defMaxValue = defValueMaxInput,
        defValuesObj = this.defCodeLengthValues;

    if (!$.isNumeric(minValue)) {
      maxValue = parseInt(maxValue);
      if (defMinValue > maxValue) {
        this.setInputValue(minInput, maxValue);
      } else {
        this.setInputValue(minInput, defValuesObj.minimum);
      }
      this.nextInputFocus(maxInput);
      return false;
    }

    if (parseInt(minValue) < defValuesObj.minimum) {
      this.setInputValue(minInput, defValuesObj.minimum);
      this.nextInputFocus(maxInput);
      return false;
    }

    minValue = parseFloat(minValue);
    maxValue = parseInt(maxValue);

    if (0 !== (minValue % 1) && minValue > maxValue) {
      this.setInputValue(minInput, maxValue);
      this.nextInputFocus(maxInput);
      return false;
    }

    if (0 !== (minValue % 1) && minValue < maxValue) {
      this.setInputValue(minInput, parseInt(minValue));
      this.nextInputFocus(maxInput);
      return false;
    }

    minValue = parseInt(minValue);

    if (minValue > maxValue) {
      this.setInputValue(minInput, maxValue);
      this.nextInputFocus(maxInput);
      return false;
    }

    return true;
  };

  BDWP_Settings.maxCodeLengthValidate = function(minInput, maxInput, defValueMinInput, defValueMaxInput) {

    var minValue = $.trim(minInput.val()),
        maxValue  = $.trim(maxInput.val()),
        defMinValue = defValueMinInput,
        defMaxValue = defValueMaxInput,
        defValuesObj = this.defCodeLengthValues;

    if (!$.isNumeric(maxValue)) {
      minValue = parseInt(minValue);
      if (defMaxValue< minValue) {
        this.setInputValue(maxInput, minValue);
      } else {
        this.setInputValue(maxInput, defValuesObj.maximum);
      }
      this.nextInputFocus(minInput);
      return false;
    }

    if (parseInt(maxValue) > defValuesObj.maximum) {
      this.setInputValue(maxInput, defValuesObj.maximum);
      this.nextInputFocus(minInput);
      return false;
    }

    minValue = parseInt(minValue);
    maxValue = parseFloat(maxValue);

    if (0 !== (maxValue % 1) && maxValue < minValue) {
      this.setInputValue(maxInput, minValue);
      this.nextInputFocus(minInput);
      return false;
    }

    if (0 !== (maxValue % 1) && maxValue > minValue) {
      this.setInputValue(maxInput, parseInt(maxValue));
      this.nextInputFocus(minInput);
      return false;
    }

    maxValue = parseInt(maxValue);

    if (maxValue < minValue) {
      this.setInputValue(maxInput, minValue);
      this.nextInputFocus(minInput);
      return false;
    }

    return true;
  };

  BDWP_Settings.nextInputFocus = function(input) {
    input.focus();
  };

  BDWP_Settings.setInputValue = function(input, value) {
    input.prop('value', value);
  };

  $(function() {
    BDWP_Settings.init();
  });

})(jQuery);
