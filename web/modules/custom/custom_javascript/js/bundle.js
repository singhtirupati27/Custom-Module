(function ($, Drupal, drupalSettings) {
  'use Strict';
  Drupal.behaviors.sitewideBehavior = {
    attach: function (context, settings) {
      var $phoneField = $('#edit-field-phone-0-value', context);
      $phoneField.on('keyup', function () {
        var $inputData = $phoneField.val();
        var $phoneNumber = $inputData.replace(/\D/g, '');
        // Check for phone number length.
        if ($phoneNumber.length > 10) {
          $phoneNumber = $phoneNumber.substring(0, 10);
        }
        // Convert phone number to (xxx) xxx-xxxx format.
        if ($phoneNumber.length === 10) {
          var $formattedPhoneNumber = '(' + $phoneNumber.substring(0, 3) + ') ' + $phoneNumber.substring(3, 6) + '-' + $phoneNumber.substring(6, 10);
          $phoneField.val($formattedPhoneNumber);
        }
      });
    },
  }
}) (jQuery, Drupal, drupalSettings);

(function ($, Drupal, drupalSettings) {
  'use Strict';
  Drupal.behaviors.bundleBehavior = {
    attach: function (context, settings) {
      var target = $('.field__item', context);
      target.on('click', function () {
        $(this).addClass('phone-num');
      });
    },
  };
}) (jQuery, Drupal, drupalSettings);
