(function($) {
    $.fn.trackCoords = function(options) {
        // Default options
        var settings = $.extend({
            checkInterval: 30,
            sendInterval: 3000,
            url: ''
        }, options);

        var $container = this;
        var data = [];
        var lastCheckTime = 0;

        // Track mouse movement and add data to the array
        $container.on('mousemove', function(e) {
            var now = Date.now();
            if (now - lastCheckTime >= settings.checkInterval) {
                lastCheckTime = now;
                var coords = {
                    x: e.pageX - $container.offset().left,
                    y: e.pageY - $container.offset().top,
                    time: now
                };
                data.push(coords);
            }
        });

        // Send data to the server at specified interval
        setInterval(function() {
            if (data.length > 0) {
                $.ajax({
                    type: 'POST',
                    url: settings.url,
                    data: JSON.stringify(data),
                    success: function() {
                        data = [];
                    },
                    contentType: 'application/json'
                });
            }
        }, settings.sendInterval);
    };
})(jQuery);
