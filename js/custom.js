/*global $, jQuery */
/*eslint-env jquery*/

(function ($) {

    'use strict';

    // detect first hover
    $('html').addClass('has-mouse');

    // detect first touch
    window.addEventListener('touchstart', function onFirstTouch() {

        jQuery('html').removeClass('has-mouse');

        window.removeEventListener('touchstart', onFirstTouch, false);

    }, false);

}(jQuery));
