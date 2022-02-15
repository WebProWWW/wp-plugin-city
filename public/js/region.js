/*!
 * @author Timur Valiyev
 * @link https://webprowww.github.io
 */
"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

(function () {
  var JsSearch;

  JsSearch = function () {
    var JsSearch = /*#__PURE__*/function () {
      function JsSearch(el) {
        var _this = this;

        _classCallCheck(this, JsSearch);

        this.$el = jQuery(el);
        this.$items = this.$el.find('.js-search-city-item');
        this.$hide = this.$el.find('.js-search-city-hide');
        this.$el.find('.js-search-city-input').on('input', function (e) {
          return _this.filterData(jQuery(e.target).val());
        });
      }

      _createClass(JsSearch, [{
        key: "filterData",
        value: function filterData(val) {
          this.$hide.css({
            display: 'block'
          });

          if (val.length) {
            this.$hide.css({
              display: 'none'
            });
          }

          this.$items.css({
            display: 'block'
          });
          this.$items.each(function (i, item) {
            var $item, dataStr;
            $item = jQuery(item);
            dataStr = $item.find('.js-search-city-data').text();

            if (dataStr.search(RegExp("".concat(val), "i")) < 0) {
              return $item.css({
                display: 'none'
              });
            }
          });
          return true;
        }
      }]);

      return JsSearch;
    }();

    ;
    JsSearch.prototype.$el = jQuery({});
    JsSearch.prototype.$items = jQuery({});
    return JsSearch;
  }.call(this);

  jQuery('.js-search-city').each(function (i, el) {
    return new JsSearch(el);
  });
}).call(void 0);