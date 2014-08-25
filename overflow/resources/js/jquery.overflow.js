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

        /**
         * Update the counter.
         *
         * @param object el
         *
         * @return void
         */
        function checkCount(el)
        {
            var $el = $(el);
            var $counter = $el.next('.overflowCounter');
            var count = countCharacters($el.val());

            if (count > options.limit) {
                $counter.addClass('overflowed');
            } else {
                $counter.removeClass('overflowed');
            }

            $counter.html(renderCounter(count, options.limit));
        }

        /**
         * Counts the number of characters in the given string. Line-breaks
         * are counted as two characters, as per the HTML spec.
         *
         * @param string val
         *
         * @return int
         */
        function countCharacters(val)
        {
            var linebreaks = val.match(/(\r\n|\n|\r)/g);
            var extras = linebreaks ? linebreaks.length : 0;

            return val.length + extras;
        }

        /**
         * Generate the counter text.
         *
         * @param int count
         * @param int limit
         *
         * @return string
         */
        function renderCounter(count, limit)
        {
            return parseString(options.counterFormat, {
                count: count,
                limit: limit,
                remaining: limit - count
            });
        }

        /**
         * Replace template placeholders with the given template variables.
         *
         * @param string template
         * @param object templateVars
         *
         * @return string
         */
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
