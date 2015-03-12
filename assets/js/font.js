(function (window) {
    'use strict';

    var base = '/css/fonts/lato-';

    var font = (function () {
        var ua = navigator.userAgent;

        if (ua.indexOf('Android') > -1 && ua.indexOf('like Gecko') > -1 && ua.indexOf('Chrome') === -1) {
            return 'ttf';
        }

        if ('FontFace' in window) {
            var f = new window.FontFace('t', 'url("data:application/font-woff2,") format("woff")', {});
            f.load();

            if (f.status == 'loading') {
                return 'woff2';
            }
        }

        return 'woff';
    });

    var cookie = function (name, value, days) {
        // if value is undefined, get the cookie value
        if (value === undefined) {
            var cookiestring = "; " + window.document.cookie,
                cookies = cookiestring.split("; " + name + "=");

            if (cookies.length === 2) {
                return cookies.pop().split(";").shift();
            }
            return null;
        }
        else {
            var expires;
            // if value is a false boolean, we'll treat that as a delete
            if (value === false) {
                days = -1;
            }
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + ( days * 24 * 60 * 60 * 1000 ));
                expires = "; expires=" + date.toGMTString();
            }
            else {
                expires = "";
            }
            window.document.cookie = name + "=" + value + expires + "; path=/";
        }
    };

    function css(href) {
        var ss = window.document.createElement("link"),
            ref = window.document.getElementsByTagName("head")[0],
            sheets = window.document.styleSheets;

        ss.rel = "stylesheet";
        ss.href = href;
        ss.media = "only x";

        ref.insertBefore(ss, ref.lastChild);

        function toggleMedia() {
            var defined;

            for (var i = 0; i < sheets.length; i++) {
                if (sheets[i].href && sheets[i].href.indexOf(href) > -1) {
                    defined = true;
                }
            }
            if (defined) {
                ss.media = 'all';
            }
            else {
                setTimeout(toggleMedia);
            }
        }

        toggleMedia();
    }

    if (!cookie('font')) {
        css(base + font() + '.css');
        cookie('font', font());
    }
})(window);