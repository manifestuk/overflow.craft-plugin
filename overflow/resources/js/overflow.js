;(function($) {

    $.fn.overflow = function(opts) {

        var defaults = {
            limit: 150,
            counterFormat: '{{ count }} of {{ limit }}'
        };

        var options = $.extend(defaults, opts);

        return this.each(function() {
            $(this).after(generateCounter());

            bindEvents(this);
            checkCount(this);
        });

        function generateCounter()
        {
            return '<span class="overflowCounter"></span>';
        }

        function bindEvents(el)
        {
            $(el).bind('keyup', function() {
                checkCount(el);
            });

            $(el).bind('paste', function() {
                var self = this;
                setTimeout(function() {
                    checkCount(self);
                }, 0);
            });
        }

        function checkCount(el)
        {
            var $el = $(el);
            var $counter = $el.next('.overflowCounter');
            var count = $el.val().length;

            if (count > options.limit) {
                $counter.addClass('overflowed');
            } else {
                $counter.removeClass('overflowed');
            }

            $counter.html(renderCounter(count, options.limit));
        }

        function renderCounter(count, limit)
        {
            return parseString(options.counterFormat, {
                count: count,
                limit: limit,
                remaining: limit - count
            });
        }

        function parseString(template, templateVars)
        {
            var val, needle;
            var haystack = template;

            for (var key in templateVars) {
                if ( ! templateVars.hasOwnProperty(key)) {
                    continue;
                }

                val = templateVars[key];
                needle = '{{ ' + key + ' }}';
                haystack = haystack.replace(needle, val);
            }

            return haystack;
        }
    };

})(jQuery);
