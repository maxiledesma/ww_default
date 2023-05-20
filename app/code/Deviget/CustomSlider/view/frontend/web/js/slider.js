define([
    'jquery',
    'jquery/ui',
    'slick',
    "domReady!"
], function (
    $
) {
    "use strict";

    let slider = $('#ww-custom-slider');

    slider.show();

    slider.slick({
        infinite: true,
        dots: false,
        autoplay: true
    });
});
