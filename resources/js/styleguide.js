jQuery(document).ready(function($) {
    var rgbRegex = /^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/;
    function rgbToHex(rgbString) {
        var m = rgbRegex.exec(rgbString);
        return "#"
            + parseInt(m[1]).toString(16).slice(-2)
            + parseInt(m[2]).toString(16).slice(-2)
            + parseInt(m[3]).toString(16).slice(-2)
            ;
    }

    $('.styleguide-color').each(function(){
        var self = $(this);
        var backgroundColorRgb = self.css("background-color");
        var backgroundColorHex = rgbToHex(backgroundColorRgb);
        $('<b>' + backgroundColorHex + '</b>').insertAfter(self);
    });

    console.log("Styleguide JS ready");
});
