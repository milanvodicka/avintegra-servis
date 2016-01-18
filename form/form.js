(function($) {
  $.validator.addMethod('phone', function (number) {
    return number.match(/((((\+|00)[0-9]{3})|0)[0-9]{9})/);
  }, 'Zadajte prosím správne telefónne číslo!');
  $(function () {
    $('.form form').validate({
      debug: false,
      rules: {
        _name: {
          required: true,
          minlength: 4
        },
        _zip: {
          rangelength: {
            param: [5, 5],
            depends: function () {
              var _zip = $('#zip');
              _zip.val(_zip.val().replace(' ', ''));
              return true;
            }
          }
        },
        _phone: {
          required: true,
          digits: {
            depends: function () {
              var _phone = $('#phone');
              _phone.val(_phone.val().replace(' ', ''));
              return true;
            }
          },
          minlength: 10
        },
        _email: {
          required: true,
          email: true
        },
        _city: {
          required: true,
          minlength: 2
        },
        _text: {
          required: true,
          minlength: 10
        }
      },
      highlight: function (element) {
        $(element).closest('.form-group').addClass('has-error');
      },
      unhighlight: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
      },
      errorClass: 'help-block',
      errorElement: 'span'
    });
  });
})(jQuery);
