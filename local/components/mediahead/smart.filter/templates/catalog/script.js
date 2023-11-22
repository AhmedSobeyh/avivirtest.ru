var citrusSmartFilterNumbers = function (data) {
	var arItem = data,
		$dopClass = arItem.CODE == "price_ye" ? ".b-payment-currency " : ".b-payment-rubles ",
		$minInput = $($dopClass+'.filter-numbers_input_min-price'),
		$maxInput = $($dopClass+'.filter-numbers_input_max-price'),
		$numberInputs = $minInput.add($maxInput),
		min = +arItem["VALUES"]["MIN"]["VALUE"],
		max = +arItem["VALUES"]["MAX"]["VALUE"];

	//doc https://github.com/autoNumeric/autoNumeric
	$numberInputs.autoNumeric('init', {
		digitGroupSeparator: ' ',
		digitalGroupSpacing: '3',
		decimalPlacesOverride: 0,
		minimumValue: 1,
		showWarnings: false
	});
	$numberInputs.attr('data-autonumeric', true);
};

function JCSmartFilter(ajaxURL, viewMode, params)
{
	this.ajaxURL = ajaxURL;
	this.form = document.getElementById('smartfilter') || null;
	this.timer = null;
	this.cacheKey = '';
	this.cache = [];
	this.viewMode = viewMode;
	if (params && params.SEF_SET_FILTER_URL)
    {
        this.bindUrlToButton('set_filter', params.SEF_SET_FILTER_URL);
        this.sef = true;
    }
    if (params && params.SEF_DEL_FILTER_URL)
    {
        this.bindUrlToButton('del_filter', params.SEF_DEL_FILTER_URL);
    }
}

JCSmartFilter.prototype.bindUrlToButton = function (buttonId, url)
{
    var button = BX(buttonId);
    if (button)
    {
        var proxy = function (j, func)
        {
            return function ()
            {
                return func(j);
            }
        };

        if (button.type == 'submit')
            button.type = 'button';

        BX.bind(button, 'click', proxy(url, function (url)
        {
            window.location.href = url;
            return false;
        }));
    }
};

JCSmartFilter.prototype.keyup = function(input)
{
	if(!!this.timer)
	{
		clearTimeout(this.timer);
	}
	this.timer = setTimeout(BX.delegate(function(){
		this.reload(input);
		this.createTagItem($(input));
	}, this), 500);
};

JCSmartFilter.prototype.click = function(checkbox)
{
	if(!!this.timer)
	{
		clearTimeout(this.timer);
	}

	this.timer = setTimeout(BX.delegate(function(){
		this.reload(checkbox);
	}, this), 500);
	this.createTagItem($(checkbox));
};

JCSmartFilter.prototype.reload = function(input)
{
	if (this.cacheKey !== '')
	{
		//Postprone backend query
		if(!!this.timer)
		{
			clearTimeout(this.timer);
		}
		this.timer = setTimeout(BX.delegate(function(){
			this.reload(input);
		}, this), 1000);
		return;
	}
	this.cacheKey = '|';

	this.position = BX.pos(input, true);
	this.form = BX.findParent(input, {'tag':'form'});
	if (this.form)
	{
		var values = [];
		values[0] = {name: 'ajax', value: 'y'};
		this.gatherInputsValues(values, BX.findChildren(this.form, {'tag': new RegExp('^(input|select)$', 'i')}, true));
		for (var i = 0; i < values.length; i++){
			if(values[i].name == "currencyValue" || values[i].name == "dometroValue" || values[i].name == "adress"){
				values.splice(i,1);
			}
			if(values[i].name == "arrFilter_77_MIN" || values[i].name == "arrFilter_77_MAX"){
				values[i].value = values[i].value.replace(/\s/g, '');
			}
		}
		for (var i = 0; i < values.length; i++){
			this.cacheKey += values[i].name + ':' + values[i].value + '|';
		}
		if (this.cache[this.cacheKey])
		{
			this.curFilterinput = input;
			this.postHandler(this.cache[this.cacheKey], true);
		}
		else
		{
			this.curFilterinput = input;
			BX.ajax.loadJSON(
				this.ajaxURL,
				this.values2post(values),
				BX.delegate(this.postHandler, this)
			);
		}
	}
};

JCSmartFilter.prototype.updateItem = function (PID, arItem)
{
	if (arItem.PROPERTY_TYPE === 'N' || arItem.PRICE)
	{
		var trackBar = window['trackBar' + PID];
		if (!trackBar && arItem.ENCODED_ID)
			trackBar = window['trackBar' + arItem.ENCODED_ID];

		if (trackBar && arItem.VALUES)
		{
			if (arItem.VALUES.MIN && arItem.VALUES.MIN.FILTERED_VALUE)
			{
				trackBar.setMinFilteredValue(arItem.VALUES.MIN.FILTERED_VALUE);
			}

			if (arItem.VALUES.MAX && arItem.VALUES.MAX.FILTERED_VALUE)
			{
				trackBar.setMaxFilteredValue(arItem.VALUES.MAX.FILTERED_VALUE);
			}
		}
	}
	else if (arItem.VALUES)
	{
		for (var i in arItem.VALUES)
		{
			if (arItem.VALUES.hasOwnProperty(i))
			{
				var value = arItem.VALUES[i];
				var control = BX(value.CONTROL_ID);

				if (!!control)
				{
					var label = document.querySelector('[data-role="label_'+value.CONTROL_ID+'"]:not(.ui-tabs-anchor)');
					if (value.DISABLED)
					{
						if (label)
							BX.addClass(label, 'disabled');
						else
							BX.addClass(control.parentNode, 'disabled');
					}
					else
					{
						if (label)
							BX.removeClass(label, 'disabled');
						else
							BX.removeClass(control.parentNode, 'disabled');
					}

					if (value.hasOwnProperty('ELEMENT_COUNT'))
					{
						label = document.querySelector('[data-role="count_'+value.CONTROL_ID+'"]');
						if (label)
							label.innerHTML = value.ELEMENT_COUNT;
					}
				}
			}
		}

		if(!$('.item_code_'+arItem.CODE).hasClass('bx_filter_select_container')) {
			if($('.item_code_'+arItem.CODE).find('label:not(.disabled)').length == 0){
				$('.item_code_'+arItem.CODE).addClass('hidden');
			}
			else  {
				$('.item_code_'+arItem.CODE).removeClass('hidden');
			}
		}
	}
};

JCSmartFilter.prototype.postHandler = function (result, fromCache)
{
	var hrefFILTER, url, curProp;
	//var modef = BX('modef');
	var modef_num = BX('set_filter'); 

	if (!!result && !!result.ITEMS)
	{
		for(var PID in result.ITEMS)
		{
			if (result.ITEMS.hasOwnProperty(PID))
			{
				this.updateItem(PID, result.ITEMS[PID]);
			}
		}

		if (/*!!modef &&*/ !!modef_num)
		{
			
			/*
			if(result.ELEMENT_COUNT > 0){
				modef_num.disabled = false;
				modef_num.value = "Показать объекты ("+result.ELEMENT_COUNT+")";
			} else {
				modef_num.disabled = true;
				modef_num.value = "Показать объекты";
			}
			*/
			
			//hrefFILTER = BX.findChildren(modef, {tag: 'A'}, true);

			/*if (result.FILTER_URL && hrefFILTER)
			{
				hrefFILTER[0].href = BX.util.htmlspecialcharsback(result.FILTER_URL);
			}

			if (result.FILTER_AJAX_URL && result.COMPONENT_CONTAINER_ID)
			{
				BX.bind(hrefFILTER[0], 'click', function(e)
				{
					url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
					BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
					return BX.PreventDefault(e);
				});
			}*/
			if (result.INSTANT_RELOAD && result.COMPONENT_CONTAINER_ID)
			{
				url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
				BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
			}
			else
			{
				/*if (modef.style.display === 'none')
				{
					modef.style.display = 'inline-block';
				}
				if (this.viewMode == "vertical")
				{
					curProp = BX.findChild(BX.findParent(this.curFilterinput, {'class':'bx_filter_parameters_box'}), {'class':'bx_filter_container_modef'}, true, false);
					curProp.appendChild(modef);
				}*/
				if (result.SEF_SET_FILTER_URL)
				{
					this.bindUrlToButton('set_filter', result.SEF_SET_FILTER_URL);
				}
			}
		}

	}

	if (!fromCache && this.cacheKey !== '')
	{
		this.cache[this.cacheKey] = result;
	}
	this.cacheKey = '';
};

JCSmartFilter.prototype.gatherInputsValues = function (values, elements)
{
	if(elements)
	{
		for(var i = 0; i < elements.length; i++)
		{
			var el = elements[i];

			if (el.disabled || !el.type || el.name == "currencyValue" || el.name == "dometroValue")
				continue;
			switch(el.type.toLowerCase())
			{
				case 'text':
				case 'textarea':
				case 'password':
				case 'hidden':
				case 'select-one':
					if(el.value.length)
						values[values.length] = {name : el.name, value : el.value};
					break;
				case 'radio':
				case 'checkbox':
					if(el.checked)
						values[values.length] = {name : el.name, value : el.value};
					break;
				case 'select-multiple':
					for (var j = 0; j < el.options.length; j++)
					{
						if (el.options[j].selected)
							values[values.length] = {name : el.name, value : el.options[j].value};
					}
					break;
				default:
					break;
			}
		}
	}
};

JCSmartFilter.prototype.values2post = function (values)
{
	var post = [];
	var current = post;
	var i = 0;

	while(i < values.length)
	{
		var p = values[i].name.indexOf('[');
		if(p == -1)
		{
			current[values[i].name] = values[i].value;
			current = post;
			i++;
		}
		else
		{
			var name = values[i].name.substring(0, p);
			var rest = values[i].name.substring(p+1);
			if(!current[name])
				current[name] = [];

			var pp = rest.indexOf(']');
			if(pp == -1)
			{
				//Error - not balanced brackets
				current = post;
				i++;
			}
			else if(pp == 0)
			{
				//No index specified - so take the next integer
				current = current[name];
				values[i].name = '' + current.length;
			}
			else
			{
				//Now index name becomes and name and we go deeper into the array
				current = current[name];
				values[i].name = rest.substring(0, pp) + rest.substring(pp+1);
			}
		}
	}
	return post;
};

JCSmartFilter.prototype.hideFilterProps = function(element)
{
	var easing;
	var obj = element.parentNode;
	var filterBlock = BX.findChild(obj, {className:"bx_filter_block"}, true, false);

	if(BX.hasClass(obj, "active"))
	{
		easing = new BX.easing({
			duration : 300,
			start : { opacity: 1,  height: filterBlock.offsetHeight },
			finish : { opacity: 0, height:0 },
			transition : BX.easing.transitions.quart,
			step : function(state){
				filterBlock.style.opacity = state.opacity;
				filterBlock.style.height = state.height + "px";
			},
			complete : function() {
				filterBlock.setAttribute("style", "");
				BX.removeClass(obj, "active");
			}
		});
		easing.animate();
	}
	else
	{
		filterBlock.style.display = "block";
		filterBlock.style.opacity = 0;
		filterBlock.style.height = "auto";

		var obj_children_height = filterBlock.offsetHeight;
		filterBlock.style.height = 0;

		easing = new BX.easing({
			duration : 300,
			start : { opacity: 0,  height: 0 },
			finish : { opacity: 1, height: obj_children_height },
			transition : BX.easing.transitions.quart,
			step : function(state){
				filterBlock.style.opacity = state.opacity;
				filterBlock.style.height = state.height + "px";
			},
			complete : function() {
			}
		});
		easing.animate();
		BX.addClass(obj, "active");
	}
};

JCSmartFilter.prototype.showDropDownPopup = function(element, popupId)
{
	var contentNode = element.querySelector('[data-role="dropdownContent"]');
	BX.PopupWindowManager.create("smartFilterDropDown"+popupId, element, {
		autoHide: true,
		offsetLeft: 0,
		offsetTop: 3,
		width: $(element).width(),
		overlay : false,
		draggable: {restrict:true},
		closeByEsc: true,
		content: contentNode
	}).show();
	$(element).toggleClass('toggle_open');
};

JCSmartFilter.prototype.selectDropDownItem = function(element, controlId, mobile = false)
{
	this.keyup(BX(controlId));
	var wrapContainer = BX.findParent(BX(controlId), {className:"bx_filter_select_container"}, false);
	var currentOption = wrapContainer.querySelector('[data-role="currentOption"]');
	currentOption.innerHTML = element.innerHTML;
	$(element).parents('ul').find('li label.active').removeClass('active');
	$(element).addClass('active');
	if(mobile) {
		$('.filter__tabs li.ui-tabs-active').removeClass('ui-tabs-active');
		$('.filter__tabs li a[data-role=label_'+controlId).parent().addClass('ui-tabs-active');
	}
	if(BX.PopupWindowManager.getCurrentPopup())
		BX.PopupWindowManager.getCurrentPopup().close();

};
JCSmartFilter.prototype.selectDropDownItemMobile = function(controlId,key)
{
	$('label[for='+controlId+']')
		.attr('onclick', 'smartFilter.selectDropDownItem(this, \''+controlId+'\',true)')
		.click()
		.attr('onclick', 'smartFilter.selectDropDownItem(this, \''+controlId+'\')');
	if(BX("smartFilterDropDown"+key))
		BX.PopupWindowManager.getCurrentPopup().close();
};

JCSmartFilter.prototype.deleteTagItem = function(controlId,type)
{
	switch (type) {
	  case "F":
	    BX(controlId).click();
	    break;
	  case "P":
	    $('label[for=all_'+controlId+']').click();
		if(BX.PopupWindowManager.getCurrentPopup())
			BX.PopupWindowManager.getCurrentPopup().close();
	    break;
	  case "A":
	    $('#'+controlId+'_MIN').val('');
	    $('#'+controlId+'_MAX').val('');
	    break;
	}
};

JCSmartFilter.prototype.setTagItem = function (selector, handler, input, span, id, text) {
	switch (handler) {
  		case "add":
  			$(selector).prepend(span);
  			break;
  		case "radio":
  			let name = input.attr("name");
  			span.attr("name",name);
  			$("span[name=" + name + "]").remove();
  			if(input.attr("id").indexOf("all_") !== 0)
  				$(selector).prepend(span);
  			break;
  		case "replace":
  			$(selector+" span[data-index=" + id + "]").text(text);
  			break;
  		case "remove":
  			$("span[data-index=" + id + "]").remove();
		    break;
	}
}

JCSmartFilter.prototype.createTagItem = function (input) {
	var id = input.attr("id"),
    	template = input.closest("[data-template]").attr("data-template"),
    	text,
    	span,
    	handler,
    	replace = false;

    switch (template) {
  		case "P":
		    text = $('label[for='+id).text();
		    if(input.attr("id").indexOf("all_") !== 0)
		    	id = input.siblings('input[id*="all_"]').attr("id").replace(/all_/,'');
		    handler = "radio";
		    break;
		case "A":
			let block = input.parents('.js-from-to-block').length ? input.parents('.js-from-to-block') : input.parents('.filter__item.from-to'),
				from = block.find('input[placeholder="от"]'),
				to = block.find('input[placeholder="до"]');

			text = "";
			id = id.replace(/_MIN/,'').replace(/_MAX/,'');

			if(from.val().length > 0)	
				text += " "+from.attr('placeholder')+" "+from.val();
			if(to.val().length > 0)	
				text += " "+to.attr('placeholder')+" "+to.val();
			if(text.length > 0) {
				text = block.find('.form__group label').text() + text;
				if(block.hasClass('js-from-to-block') && block.parent().find('.dropdown__toggle .value-new'))
					text += " "+block.parent().find('.dropdown__toggle .value-new').text();
				handler = "add";
				if($("span[data-index=" + id + "]").length > 0)
					handler = "replace";
			} else {
				handler = "remove";
			}
			break;
		default:
			text = input.siblings("label").text();
			if(input.siblings("label").attr('data-filterHint')){
				text = input.siblings("label").attr('data-filterHint') + text;
			}
			handler = input.prop("checked") ? "add" : "remove";
	}

    span = $('<span />', {
	    class: 'tags__item line line_1', 
	    'data-index':id,
	    onclick: 'smartFilter.deleteTagItem("'+ id +'", "'+ template +'")',
	    html: text 
	});

    if($(window).width() > 991) {
    	if($(".tags").hasClass("hidden") && $(".tags").find(".tags__item").length === 0) {
	        $(".tags").removeClass("hidden");
	    }
	    this.setTagItem(".tags .container",handler, input, span,id,text);
     	if($(".tags").find(".tags__item").length === 0) {
	        $(".tags").addClass("hidden");
	    }
    } else {
    	this.setTagItem(".filter__item_tags",handler, input, span,id,text);
    }
}

JCSmartFilter.prototype.searchDropdownItem = function (event, el) {
    var $searchInput = $(el),
        $container = $searchInput.parents('.filter__block'),
        searchParts = $searchInput.val().trim().toLowerCase().replace(/,/g, "").split(' '),
        $items = $container.find('.searched-block .dropdown__item'),
        $findedItems = false;

    if (searchParts.length) {
        $items.each(function (index, item) {
            var $item = $(item),
                matched = searchParts.reduce(function(matched, searchPart) {
                    return matched && $item.find('input:not(:checked)+label').text().toLocaleLowerCase().indexOf(searchPart) > -1;
                }, true);   
            $item[matched ? 'addClass' : 'removeClass']('_search-filtered');

        });
    }
    else {
        $items.addClass('_search-filtered');
    }
    $('.filter__item_adress .dropdown__menu').html('');
    $('.searched-block .dropdown__item._search-filtered').clone().appendTo(".filter__item_adress .dropdown__menu");
    $findedItems = $('.filter__item_adress .dropdown__menu .dropdown__item._search-filtered');
    if($findedItems.length){
    	$findedItems.each(function (index, item) {
    		let $item = $(item)
    		$item.find('input').attr('onclick', 'smartFilter.serchClickItem(this)');
    	});
    }
};

JCSmartFilter.prototype.serchClickItem = function (el) {
	var id = $(el).attr('id'),
		value = $(el).siblings('label').prop('title');
	$('.filter__item.filter__item_adress input[name=adress]').val(value);
	$('.filter__item_adress .dropdown__menu').html('');
	BX(id).click();
};

BX.namespace("BX.Iblock.SmartFilter");
BX.Iblock.SmartFilter = (function()
{
	var SmartFilter = function(arParams)
	{
		if (typeof arParams === 'object')
		{
			this.leftSlider = BX(arParams.leftSlider);
			this.rightSlider = BX(arParams.rightSlider);
			this.tracker = BX(arParams.tracker);
			this.trackerWrap = BX(arParams.trackerWrap);

			this.minInput = BX(arParams.minInputId);
			this.maxInput = BX(arParams.maxInputId);

			this.minPrice = parseFloat(arParams.minPrice);
			this.maxPrice = parseFloat(arParams.maxPrice);

			this.curMinPrice = parseFloat(arParams.curMinPrice);
			this.curMaxPrice = parseFloat(arParams.curMaxPrice);

			this.fltMinPrice = arParams.fltMinPrice ? parseFloat(arParams.fltMinPrice) : parseFloat(arParams.curMinPrice);
			this.fltMaxPrice = arParams.fltMaxPrice ? parseFloat(arParams.fltMaxPrice) : parseFloat(arParams.curMaxPrice);

			this.precision = arParams.precision || 0;

			this.priceDiff = this.maxPrice - this.minPrice;

			this.leftPercent = 0;
			this.rightPercent = 0;

			this.fltMinPercent = 0;
			this.fltMaxPercent = 0;

			this.colorUnavailableActive = BX(arParams.colorUnavailableActive);//gray
			this.colorAvailableActive = BX(arParams.colorAvailableActive);//blue
			this.colorAvailableInactive = BX(arParams.colorAvailableInactive);//light blue

			this.isTouch = false;

			this.init();

			if ('ontouchstart' in document.documentElement)
			{
				this.isTouch = true;

				BX.bind(this.leftSlider, "touchstart", BX.proxy(function(event){
					this.onMoveLeftSlider(event)
				}, this));

				BX.bind(this.rightSlider, "touchstart", BX.proxy(function(event){
					this.onMoveRightSlider(event)
				}, this));
			}
			else
			{
				BX.bind(this.leftSlider, "mousedown", BX.proxy(function(event){
					this.onMoveLeftSlider(event)
				}, this));

				BX.bind(this.rightSlider, "mousedown", BX.proxy(function(event){
					this.onMoveRightSlider(event)
				}, this));
			}

			BX.bind(this.minInput, "keyup", BX.proxy(function(event){
				this.onInputChange();
			}, this));

			BX.bind(this.maxInput, "keyup", BX.proxy(function(event){
				this.onInputChange();
			}, this));
		}
	};

	SmartFilter.prototype.init = function()
	{
		var priceDiff;

		if (this.curMinPrice > this.minPrice)
		{
			priceDiff = this.curMinPrice - this.minPrice;
			this.leftPercent = (priceDiff*100)/this.priceDiff;

			this.leftSlider.style.left = this.leftPercent + "%";
			this.colorUnavailableActive.style.left = this.leftPercent + "%";
		}

		this.setMinFilteredValue(this.fltMinPrice);

		if (this.curMaxPrice < this.maxPrice)
		{
			priceDiff = this.maxPrice - this.curMaxPrice;
			this.rightPercent = (priceDiff*100)/this.priceDiff;

			this.rightSlider.style.right = this.rightPercent + "%";
			this.colorUnavailableActive.style.right = this.rightPercent + "%";
		}

		this.setMaxFilteredValue(this.fltMaxPrice);
	};

	SmartFilter.prototype.setMinFilteredValue = function (fltMinPrice)
	{
		this.fltMinPrice = parseFloat(fltMinPrice);
		if (this.fltMinPrice >= this.minPrice)
		{
			var priceDiff = this.fltMinPrice - this.minPrice;
			this.fltMinPercent = (priceDiff*100)/this.priceDiff;

			if (this.leftPercent > this.fltMinPercent)
				this.colorAvailableActive.style.left = this.leftPercent + "%";
			else
				this.colorAvailableActive.style.left = this.fltMinPercent + "%";

			this.colorAvailableInactive.style.left = this.fltMinPercent + "%";
		}
		else
		{
			this.colorAvailableActive.style.left = "0%";
			this.colorAvailableInactive.style.left = "0%";
		}
	};

	SmartFilter.prototype.setMaxFilteredValue = function (fltMaxPrice)
	{
		this.fltMaxPrice = parseFloat(fltMaxPrice);
		if (this.fltMaxPrice <= this.maxPrice)
		{
			var priceDiff = this.maxPrice - this.fltMaxPrice;
			this.fltMaxPercent = (priceDiff*100)/this.priceDiff;

			if (this.rightPercent > this.fltMaxPercent)
				this.colorAvailableActive.style.right = this.rightPercent + "%";
			else
				this.colorAvailableActive.style.right = this.fltMaxPercent + "%";

			this.colorAvailableInactive.style.right = this.fltMaxPercent + "%";
		}
		else
		{
			this.colorAvailableActive.style.right = "0%";
			this.colorAvailableInactive.style.right = "0%";
		}
	};

	SmartFilter.prototype.getXCoord = function(elem)
	{
		var box = elem.getBoundingClientRect();
		var body = document.body;
		var docElem = document.documentElement;

		var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;
		var clientLeft = docElem.clientLeft || body.clientLeft || 0;
		var left = box.left + scrollLeft - clientLeft;

		return Math.round(left);
	};

	SmartFilter.prototype.getPageX = function(e)
	{
		e = e || window.event;
		var pageX = null;

		if (this.isTouch && event.targetTouches[0] != null)
		{
			pageX = e.targetTouches[0].pageX;
		}
		else if (e.pageX != null)
		{
			pageX = e.pageX;
		}
		else if (e.clientX != null)
		{
			var html = document.documentElement;
			var body = document.body;

			pageX = e.clientX + (html.scrollLeft || body && body.scrollLeft || 0);
			pageX -= html.clientLeft || 0;
		}

		return pageX;
	};

	SmartFilter.prototype.recountMinPrice = function()
	{
		var newMinPrice = (this.priceDiff*this.leftPercent)/100;
		newMinPrice = (this.minPrice + newMinPrice).toFixed(this.precision);

		if (newMinPrice != this.minPrice)
			this.minInput.value = newMinPrice;
		else
			this.minInput.value = "";
		smartFilter.keyup(this.minInput);
	};

	SmartFilter.prototype.recountMaxPrice = function()
	{
		var newMaxPrice = (this.priceDiff*this.rightPercent)/100;
		newMaxPrice = (this.maxPrice - newMaxPrice).toFixed(this.precision);

		if (newMaxPrice != this.maxPrice)
			this.maxInput.value = newMaxPrice;
		else
			this.maxInput.value = "";
		smartFilter.keyup(this.maxInput);
	};

	SmartFilter.prototype.onInputChange = function ()
	{
		var priceDiff;
		if (this.minInput.value)
		{
			var leftInputValue = this.minInput.value;
			if (leftInputValue < this.minPrice)
				leftInputValue = this.minPrice;

			if (leftInputValue > this.maxPrice)
				leftInputValue = this.maxPrice;

			priceDiff = leftInputValue - this.minPrice;
			this.leftPercent = (priceDiff*100)/this.priceDiff;

			this.makeLeftSliderMove(false);
		}

		if (this.maxInput.value)
		{
			var rightInputValue = this.maxInput.value;
			if (rightInputValue < this.minPrice)
				rightInputValue = this.minPrice;

			if (rightInputValue > this.maxPrice)
				rightInputValue = this.maxPrice;

			priceDiff = this.maxPrice - rightInputValue;
			this.rightPercent = (priceDiff*100)/this.priceDiff;

			this.makeRightSliderMove(false);
		}
	};

	SmartFilter.prototype.makeLeftSliderMove = function(recountPrice)
	{
		recountPrice = (recountPrice === false) ? false : true;

		this.leftSlider.style.left = this.leftPercent + "%";
		this.colorUnavailableActive.style.left = this.leftPercent + "%";

		var areBothSlidersMoving = false;
		if (this.leftPercent + this.rightPercent >= 100)
		{
			areBothSlidersMoving = true;
			this.rightPercent = 100 - this.leftPercent;
			this.rightSlider.style.right = this.rightPercent + "%";
			this.colorUnavailableActive.style.right = this.rightPercent + "%";
		}

		if (this.leftPercent >= this.fltMinPercent && this.leftPercent <= (100-this.fltMaxPercent))
		{
			this.colorAvailableActive.style.left = this.leftPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.right = 100 - this.leftPercent + "%";
			}
		}
		else if(this.leftPercent <= this.fltMinPercent)
		{
			this.colorAvailableActive.style.left = this.fltMinPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.right = 100 - this.fltMinPercent + "%";
			}
		}
		else if(this.leftPercent >= this.fltMaxPercent)
		{
			this.colorAvailableActive.style.left = 100-this.fltMaxPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.right = this.fltMaxPercent + "%";
			}
		}

		if (recountPrice)
		{
			this.recountMinPrice();
			if (areBothSlidersMoving)
				this.recountMaxPrice();
		}
	};

	SmartFilter.prototype.countNewLeft = function(event)
	{
		var pageX = this.getPageX(event);

		var trackerXCoord = this.getXCoord(this.trackerWrap);
		var rightEdge = this.trackerWrap.offsetWidth;

		var newLeft = pageX - trackerXCoord;

		if (newLeft < 0)
			newLeft = 0;
		else if (newLeft > rightEdge)
			newLeft = rightEdge;

		return newLeft;
	};

	SmartFilter.prototype.onMoveLeftSlider = function(e)
	{
		if (!this.isTouch)
		{
			this.leftSlider.ondragstart = function() {
				return false;
			};
		}

		if (!this.isTouch)
		{
			document.onmousemove = BX.proxy(function(event) {
				this.leftPercent = ((this.countNewLeft(event)*100)/this.trackerWrap.offsetWidth);
				this.makeLeftSliderMove();
			}, this);

			document.onmouseup = function() {
				document.onmousemove = document.onmouseup = null;
			};
		}
		else
		{
			document.ontouchmove = BX.proxy(function(event) {
				this.leftPercent = ((this.countNewLeft(event)*100)/this.trackerWrap.offsetWidth);
				this.makeLeftSliderMove();
			}, this);

			document.ontouchend = function() {
				document.ontouchmove = document.touchend = null;
			};
		}

		return false;
	};

	SmartFilter.prototype.makeRightSliderMove = function(recountPrice)
	{
		recountPrice = (recountPrice === false) ? false : true;

		this.rightSlider.style.right = this.rightPercent + "%";
		this.colorUnavailableActive.style.right = this.rightPercent + "%";

		var areBothSlidersMoving = false;
		if (this.leftPercent + this.rightPercent >= 100)
		{
			areBothSlidersMoving = true;
			this.leftPercent = 100 - this.rightPercent;
			this.leftSlider.style.left = this.leftPercent + "%";
			this.colorUnavailableActive.style.left = this.leftPercent + "%";
		}

		if ((100-this.rightPercent) >= this.fltMinPercent && this.rightPercent >= this.fltMaxPercent)
		{
			this.colorAvailableActive.style.right = this.rightPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.left = 100 - this.rightPercent + "%";
			}
		}
		else if(this.rightPercent <= this.fltMaxPercent)
		{
			this.colorAvailableActive.style.right = this.fltMaxPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.left = 100 - this.fltMaxPercent + "%";
			}
		}
		else if((100-this.rightPercent) <= this.fltMinPercent)
		{
			this.colorAvailableActive.style.right = 100-this.fltMinPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.left = this.fltMinPercent + "%";
			}
		}

		if (recountPrice)
		{
			this.recountMaxPrice();
			if (areBothSlidersMoving)
				this.recountMinPrice();
		}
	};

	SmartFilter.prototype.onMoveRightSlider = function(e)
	{
		if (!this.isTouch)
		{
			this.rightSlider.ondragstart = function() {
				return false;
			};
		}

		if (!this.isTouch)
		{
			document.onmousemove = BX.proxy(function(event) {
				this.rightPercent = 100-(((this.countNewLeft(event))*100)/(this.trackerWrap.offsetWidth));
				this.makeRightSliderMove();
			}, this);

			document.onmouseup = function() {
				document.onmousemove = document.onmouseup = null;
			};
		}
		else
		{
			document.ontouchmove = BX.proxy(function(event) {
				this.rightPercent = 100-(((this.countNewLeft(event))*100)/(this.trackerWrap.offsetWidth));
				this.makeRightSliderMove();
			}, this);

			document.ontouchend = function() {
				document.ontouchmove = document.ontouchend = null;
			};
		}

		return false;
	};

	return SmartFilter;
})();


$(function(){
	 
	$('body').on('click', '.filter__item_add .go-to', function () {
        $(this).toggleClass('active');
        $('.filter__block .hidden-item').toggleClass('visible-item');
        return false;
    }); 
	 
	 $('body').on('click', '.dropdown__toggle', function () {
        var elem = $(this);
        var parent = elem.parent();
        elem.toggleClass('dropdown__toggle_open').siblings('.dropdown__menu').toggleClass('hidden');
        parent.siblings()
            .find('.dropdown__menu')
            .addClass('hidden')
            .parent()
            .find('.dropdown__toggle')
            .removeClass('dropdown__toggle_open');
        return false;
    });
    $(document).click(function (e) {
        if (!$('.dropdown').is(e.target) && $('.dropdown').has(e.target).length === 0) {
            $('.dropdown__toggle').removeClass('dropdown__toggle_open');
            $('.dropdown__menu').addClass('hidden');
        };
    });
    $('body').on('click', '.dropdown__item', function () {
        var drop = $(this).parent().parent();
        var menu = drop.find('.dropdown__menu');
        var inp = menu.find('input[type=checkbox]');
        var arr = [];
        $(inp).each(function () {
            if ($(this).prop('checked') == true) {
                arr.push($(this).next().text());
            }
        });
        if (arr.length > 0) {
            drop.find('.value').text(arr + " - ");
            if (drop.hasClass('sort__by')) {
                drop.find('.sort__value').text(arr);

            }
        } else if (arr.length == 0) {
            drop.find('.value').text('');
            drop.find('.sort__value').text('умолчанию');
        }
    });
    $('body').on('click', '.form__reset', function () {
        var elem = $(this.form).find('.dropdown__toggle .value');
        $(this.form).find('.tags__item').remove();
        $(elem).each(function () {
            $(this).text('');
        });
    });
    $('body').on('click', '.s-filter__btn, .filter__back', function () {
		$('.filter').toggleClass('filter_hidden');
		if ($(".filter").hasClass("filter_hidden")) {
			$("body, html").css("overflow", "visible");			
		} else {
			$("body, html").css("overflow", "hidden");
		}
        return false;
    });
	
	 $('body').on('click', '.tags__item', function () {
        /*$("input[id=" + $(this).attr("data-index") + "]").prop("checked", false);*//*1*/
        $(this).remove();
        return false;
    });
    $("body").on("keyup", ".filter__item_adress input[type='text']", function () {
        if ($(this).val().length < 1) {
            $(this).parent().find('.dropdown__menu').addClass('hidden');
        } else {
            if ($(this).parent().find('.dropdown__menu').html().length > 1) {
                $(this).parent().find('.dropdown__menu').removeClass('hidden');
            }
        }
    });
    $("body").on("click", ".filter__item_adress input[type='text']", function () {
        $(this).val("");
    });
    $('body').on('click', '.sort__map', function () {
        $(this).find('span').toggleClass('hidden');
        $('#map').toggleClass('invisible');
    });
    $('body').on('click', '.tags__reset', function () {
        $('.bx_filter_search_reset#del_filter').click();
        $(this).siblings('.tags__item').remove();
    });
		
});