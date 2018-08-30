;(function ($, undefined) {
  const pluginName = 'overflow'
  const defaults = {enforceLimit: false}

  function Plugin (element, options) {
    this.element = element
    this.options = $.extend({}, defaults, options)
    this.init()
  }

  Plugin.prototype.init = function () {
    $(this.element).closest('.field').attr('data-overflow-enforce-limit', this.options.enforceLimit)
  }

  // A really lightweight plugin wrapper around the constructor,
  // preventing against multiple instantiations
  $.fn[pluginName] = function (options) {
    return this.each(function () {
      if (!$.data(this, 'plugin_' + pluginName)) {
        $.data(this, 'plugin_' + pluginName,
          new Plugin(this, options))
      }
    })
  }
})(jQuery)
