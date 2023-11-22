/*
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
*/

var clearFilter = function() {

	var inp = $('#smartfilter').find('input[type="checkbox"]');
	var lastInput = false;

	inp.each(function ()
	{
		$(this).prop('checked','');
		lastInput =  $(this).attr('id');
	});

	var items = $('#smartfilter .c-poetry-filter__drawer').find('.c-poetry-filter__item');
	items.each(function (){
		$(this).removeClass('is-active','');
		span = $(this).find("button span.value").text('');
	});

	$('.c-poetry-filter__drawer *').removeClass('disabled');

	smartFilter.reload(document.getElementById(lastInput));
};


var resortResult = function(order)
{

	smartFilter.cache = [];
	$("input#sort").attr('value', order);

	//smartFilter.reload(document.getElementById(lastInput));

	$.get(sortUrl, {sort: order}, function(data){
		if (data == 'ok')
		{
			var inp = $('#smartfilter').find('input[type="checkbox"]');
			inp.each(function ()
			{
				lastInput =  $(this).attr('id');
			});

			smartFilter.reload(document.getElementById(lastInput));
		}
	});

	return false;

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
        //this.bindUrlToButton('del_filter', params.SEF_DEL_FILTER_URL);
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
		//this.createTagItem($(input));
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

	//this.createTagItem($(checkbox));

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
			this.cacheKey += values[i].name + ':' + values[i].value + '|';
		}

		if (this.cache[this.cacheKey])
		{
			this.curFilterinput = input;
			this.postHandler(this.cache[this.cacheKey], true);
			//console.log(this.cache[this.cacheKey]);
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

	if (arItem.VALUES)
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

						BX.addClass(label, 'disabled');
						BX.addClass(control.parentNode.parentNode, 'disabled');
					}
					else
					{
						BX.removeClass(label, 'disabled');
						BX.removeClass(control.parentNode.parentNode, 'disabled');
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

	//console.log(result);

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

				title = document.title;
				const state = {'items': result.ITEMS, 'sort': 'NAME'};
				history.pushState(state, title, url);

				var poetryFilter = document.querySelector('.c-poetry-filter');
				var clearBtn = $('.c-poetry-filter__filter-reset');

				if (result.SORT == "RAND")
				{
					$('.c-poetry-filter__group button').removeClass('is-active');
					$('#sortByRand').addClass('is-active');
				}

				if (result.SORT == "NAME")
				{
					$('.c-poetry-filter__group button').removeClass('is-active');
					$('#sortByName').addClass('is-active');
				}



				if (url !== "/poeziya/filter/clear/" || result.SORT == "RAND")
				{
					poetryFilter.classList.add ('c-poetry-filter--raised');
				}
				else
				{
					poetryFilter.classList.remove ('c-poetry-filter--raised');
				}

				if (url == "/poeziya/filter/clear/")
				{
					clearBtn.addClass('is-hidden');
				}
				else
				{
					clearBtn.removeClass('is-hidden');
				}

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

	//console.log(controlId);

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


$(function(){


	$('body').on('click', '.c-poetry-filter__dropdown-toggle', function () {
        var elem = $(this);
        var parent = elem.parent();
        elem.toggleClass('is-active').siblings('.c-poetry-filter__dropdown-menu').toggleClass('is-shown');
        parent.siblings()
            .find('.c-poetry-filter__dropdown-menu')
            .removeClass('is-shown')
            .parent()
            .find('.c-poetry-filter__dropdown-toggle')
			.removeClass('is-active');

        return false;
	});

    $(document).click(function (e) {
        if (!$('.c-poetry-filter__dropdown').is(e.target) && $('.c-poetry-filter__dropdown').has(e.target).length === 0) {
            $('.c-poetry-filter__dropdown-toggle').removeClass('is-active');
            $('.c-poetry-filter__dropdown-menu').removeClass('is-shown');
        };
	});

	$(window).scroll(function (e) {
		if (!$('.c-poetry-filter__dropdown').is(e.target) && $('.c-poetry-filter__dropdown').has(e.target).length === 0) {
            $('.c-poetry-filter__dropdown-toggle').removeClass('is-active');
            $('.c-poetry-filter__dropdown-menu').removeClass('is-shown');
        };
	});

	$('body').on('click', '.c-poetry-filter__check-link', function () {
		var drop = $(this).parent().parent().parent().parent().parent();
		var menu = drop.find('.c-poetry-filter__dropdown-menu');
		var inp = menu.find('input[type="checkbox"]');
        var arr = [];
        $(inp).each(function () {
            if ($(this).prop('checked') == true) {
                arr.push($(this).next().text());
            }
        });

		if (arr.length > 0)
		{
			drop.find('.value').text(arr + " - ");
			drop.addClass('is-active');
            if (drop.hasClass('sort__by')) {
                drop.find('.sort__value').text(arr);

            }
		}
		else if (arr.length == 0)
		{
			drop.find('.value').text('');
			drop.removeClass('is-active');
            drop.find('.sort__value').text('умолчанию');
        }
	});


});


BX.ready(function(){

	var loaderElement = '<div class="c-poetry-filter-loader c-poetry-filter__loader" id="poetryFilterLoader"></div>';

	if(!$("div").is("#poetryFilterLoader")) {
		$("body").prepend(loaderElement);
	}

	BX.showWait = function(node, msg) {
		$("#poetryFilterLoader").addClass('c-poetry-filter-loader--loading');
	};

	BX.closeWait = function(node, obMsg) {
		setTimeout(function() {
			$("#poetryFilterLoader").removeClass('c-poetry-filter-loader--loading');
		},1000);
	};

});
