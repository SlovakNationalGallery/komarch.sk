jQuery(document).ready(function ($) {
  const rgbRegex = /^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/
  function rgbToHex (rgbString) {
    const m = rgbRegex.exec(rgbString)
    return '#' +
            parseInt(m[1]).toString(16).slice(-2) +
            parseInt(m[2]).toString(16).slice(-2) +
            parseInt(m[3]).toString(16).slice(-2)
  }

  $('.styleguide-color').each(function () {
    const self = $(this)
    const backgroundColorRgb = self.css('background-color')
    const backgroundColorHex = rgbToHex(backgroundColorRgb)
    $('<b>' + backgroundColorHex + '</b>').insertAfter(self)
  })

  /*******************
        buttons
    ********************/
  const buttonsWrapper = $('#styleguide-buttons .cd-box')
  const buttonsHtml = buttonsWrapper.html()
  const containerHtml = $('<div class="cd-box code lang-html"></div>').insertAfter(buttonsWrapper)
  const buttonsHtmlText = buttonsHtml.split('</button>')

  $.map(buttonsHtmlText, function (value) {
    if (value.indexOf('button') >= 0) {
      const splitText = value.split('class="')
      const block1 = splitText[0] + 'class="'
      const block2 = splitText[1].split('"')

      const wrapperElement = $('<p></p>').text(block1)
      const spanElement = $('<span></span>').text(block2[0])
      spanElement.appendTo(wrapperElement)
      wrapperElement.appendTo(containerHtml)
      wrapperElement.append('"' + block2[1] + '&lt;/button&gt;')
    }
  })

  /*******************
        typography
    ********************/
  const heading = $('#styleguide-typography h1')
  const headingDescriptionText = heading.children('span').eq(0)
  const body = heading.next('p')
  const bodyDescriptionText = body.children('span').eq(0)

  setTypography(heading, headingDescriptionText)
  setTypography(body, bodyDescriptionText)
  $(window).on('resize', function () {
    setTypography(heading, headingDescriptionText)
    setTypography(body, bodyDescriptionText)
  })

  function setTypography (element, textElement) {
    const fontSize = Math.round(element.css('font-size').replace('px', '')) + 'px'
    const fontFamily = (element.css('font-family').split(','))[0].replace(/'/g, '').replace(/"/g, '')
    const fontWeight = element.css('font-weight')
    textElement.text(fontWeight + ' ' + fontFamily + ' ' + fontSize)
  }

  /*******************
        codeblock syntax highlight
    ********************/
  $('.code').each(function () {
    hljs.highlightBlock($(this).get(0))
  })
})
