(function ($, Drupal, drupalSettings) {
  'use Strict';
  $(document).ready(function() {
    alert('Hi User!!');
  })
})(jQuery, Drupal, drupalSettings);

(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.myBehavior = {
    attach: function (context, settings) {
      $('.form-type-item').on('click', function() {
        $(this).addClass('practice-js');
      })
    }
  }
})(jQuery, Drupal, drupalSettings);
