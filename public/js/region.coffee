

class JsSearch

    $el: jQuery {}
    $items: jQuery {}

    constructor: (el) ->
        @$el = jQuery el
        @$items = @$el.find '.js-search-city-item'
        @$hide = @$el.find '.js-search-city-hide'
        @$el.find('.js-search-city-input').on 'input', (e) =>
            @filterData jQuery(e.target).val()

    filterData: (val) ->
        @$hide.css display: 'block'
        @$hide.css display: 'none' if val.length
        @$items.css display: 'block'
        @$items.each (i, item) =>
            $item = jQuery item
            dataStr = $item.find('.js-search-city-data').text()
            $item.css display: 'none' if dataStr.search(///#{val}///i) < 0
        on

jQuery('.js-search-city').each (i, el) ->
    new JsSearch el
