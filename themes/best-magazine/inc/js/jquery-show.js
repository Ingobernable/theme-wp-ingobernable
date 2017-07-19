(function ($) {
    var _oldShow = $.fn.show;

    $.fn.show = function (/*speed, easing, callback*/) {
        var argsArray = Array.prototype.slice.call(arguments),
            duration = argsArray[0],
            easing,
            callback,
            callbackArgIndex;

        // jQuery recursively calls show sometimes; we shouldn't
        //  handle such situations. Pass it to original show method.
        if (!this.selector) {
            _oldShow.apply(this, argsArray);
            return this;
        }

        if (argsArray.length === 2) {
            if ($.isFunction(argsArray[1])) {
                callback = argsArray[1];
                callbackArgIndex = 1;
            } else {
                easing = argsArray[1];
            }
        } else if (argsArray.length === 3) {
            easing = argsArray[1];
            callback = argsArray[2];
            callbackArgIndex = 2;
        }

        return $(this).each(function () {
            var obj = $(this),
                oldCallback = callback,
                newCallback = function () {
                    if ($.isFunction(oldCallback)) {
                        oldCallback.apply(obj);
                    }

                    obj.trigger('afterShow');
                };

            if (callback) {
                argsArray[callbackArgIndex] = newCallback;
            } else {
                argsArray.push(newCallback);
            }

            obj.trigger('beforeShow');

            _oldShow.apply(obj, argsArray);
        });
    };
})(jQuery);


jQuery(function($) {

  var _oldaddClass = $.fn.addClass;

  $.fn.addClass = function(args) {
    return $(this).each(function() {
      var obj= $(this);
      // now use the old function to show the element passing the new callback
      _oldaddClass.apply(obj, [args]);
      obj.trigger('classChanged');
    });
  }
});

jQuery(function($) {

  var _oldremoveClass = $.fn.removeClass;

  $.fn.removeClass = function(args) {
    return $(this).each(function() {
      var obj= $(this);
      // now use the old function to show the element passing the new callback
      _oldremoveClass.apply(obj, [args]);
      obj.trigger('classChanged');
    });
  }
});
