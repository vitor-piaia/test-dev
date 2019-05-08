'use strict';

/** Includes polyfill */
/*! https://mths.be/includes v1.0.0 by @mathias */
if (!String.prototype.includes) {
	(function() {
		'use strict'; // needed to support `apply`/`call` with `undefined`/`null`
		var toString = {}.toString;
		var defineProperty = (function() {
			// IE 8 only supports `Object.defineProperty` on DOM elements
			try {
				var object = {};
				var $defineProperty = Object.defineProperty;
				var result = $defineProperty(object, object, object) && $defineProperty;
			} catch(error) {}
			return result;
		}());
		var indexOf = ''.indexOf;
		var includes = function(search) {
			if (this == null) {
				throw TypeError();
			}
			var string = String(this);
			if (search && toString.call(search) == '[object RegExp]') {
				throw TypeError();
			}
			var stringLength = string.length;
			var searchString = String(search);
			var searchLength = searchString.length;
			var position = arguments.length > 1 ? arguments[1] : undefined;
			// `ToInteger`
			var pos = position ? Number(position) : 0;
			if (pos != pos) { // better `isNaN`
				pos = 0;
			}
			var start = Math.min(Math.max(pos, 0), stringLength);
			// Avoid the `indexOf` call if no match is possible
			if (searchLength + start > stringLength) {
				return false;
			}
			return indexOf.call(string, searchString, pos) != -1;
		};
		if (defineProperty) {
			defineProperty(String.prototype, 'includes', {
				'value': includes,
				'configurable': true,
				'writable': true
			});
		} else {
			String.prototype.includes = includes;
		}
	}());
}

/** Initialize tooltips */
function initTooltips() {
    var opts = {
        container: "body",
        trigger: "hover"
    };
    $('[data-toggle="tooltip"]').tooltip(opts);
    $('[data-tooltip="on"]').tooltip(opts);
}

/** Fix nested products */
function fixNestedProducts() {
    $('.nested-products').each(function() {
        var $previousRow = $(this).closest('table').find('tr').get(0);
        var $previousColumns = $($previousRow).find('th');
        var $columns = $(this).find('tr:not(.nested-products__category) td');
        $columns.each(function(i) {
            $(this).css('width', $($previousColumns.get(i)).outerWidth() + 'px');
        });
    });
}

/** Fix page padding if it has a fixed footer */
function fixPageFooter() {
    if ($('.page-actions').length < 1) {
        return false;
    }

    var $page = $('.wrapper-content');
    var footerHeight = $('.page-actions').outerHeight();
    $page.css('padding-bottom', footerHeight + 'px');
}

$(document).on('click', '.expand-product', expandProduct);

function expandProduct(e) {
    e.preventDefault();
    var $el = $(this);
    $($el).toggleClass('product-open').closest('tr').next().toggle();
}

(function ($, global, document) {
    /** Initialize tooltips */
    try {
        initTooltips();
    } catch (e) {}

    /** Fix nested products */
    try {
        fixNestedProducts();
    } catch (e) {}

    /** Fix page padding if it has a fixed footer */
    try {
        fixPageFooter();
    } catch (e) {}

    /** Polyfill for Object-fit property */
    if ('objectFit' in document.documentElement.style === false) {
        $('[data-fit="cover"]').each(function () {
            var $container = $(this);
            var $img = $container.find('img');
            var imgURL;

            if ($img.prop('currentSrc') === undefined) {
                imgURL = $img.prop('src');
            } else {
                imgURL = $img.prop('currentSrc');
            }

            $container
                .css('background', 'url("' + imgURL + '")')
                .addClass('compat-object-fit');
        });
    }

    /** Highlight select fields */
    $(document).on('focus blur', '.select-wrapper select', function() {
        $(this).parent().toggleClass('select-wrapper--focus');
    });
})(jQuery, window, document);