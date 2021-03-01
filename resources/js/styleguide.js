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

    /*******************
        buttons
    ********************/
    var buttonsWrapper = $('#styleguide-buttons .cd-box'),
        buttonsHtml = buttonsWrapper.html(),
        containerHtml = $('<div class="cd-box code lang-html"></div>').insertAfter(buttonsWrapper),
        buttonsHtmlText = buttonsHtml.split('</button>');

    $.map(buttonsHtmlText, function(value){
        if(value.indexOf('button') >= 0 ) {
            var splitText = value.split('class="'),
                block1 = splitText[0]+'class="',
                block2 = splitText[1].split('"');

            var wrapperElement = $('<p></p>').text(block1),
                spanElement = $('<span></span>').text(block2[0]);
            spanElement.appendTo(wrapperElement);
            wrapperElement.appendTo(containerHtml);
            wrapperElement.append('"'+block2[1]+'&lt;/button&gt;');
        }
    });

    /*******************
        typography
    ********************/
    var heading = $('#styleguide-typography h1'),
        headingDescriptionText = heading.children('span').eq(0),
        body = heading.next('p'),
        bodyDescriptionText = body.children('span').eq(0);

    setTypography(heading, headingDescriptionText);
    setTypography(body, bodyDescriptionText);
    $(window).on('resize', function(){
        setTypography(heading, headingDescriptionText);
        setTypography(body, bodyDescriptionText);
    });

    function setTypography(element, textElement) {
        var fontSize = Math.round(element.css('font-size').replace('px',''))+'px',
            fontFamily = (element.css('font-family').split(','))[0].replace(/\'/g, '').replace(/\"/g, ''),
            fontWeight = element.css('font-weight');
        textElement.text(fontWeight + ' '+ fontFamily+' '+fontSize );
    }

    /*******************
        codeblock syntax highlight
    ********************/
    $('.code').each(function( ) {
        hljs.highlightBlock($( this ).get(0));
    });
});
