jQuery(document).ready(function($) {
	if (typeof wchweb_price_filter_params === 'undefined') {
		return false;
	}

	var priceSlider = document.getElementById('wchweb-noui-slider');

    // price slider
    wchwebInitPriceSlider = function() {
	    if ($('#wchweb-noui-slider').length) {
		    var min_val = parseInt($(priceSlider).attr('data-min')),
		    	max_val = parseInt($(priceSlider).attr('data-max')),
		    	set_min_val = parseInt($(priceSlider).attr('data-set-min')),
		    	set_max_val = parseInt($(priceSlider).attr('data-set-max'));

		    if (!set_min_val) {
		    	set_min_val = min_val;
		    }

		    if (!set_max_val) {
		    	set_max_val = max_val;
		    }

		    noUiSlider.create(priceSlider, {
		    	start: [set_min_val, set_max_val],
		    	step: 1,
		    	margin: 1,
		    	range: {
		    		'min': min_val,
		    		'max': max_val
		    	}
		    });

		    var min_val_holder = document.getElementById('wchweb-noui-slider-value-min'),
		    	max_val_holder = document.getElementById('wchweb-noui-slider-value-max');

		    priceSlider.noUiSlider.on('update', function (values, handle) {
		    	if (handle) {
		    		var value = parseInt(values[handle]);
		    		$(document).trigger('update_wchweb_slider_vals', [max_val_holder, value]);
		    	} else {
		    		var value = parseInt(values[handle]);
		    		$(document).trigger('update_wchweb_slider_vals', [min_val_holder, value]);
		    	}
		    });

		    priceSlider.noUiSlider.on('change', function (values, handle) {
		    	var params = wchwebGetUrlVars();
		    	if (handle) {
		    		var max = parseInt(values[handle]),
		    			filter_key = 'max-price';

		    		// remove this parameter if set value is equal to max val
		    		if (max == max_val) {
		    			var query = wchwebRemoveQueryStringParameter(filter_key);
		    			history.pushState({}, '', query);
		    		} else {
			    		wchwebUpdateQueryStringParameter(filter_key, max);
		    		}
		    	} else {
		    		var min = parseInt(values[handle]),
		    			filter_key = 'min-price';

		    		// remove this parameter if set value is equal to min val
		    		if (min == min_val) {
		    			var query = wchwebRemoveQueryStringParameter(filter_key);
		    			history.pushState({}, '', query);
		    		} else {
			    		wchwebUpdateQueryStringParameter(filter_key, min);
		    		}
		    	}

		    	// filter products without reinitializing price slider
		    	wchwebFilterProducts();
		    });
	    }
    }

    // position currency symbol
	$(document).bind('update_wchweb_slider_vals', function(event, value_holder, value) {
	    // if WooCommerce Currency Switcher plugin is activated
	    if (typeof woocs_current_currency !== 'undefined') {
	    	if (woocs_current_currency.position === 'left') {
	    		$(value_holder).html(woocs_current_currency.symbol + value);
	    	} else if (woocs_current_currency.position === 'left_space') {
	    		$(value_holder).html(woocs_current_currency.symbol + ' ' + value);
	    	} else if (woocs_current_currency.position === 'right') {
	    		$(value_holder).html(value + woocs_current_currency.symbol);
	    	} else if (woocs_current_currency.position === 'right_space') {
	    		$(value_holder).html(value + ' ' + woocs_current_currency.symbol);
	    	}
	    } else {
		    if (wchweb_price_filter_params.currency_pos === 'left') {
		    	$(value_holder).html(wchweb_price_filter_params.currency_symbol + value);
		    } else if (wchweb_price_filter_params.currency_pos === 'left_space') {
		    	$(value_holder).html(wchweb_price_filter_params.currency_symbol + ' ' + value);
		    } else if (wchweb_price_filter_params.currency_pos === 'right') {
		    	$(value_holder).html(value + wchweb_price_filter_params.currency_symbol);
		    } else if (wchweb_price_filter_params.currency_pos === 'right_space') {
		    	$(value_holder).html(value + ' ' + wchweb_price_filter_params.currency_symbol);
		    }
	    }
	});    

    // initialize price slider
    wchwebInitPriceSlider();
});