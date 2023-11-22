(function () {
	luxon.Settings.defaultLocale = luxon.DateTime.now().resolvedLocaleOptions().locale;

	var windowSizes = {
		big: false,
		small: false,
		extraSmall: false,
	};
	var checkWindowSize = function () {
		windowSizes.big = window.matchMedia("(min-width: 48em)").matches;
		windowSizes.small = window.matchMedia("(min-width: 32em)").matches;
		windowSizes.extraSmall = !windowSizes.small;
	};
	checkWindowSize();

	var COVID_DATA = {
		default: false,
		deep: false,
		regions_coordinates: false,
	};

	var COVID_UTILS = {
		date: {
			get: function (date) {
				return luxon.DateTime.fromISO(date);
			},
			formatEpoch: function (date) {
				return this.get(date).toMillis();
			},
			format: function (date, format) {
				return this.get(date).toFormat(format);
			},
			format_dd_dot_MM_dot_yy: function (date) {
				return this.format(date, "dd.MM.yy");
			},
			format_yyMMdd: function (date) {
				return this.format(date, "yyMMdd");
			},
			format_MMdd: function (date) {
				return this.format(date, "MMdd");
			},
			format_ddMMMM: function (date) {
				return this.format(date, "dd MMMM");
			},
			format_ddMMMMyyyy: function (date) {
				return this.format(date, "dd MMMM yyyy");
			},
			format_MMM: function (date) {
				return this.format(date, "MMM").substr(0, 3);
			},
			format_dd: function (date) {
				return this.format(date, "dd");
			},
			format_c: function (date) {
				return this.format(date, "c");
			},
		},
		localStorage: {
			get: function (key, defaultValue = null) {
				var val = localStorage.getItem(key);
				if (val === null) {
					val = defaultValue;
				}
				return val;
			},
			set: function (key, value) {
				localStorage.setItem(key, value);
			},
		},
		number: {
			format: function (number) {
				return new Intl.NumberFormat().format(number);
			},
			formatPrecision: function (number, precision = 2) {
				return number.toFixed(precision);
			},
		},
		table: {
			initCellDiv: function (className, innerText = undefined) {
				var cellDiv = document.createElement("div");
				cellDiv.className = className;
				if (innerText !== undefined && innerText !== null && innerText !== "") {
					cellDiv.innerText = innerText;
				}
				return cellDiv;
			},
		},
		colors: {
			calculatePoint: function (i, intervalSize, colorRangeInfo) {
				var { colorStart, colorEnd, useEndAsStart } = colorRangeInfo;
				return useEndAsStart ? colorEnd - i * intervalSize : colorStart + i * intervalSize;
			},
			interpolateColors(dataLength, colorScale, colorRangeInfo) {
				/* Must use an interpolated color scale, which has a range of [0, 1] */
				var { colorStart, colorEnd } = colorRangeInfo;
				var colorRange = colorEnd - colorStart;
				var intervalSize = colorRange / dataLength;
				var i, colorPoint;
				var colorArray = [];

				for (i = 0; i < dataLength; i++) {
					colorPoint = this.calculatePoint(i, intervalSize, colorRangeInfo);
					colorArray.push(colorScale(colorPoint));
				}

				return colorArray;
			},
		},
		charts: {
			resize: function (charts) {
				var chartKeys = Object.keys(charts);
				for (var i = 0; i < chartKeys.length; i++) {
					charts[chartKeys[i]].resize();
				}
			},
		},
	};

	var KEY_RUSSIA = 225;
	var KEY_RUSSIA_STRING = KEY_RUSSIA + "";

	var SELECTED_STAT_KEY = COVID_UTILS.localStorage.get("COVID_STAT_KEY", "russia_stat_struct");
	var SELECTED_EVENTS_PLACE = COVID_UTILS.localStorage.get("COVID_EVENTS_PLACE", KEY_RUSSIA); //где - 225 - это Россия

	var DATE_STYLES = {
		WORK: {
			color: "#1F4555",
		},
		WEEKEND: {
			color: "#DB414B",
		},

		getByDate(date) {
			var weekday = COVID_UTILS.date.format_c(date);
			return weekday === "6" || weekday === "7" ? this.WEEKEND : this.WORK;
		},
	};
	var COLOR_SETTINGS = {
		cases: {
			zeroColor: "#DFFDE6",
			scaleColor: {
				colorMin: "#9EF3C2",
				colorMax: "#116567",
			},
		},
		deaths: {
			zeroColor: "#DBF7F4",
			scaleColor: {
				colorMin: "#89CBD0",
				colorMax: "#081B2F",
			},
		},
	};

	//НАЧАЛО: Отрисовка статистики новым случаем и смертям
	var initViewEventsMainStats = function (info) {
		document.getElementById("eventsSearchInput").value = info.name;
		//Отображение главных цифр на дату по выбранному месту
		document.getElementById("eventsGeneralDate").textContent = COVID_UTILS.date.format_ddMMMM(info.date);
		document.getElementById("eventsGeneralCasesTotal").textContent = COVID_UTILS.number.format(info.cases);
		document.getElementById("eventsGeneralCasesDelta").textContent = `+${COVID_UTILS.number.format(info.cases_delta)}`;
		document.getElementById("eventsGeneralDeathsTotal").textContent = COVID_UTILS.number.format(info.deaths);
		document.getElementById("eventsGeneralDeathsDelta").textContent = `+${COVID_UTILS.number.format(info.deaths_delta)}`;

		var chartTitlePlaceElements = document.querySelectorAll("[data-chart-place]");
		for (var i = 0; i < chartTitlePlaceElements.length; i++) {
			chartTitlePlaceElements[i].innerText = info.short_name;
		}
	};

	//Отображение графиков "Число новых заражений и смертей"
	var initViewEventsChartCasesNDeaths = function (dates, cases, deaths, rendered) {
		panes.eventsTabPane.charts.casesNdeaths = echarts.init(document.getElementById("eventsChartCasesNDeaths"));
		panes.eventsTabPane.charts.casesNdeaths.on("rendered", rendered.initSetRendered("chartCasesNDeaths"));

		var xAxisData = dates;
		var seriesDataCases = cases.map((item, idx) => {
			return item[1];
		});
		var seriesDataDeaths = deaths.map((item, idx) => {
			return item[1];
		});

		var casesMin = cases[0][1];
		var casesMax = cases[0][1];
		cases.forEach((item) => {
			var itemValue = item[1];
			if (itemValue > casesMax) {
				casesMax = itemValue;
			}
			if (itemValue < casesMin) {
				casesMin = itemValue;
			}
		});
		var scaleColor = d3
			.scaleLinear()
			.domain([casesMin, casesMax])
			.range([COLOR_SETTINGS.cases.scaleColor.colorMin, COLOR_SETTINGS.cases.scaleColor.colorMax]);

		var scaleColorTicks = scaleColor.ticks(5);
		var visualMapPieces = scaleColorTicks.map((item, idx) => {
			return {
				gt: idx > 0 ? scaleColorTicks[idx - 1] : casesMin,
				lte: idx < scaleColorTicks.length - 1 ? item : casesMax,
				color: scaleColor(item),
			};
		});

		var deathsMax = deaths[0][1];
		deaths.forEach((item) => {
			var itemValue = item[1];
			if (itemValue > deathsMax) {
				deathsMax = itemValue;
			}
		});

		// specify chart configuration item and data
		var option = {
			tooltip: {
				trigger: "axis",
				formatter(params, ticket, callback) {
					var tooltipItems = [
						`<div><span>Данные на ${COVID_UTILS.date.format_ddMMMMyyyy(dates[params[0].dataIndex])}</span></div>`,
						`<div class="data-row"><span class="data-row-title">${
							params[0].seriesName
						}</span><span class="data-row-value">${COVID_UTILS.number.format(params[0].value)}</span></div>`,
						`<div class="data-row"><span class="data-row-title">${
							params[1].seriesName
						}</span><span class="data-row-value">${COVID_UTILS.number.format(params[1].value)}</span></div>`,
					];
					return `<div class="chart-tooltip-cases-n-deaths">${tooltipItems.join("")}</div>`;
				},
			},
			xAxis: {
				data: xAxisData,
				boundaryGap: false,
				axisLabel: {
					formatter: function (value, index) {
						return COVID_UTILS.date.format_dd_dot_MM_dot_yy(value);
					},
				},
			},
			dataZoom: [
				{
					startValue: xAxisData[xAxisData.length - 100],
					labelFormatter: function (value, valueStr) {
						return COVID_UTILS.date.format_dd_dot_MM_dot_yy(valueStr);
					},
				},
				{
					type: "inside",
				},
			],
			yAxis: [
				{
					show: false,
					offset: 100,
					min: 0,
				},
				{
					show: false,
					max: deathsMax * 10,
					min: 0,
				},
			],
			grid: {
				left: 0,
				top: 0,
				bottom: 70,
				right: 0,
			},
			series: [
				{
					name: "Новых заражений",
					type: "line",
					symbol: "none",
					sampling: "lttb",
					data: seriesDataCases,
					label: {
						formatter(params) {
							return COVID_UTILS.number.format(params.value);
						},
					},
					yAxisIndex: 0,
				},
				{
					name: "Новых смертей",
					type: "line",
					symbol: "none",
					sampling: "lttb",
					itemStyle: {
						color: "rgba(255,255,255,0)",
					},
					areaStyle: {
						color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
							{
								offset: 1,
								color: COLOR_SETTINGS.deaths.scaleColor.colorMin,
							},
							{
								offset: 0,
								color: COLOR_SETTINGS.deaths.scaleColor.colorMax,
							},
						]),
					},
					data: seriesDataDeaths,
					yAxisIndex: 1,
				},
			],
			visualMap: {
				show: false,
				top: 50,
				right: 10,
				pieces: visualMapPieces,
				outOfRange: {
					color: "#999",
				},
				seriesIndex: 0,
			},
		};

		// use configuration item and data specified to show chart
		panes.eventsTabPane.charts.casesNdeaths.setOption(option);
	};

	//Отображение графиков "Число новых заражений"
	var initViewEventsChartCases = function (dates, cases, rendered) {
		panes.eventsTabPane.charts.cases = echarts.init(document.getElementById("eventsChartCases"));
		panes.eventsTabPane.charts.cases.on("rendered", rendered.initSetRendered("chartCases"));

		var xAxisData = dates;
		var seriesData = cases.map((item, idx) => {
			return item[1];
		});

		var casesMin = cases[0][1];
		var casesMax = cases[0][1];
		cases.forEach((item) => {
			var itemValue = item[1];
			if (itemValue > casesMax) {
				casesMax = itemValue;
			}
			if (itemValue < casesMin) {
				casesMin = itemValue;
			}
		});
		var scaleColor = d3
			.scaleLinear()
			.domain([casesMin, casesMax])
			.range([COLOR_SETTINGS.cases.scaleColor.colorMin, COLOR_SETTINGS.cases.scaleColor.colorMax]);

		var scaleColorTicks = scaleColor.ticks(5);
		var visualMapPieces = scaleColorTicks.map((item, idx) => {
			return {
				gt: idx > 0 ? scaleColorTicks[idx - 1] : casesMin,
				lte: idx < scaleColorTicks.length - 1 ? item : casesMax,
				color: scaleColor(item),
			};
		});

		// specify chart configuration item and data
		var option = {
			tooltip: {
				trigger: "axis",
			},
			xAxis: {
				data: xAxisData,
				boundaryGap: false,
				show: false,
			},
			yAxis: {
				show: false,
			},
			grid: {
				left: 0,
				top: 20,
				bottom: 20,
				right: 0,
			},
			series: [
				{
					name: "новых заражений",
					type: "line",
					symbol: "none",
					sampling: "lttb",
					data: seriesData,
					label: {
						formatter(params) {
							return COVID_UTILS.number.format(params.value);
						},
					},
				},
			],
			visualMap: {
				show: false,
				top: 50,
				right: 10,
				pieces: visualMapPieces,
				outOfRange: {
					color: "#999",
				},
			},
		};

		// use configuration item and data specified to show chart
		panes.eventsTabPane.charts.cases.setOption(option);
	};

	//Отображение графиков "Число новых смертей"
	var initViewEventsChartDeaths = function (dates, deaths, rendered) {
		panes.eventsTabPane.charts.deaths = echarts.init(document.getElementById("eventsChartDeaths"));
		panes.eventsTabPane.charts.deaths.on("rendered", rendered.initSetRendered("chartDeaths"));

		var xAxisData = dates;
		var seriesData = deaths.map((item, idx) => {
			return item[1];
		});

		// specify chart configuration item and data
		var option = {
			tooltip: {
				trigger: "axis",
			},
			xAxis: {
				data: xAxisData,
				boundaryGap: false,
			},
			yAxis: {
				show: false,
			},
			grid: {
				left: 0,
				top: 20,
				bottom: 20,
				right: 0,
			},
			series: [
				{
					name: "новых смертей",
					type: "line",
					symbol: "none",
					sampling: "lttb",
					itemStyle: {
						color: "rgba(255,255,255,0)",
					},
					areaStyle: {
						color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
							{
								offset: 1,
								color: COLOR_SETTINGS.deaths.scaleColor.colorMin,
							},
							{
								offset: 0,
								color: COLOR_SETTINGS.deaths.scaleColor.colorMax,
							},
						]),
					},
					data: seriesData,
				},
			],
		};

		// use configuration item and data specified to show chart
		panes.eventsTabPane.charts.deaths.setOption(option);
	};

	//Отображение графика "Число новых заражений в последние три недели, тыс."
	var initViewEventsChartNewThreeWeeksCases = function (population, dates, cases, rendered) {
		panes.eventsTabPane.chartsData.newThreeWeeksCases = {
			population,
		};
		panes.eventsTabPane.charts.newThreeWeeksCases = echarts.init(document.getElementById("eventsChartNewThreeWeeksCases"));
		panes.eventsTabPane.charts.newThreeWeeksCases.on("rendered", rendered.initSetRendered("chartNewThreeWeeksCases"));

		var populationCoeff = population / 100000.0; //Коэффициент для определения количества заражений на 100 тыс. населения
		var casesDates = dates.slice(dates.length - 21);
		var casesDatesP1 = dates.slice(dates.length - 22);
		var casesList = cases.slice(dates.length - 21);
		var casesListP1 = cases.slice(dates.length - 22);

		var casesMin = casesList[0][1];
		var casesMax = casesList[0][1];
		casesList.forEach((item) => {
			var itemValue = item[1];
			if (itemValue > casesMax) {
				casesMax = itemValue;
			}
			if (itemValue < casesMin) {
				casesMin = itemValue;
			}
		});
		var scaleColor = d3
			.scaleLinear()
			.domain([casesMin, casesMax])
			.range([COLOR_SETTINGS.cases.scaleColor.colorMin, COLOR_SETTINGS.cases.scaleColor.colorMax]);

		panes.eventsTabPane.chartsData.newThreeWeeksCases = {
			population,
			casesDates,
			casesDatesP1,
			casesList,
			casesListP1,
			scaleColor,
			windowSizesExtraSmall: windowSizes.extraSmall,
			initOption() {
				var that = this;

				let sliceIdx = this.windowSizesExtraSmall ? 7 : 0;

				var casesDates = this.casesDates.slice(sliceIdx);
				var casesDatesP1 = this.casesDatesP1.slice(sliceIdx);
				var casesList = this.casesList.slice(sliceIdx);
				var casesListP1 = this.casesListP1.slice(sliceIdx);

				var xAxisData = casesDates.map(function (item) {
					return {
						value: COVID_UTILS.date.format_dd(item),
						textStyle: DATE_STYLES.getByDate(item),
					};
				});
				var seriesData = casesList.map((item, idx) => {
					var itemDate = COVID_UTILS.date.format_ddMMMM(casesDates[idx]);
					var itemDatePrevious = COVID_UTILS.date.format_ddMMMM(casesDatesP1[idx]);
					var itemValue = item[1];
					var itemValuePrevious = casesListP1[idx][1];
					var itemValuePreviousPercent = itemValuePrevious > 0 ? ((itemValue - itemValuePrevious) / itemValuePrevious) * 100.0 : 100.0;

					var itemValueTotal = item[0];
					var itemValueTotalPrevious = casesListP1[idx][0];
					var itemValueTotalPreviousPercent =
						itemValuePrevious > 0 ? ((itemValueTotal - itemValueTotalPrevious) / itemValueTotalPrevious) * 100.0 : 100.0;

					var itemValueTotalByPopulationCoeff = itemValueTotal / populationCoeff;

					var tooltipText = [
						`<div><span>Данные на ${itemDate}</span></div>`,
						`<div class="data-row"><span class="data-row-title">Новых заражений</span><span class="data-row-value">${COVID_UTILS.number.format(
							itemValue
						)}</span></div>`,
						itemValuePrevious > 0
							? `<div class="data-row"><span class="data-row-title">По сравнению с ${itemDatePrevious}</span><span class="data-row-value">${
									itemValuePreviousPercent > 0 ? "+" : ""
							  }${COVID_UTILS.number.formatPrecision(itemValuePreviousPercent, 1)}%</span></div>`
							: "",
						"<hr>",
						`<div class="data-row"><span class="data-row-title">Всего заражений</span><span class="data-row-value">${COVID_UTILS.number.format(
							itemValueTotal
						)}</span></div>`,
						itemValuePrevious > 0
							? `<div class="data-row"><span class="data-row-title">По сравнению с ${itemDatePrevious}</span><span class="data-row-value">${
									itemValueTotalPreviousPercent > 0 ? "+" : ""
							  }${COVID_UTILS.number.formatPrecision(itemValueTotalPreviousPercent, 1)}%</span></div>`
							: "",
						`<div class="data-row"><span class="data-row-title">на 100 тыс. человек</span><span class="data-row-value">${COVID_UTILS.number.format(
							COVID_UTILS.number.formatPrecision(itemValueTotalByPopulationCoeff, 1)
						)}</span></div>`,
					];
					return {
						_tooltipText: `<div class="chart-tooltip-new-three-weeks-cases">${tooltipText.join("")}</div>`,
						value: COVID_UTILS.number.formatPrecision(itemValue / 1000.0, 1),
						itemStyle: {
							color: that.scaleColor(itemValue),
						},
					};
				});
				return {
					xAxis: {
						data: xAxisData,
					},
					series: [
						{
							name: "заражения",
							type: "bar",
							data: seriesData,
							label: {
								show: true,
								position: "top",
							},
						},
					],
				};
			},
		};

		// specify chart configuration item and data
		var option = Object.assign(
			{
				yAxis: {
					show: false,
				},
				grid: {
					left: 0,
					top: 20,
					bottom: 20,
					right: 0,
				},
				tooltip: {
					formatter(params, ticket, callback) {
						return params.data._tooltipText;
					},
				},
			},
			panes.eventsTabPane.chartsData.newThreeWeeksCases.initOption()
		);

		// use configuration item and data specified to show chart
		panes.eventsTabPane.charts.newThreeWeeksCases.setOption(option);
	};

	//Отображение графика "Число новых смертей в последние три недели, тыс."
	var initViewEventsChartNewThreeWeeksDeaths = function (population, dates, deaths, rendered) {
		panes.eventsTabPane.charts.newThreeWeeksDeaths = echarts.init(document.getElementById("eventsChartNewThreeWeeksDeaths"));
		panes.eventsTabPane.charts.newThreeWeeksDeaths.on("rendered", rendered.initSetRendered("chartNewThreeWeeksDeaths"));

		var populationCoeff = population / 100000.0; //Коэффициент для определения количества заражений на 100 тыс. населения
		var deathsDates = dates.slice(dates.length - 21);
		var deathsDatesP1 = dates.slice(dates.length - 22);
		var deathsList = deaths.slice(dates.length - 21);
		var deathsListP1 = deaths.slice(dates.length - 22);

		var deathsMin = deathsList[0][1];
		var deathsMax = deathsList[0][1];
		deathsList.forEach((item) => {
			var itemValue = item[1];
			if (itemValue > deathsMax) {
				deathsMax = itemValue;
			}
			if (itemValue < deathsMin) {
				deathsMin = itemValue;
			}
		});
		var scaleColor = d3
			.scaleLinear()
			.domain([deathsMin, deathsMax])
			.range([COLOR_SETTINGS.deaths.scaleColor.colorMin, COLOR_SETTINGS.deaths.scaleColor.colorMax]);

		panes.eventsTabPane.chartsData.newThreeWeeksDeaths = {
			population,
			deathsDates,
			deathsDatesP1,
			deathsList,
			deathsListP1,
			scaleColor,
			windowSizesExtraSmall: windowSizes.extraSmall,
			initOption() {
				var that = this;

				let sliceIdx = this.windowSizesExtraSmall ? 7 : 0;

				var deathsDates = this.deathsDates.slice(sliceIdx);
				var deathsDatesP1 = this.deathsDatesP1.slice(sliceIdx);
				var deathsList = this.deathsList.slice(sliceIdx);
				var deathsListP1 = this.deathsListP1.slice(sliceIdx);

				var xAxisData = deathsDates.map(function (item) {
					return {
						value: COVID_UTILS.date.format_dd(item),
						textStyle: DATE_STYLES.getByDate(item),
					};
				});
				var seriesData = deathsList.map((item, idx) => {
					var itemDate = COVID_UTILS.date.format_ddMMMM(deathsDates[idx]);
					var itemDatePrevious = COVID_UTILS.date.format_ddMMMM(deathsDatesP1[idx]);
					var itemValue = item[1];
					var itemValuePrevious = deathsListP1[idx][1];
					var itemValuePreviousPercent = itemValuePrevious > 0 ? ((itemValue - itemValuePrevious) / itemValuePrevious) * 100.0 : 100.0;

					var itemValueTotal = item[0];
					var itemValueTotalPrevious = deathsListP1[idx][0];
					var itemValueTotalPreviousPercent =
						itemValuePrevious > 0 ? ((itemValueTotal - itemValueTotalPrevious) / itemValueTotalPrevious) * 100.0 : 100.0;

					var itemValueTotalByPopulationCoeff = itemValueTotal / populationCoeff;

					var tooltipText = [
						`<div><span>Данные на ${itemDate}</span></div>`,
						`<div class="data-row"><span class="data-row-title">Новых смертей</span><span class="data-row-value">${COVID_UTILS.number.format(
							itemValue
						)}</span></div>`,
						itemValuePrevious > 0
							? `<div class="data-row"><span class="data-row-title">По сравнению с ${itemDatePrevious}</span><span class="data-row-value">${
									itemValuePreviousPercent > 0 ? "+" : ""
							  }${COVID_UTILS.number.formatPrecision(itemValuePreviousPercent, 1)}%</span></div>`
							: "",
						"<hr>",
						`<div class="data-row"><span class="data-row-title">Всего смертей</span><span class="data-row-value">${COVID_UTILS.number.format(
							itemValueTotal
						)}</span></div>`,
						itemValuePrevious > 0
							? `<div class="data-row"><span class="data-row-title">По сравнению с ${itemDatePrevious}</span><span class="data-row-value">${
									itemValueTotalPreviousPercent > 0 ? "+" : ""
							  }${COVID_UTILS.number.formatPrecision(itemValueTotalPreviousPercent, 1)}%</span></div>`
							: "",
						`<div class="data-row"><span class="data-row-title">на 100 тыс. человек</span><span class="data-row-value">${COVID_UTILS.number.format(
							COVID_UTILS.number.formatPrecision(itemValueTotalByPopulationCoeff, 1)
						)}</span></div>`,
					];
					return {
						_tooltipText: `<div class="chart-tooltip-new-three-weeks-deaths">${tooltipText.join("")}</div>`,
						value: itemValue,
						itemStyle: {
							color: that.scaleColor(itemValue),
						},
					};
				});
				return {
					xAxis: {
						data: xAxisData,
					},
					series: [
						{
							name: "смерти",
							type: "bar",
							data: seriesData,
							label: {
								show: true,
								position: "top",
								formatter(params) {
									return COVID_UTILS.number.format(params.value);
								},
							},
						},
					],
				};
			},
		};

		// specify chart configuration item and data
		var option = Object.assign(
			{
				tooltip: {},
				yAxis: {
					show: false,
				},
				grid: {
					left: 0,
					top: 20,
					bottom: 20,
					right: 0,
				},
				tooltip: {
					formatter(params, ticket, callback) {
						return params.data._tooltipText;
					},
				},
			},
			panes.eventsTabPane.chartsData.newThreeWeeksDeaths.initOption()
		);

		// use configuration item and data specified to show chart
		panes.eventsTabPane.charts.newThreeWeeksDeaths.setOption(option);
	};

	// eventsToolbarPlaces
	var initViewButtonsPlaces = function () {
		var buttonPlaceOnClick = function () {
			this.classList.remove("c-btn--kind-outline-primary");
			this.classList.add("c-btn--kind-primary");

			getSiblings(this).forEach((item) => {
				item.classList.remove("c-btn--kind-primary");
				item.classList.add("c-btn--kind-outline-primary");
			});

			COVID_UTILS.localStorage.set("COVID_STAT_KEY", this.dataset.stat_key);
			COVID_UTILS.localStorage.set("COVID_EVENTS_PLACE", this.dataset.key);

			SELECTED_STAT_KEY = this.dataset.stat_key;
			SELECTED_EVENTS_PLACE = this.dataset.key;
			initViewEventsData();
		};

		var toolbarPlacesElement = document.getElementById("eventsToolbarPlaces");

		var buttonsPlaces = [
			{
				key: 1,
				stat_key: "russia_stat_struct",
			},
			{
				key: 213,
				stat_key: "russia_stat_struct",
			},
			{
				key: KEY_RUSSIA,
				stat_key: "russia_stat_struct",
			},
			{
				key: 10000,
				stat_key: "world_stat_struct",
			},
		];

		buttonsPlaces.forEach((item) => {
			var itemInfo = COVID_DATA.deep[item.stat_key].data[item.key].info;
			var button = document.createElement("button");
			button.classList.add("c-btn", "c-btn--size-xs", "c-btn--kind-outline-primary");

			if (SELECTED_EVENTS_PLACE == item.key) {
				button.classList.remove("c-btn--kind-outline-primary");
				button.classList.add("c-btn--kind-primary");
			}

			button.dataset.key = item.key;
			button.dataset.stat_key = item.stat_key;
			button.innerHTML = `
				<span class="c-btn__overlay"></span>
				<span class="c-btn__content">
					${itemInfo.short_name}
				</span>
			`;
			button.onclick = buttonPlaceOnClick;
			toolbarPlacesElement.appendChild(button);
		});
	};

	var initViewPlaces = function () {
		var inputSearch = document.getElementById("eventsSearchInput");
		var searchMenuEl = document.getElementById("eventsSearchMenu");
		var searchVariantsEl = document.getElementById("eventsSearchVariants");

		searchMenuEl.style.left = convertToUnit(inputSearch.offsetLeft);
		searchMenuEl.style.top = inputSearch.offsetTop + convertToUnit(inputSearch.offsetHeight);
		searchMenuEl.style.width = convertToUnit(inputSearch.offsetWidth);

		var onClickVariant = function () {
			COVID_UTILS.localStorage.set("COVID_STAT_KEY", this.dataset.stat_key);
			COVID_UTILS.localStorage.set("COVID_EVENTS_PLACE", this.dataset.key);

			SELECTED_STAT_KEY = this.dataset.stat_key;
			SELECTED_EVENTS_PLACE = this.dataset.key;
			clearVariants();
			initViewEventsData();

			var toolbarPlacesElement = document.getElementById("eventsToolbarPlaces");

			var buttonsPlaces = toolbarPlacesElement.querySelectorAll("[data-key]");

			buttonsPlaces.forEach((button) => {
				if (SELECTED_EVENTS_PLACE === button.dataset.key) {
					button.classList.remove("c-btn--kind-outline-primary");
					button.classList.add("c-btn--kind-primary");
				} else {
					button.classList.remove("c-btn--kind-primary");
					button.classList.add("c-btn--kind-outline-primary");
				}
			});
		};

		var clearVariants = function () {
			searchMenuEl.classList.remove("is-shown");
			while (searchVariantsEl.firstChild) {
				searchVariantsEl.firstChild.remove();
			}
		};

		var debouncedSearch = _.debounce(function (value) {
			var search = value.toLowerCase();
			clearVariants();

			if (search !== "") {
				var russiaFound = COVID_DATA.deep_keys.russia_stat_struct
					.filter(function (key) {
						return COVID_DATA.deep.russia_stat_struct.data[key].info.name.toLowerCase().indexOf(search) > -1;
					})
					.map(function (key) {
						return {
							key,
							stat_key: "russia_stat_struct",
							info: COVID_DATA.deep.russia_stat_struct.data[key].info,
						};
					});
				var worldFound = COVID_DATA.deep_keys.world_stat_struct
					.filter(function (key) {
						return COVID_DATA.deep.world_stat_struct.data[key].info.name.toLowerCase().indexOf(search) > -1;
					})
					.map(function (key) {
						return {
							key,
							stat_key: "world_stat_struct",
							info: COVID_DATA.deep.world_stat_struct.data[key].info,
						};
					});

				if (russiaFound.length > 0 || worldFound.length > 0) {
					var initVariant = function (item) {
						var divVariant = document.createElement("div");
						divVariant.className = "c-list-item c-list-item--clickable";
						divVariant.dataset.stat_key = item.stat_key;
						divVariant.dataset.key = item.key;
						divVariant.innerText = item.info.name;
						divVariant.onclick = onClickVariant;
						searchVariantsEl.appendChild(divVariant);
					};
					if (russiaFound.length > 0) {
						var divRussiaTitle = document.createElement("div");
						divRussiaTitle.className = "c-list-item c-list-item--title";
						divRussiaTitle.classList.add("search-variants-title");
						divRussiaTitle.innerText = "Найдено в России";
						searchVariantsEl.appendChild(divRussiaTitle);
						russiaFound.forEach(initVariant);
					}
					if (worldFound.length > 0) {
						var divWorldTitle = document.createElement("div");
						divWorldTitle.className = "c-list-item c-list-item--title";
						divWorldTitle.classList.add("search-variants-title");
						divWorldTitle.innerText = "Найдено в Мире";
						searchVariantsEl.appendChild(divWorldTitle);
						worldFound.forEach(initVariant);
					}
					searchMenuEl.classList.add("is-shown");
				}
			}
		}, 300);
		inputSearch.oninput = function () {
			debouncedSearch(this.value);
		};
		initViewButtonsPlaces();
	};

	var initViewEventsData = function (callbackFinished) {
		var dataDeepStat = COVID_DATA.deep[SELECTED_STAT_KEY];
		if (dataDeepStat.data.hasOwnProperty(SELECTED_EVENTS_PLACE) === true) {
			var rendered = {
				chartCasesNDeaths: false,
				chartCases: false,
				chartDeaths: false,
				chartNewThreeWeeksCases: false,
				chartNewThreeWeeksDeaths: false,
				initSetRendered(key) {
					let that = this;
					return function () {
						that[key] = true;
						that.check();
					};
				},
				check() {
					if (
						this.chartCasesNDeaths &&
						this.chartCases &&
						this.chartDeaths &&
						this.chartNewThreeWeeksCases &&
						this.chartNewThreeWeeksDeaths
					) {
						if (typeof callbackFinished === "function") {
							callbackFinished();
						}
					}
				},
			};

			var data = dataDeepStat.data[SELECTED_EVENTS_PLACE];
			initViewEventsMainStats(data.info, rendered);
			initViewEventsChartCasesNDeaths(dataDeepStat.dates, data.cases, data.deaths, rendered);
			initViewEventsChartCases(dataDeepStat.dates, data.cases, rendered);
			initViewEventsChartDeaths(dataDeepStat.dates, data.deaths, rendered);
			initViewEventsChartNewThreeWeeksCases(data.info.population, dataDeepStat.dates, data.cases, rendered);
			initViewEventsChartNewThreeWeeksDeaths(data.info.population, dataDeepStat.dates, data.deaths, rendered);
		} else {
			console.error(`data.default does not have key="${SELECTED_EVENTS_PLACE}"`);
			if (typeof callbackFinished === "function") {
				callbackFinished();
			}
		}
	};

	var initViewEventsChartThreeWeeksCountText = function () {
		let weekCountText = windowSizes.extraSmall ? "две" : "три";

		var chatWeekCountElements = document.querySelectorAll("[data-chart-week-count]");
		for (var i = 0; i < chatWeekCountElements.length; i++) {
			chatWeekCountElements[i].innerText = weekCountText;
		}
	};

	var initViewEvents = function (callbackInited) {
		initViewPlaces();
		initViewEventsChartThreeWeeksCountText();
		initViewEventsData(function () {
			callbackInited();
		});
	};
	var resizeEvents = function () {
		if (windowSizes.extraSmall !== panes.eventsTabPane.chartsData.newThreeWeeksCases.windowSizesExtraSmall) {
			initViewEventsChartThreeWeeksCountText();

			panes.eventsTabPane.chartsData.newThreeWeeksCases.windowSizesExtraSmall = windowSizes.extraSmall;
			panes.eventsTabPane.charts.newThreeWeeksCases.setOption(panes.eventsTabPane.chartsData.newThreeWeeksCases.initOption(), {
				replaceMerge: ["xAxis", "series"],
			});

			panes.eventsTabPane.chartsData.newThreeWeeksDeaths.windowSizesExtraSmall = windowSizes.extraSmall;
			panes.eventsTabPane.charts.newThreeWeeksDeaths.setOption(panes.eventsTabPane.chartsData.newThreeWeeksDeaths.initOption(), {
				replaceMerge: ["xAxis", "series"],
			});
		}
		COVID_UTILS.charts.resize(panes.eventsTabPane.charts);
	};
	//КОНЕЦ: Отрисовка статистики новым случаем и смертям

	//НАЧАЛО: Отрисовка статистики по регионам РФ и странам
	var initViewStatTableCellStat = function (cellDiv, cases, dates) {
		if (cases.length > 0) {
			var casesMin = cases[0][1];
			var casesMax = cases[0][1];

			cases.forEach(function (itemDataCasesItem) {
				var itemValue = itemDataCasesItem[1];
				if (itemValue > casesMax) {
					casesMax = itemValue;
				}
				if (itemValue < casesMin) {
					casesMin = itemValue;
				}
			});

			var scaleColor = d3
				.scaleLinear()
				.domain([casesMin, casesMax])
				.range([COLOR_SETTINGS.cases.scaleColor.colorMin, COLOR_SETTINGS.cases.scaleColor.colorMax]);

			cases.forEach(function (casesItem, casesItemIdx) {
				var casesItemCount = casesItem[1];
				var divStatItem = document.createElement("div");
				divStatItem.classList.add("c-covid-stat-table__chart-item");
				divStatItem.style.backgroundColor = casesItemCount > 0 ? scaleColor(casesItemCount) : COLOR_SETTINGS.cases.zeroColor;
				cellDiv.appendChild(divStatItem);
			});
		} else {
			for (var i = 0; i < dates.length; i++) {
				var divStatItem = document.createElement("div");
				divStatItem.classList.add("c-covid-stat-table__chart-item");
				divStatItem.style.backgroundColor = COLOR_SETTINGS.cases.zeroColor;
				divStatItem.dataset.date = dates[i];
				divStatItem.dataset.cases = "0";
				cellDiv.appendChild(divStatItem);
			}
		}
	};

	var initViewStatRegionsMap = function (callbackRendered) {
		//Отображение статистики по заражениям на карте
		var dataDeepStat = COVID_DATA.deep.russia_stat_struct;
		//Выводим дату, на которую представлены данные "По данным на XX xxxx"
		var dataDate = dataDeepStat.data[COVID_DATA.deep_keys.russia_stat_struct[0]].info.date;
		document.getElementById("regionsStatMapDate").innerText = COVID_UTILS.date.format_ddMMMM(dataDate);

		var map = L.map("regionsStatMap").setView([63.28514, 92.059212], 3);
		L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
		}).addTo(map);

		var dateLength = dataDeepStat.dates.length;
		var dateLengthLastIdx = dateLength - 1;

		var keysSorted = COVID_DATA.deep_keys.russia_stat_struct
			.filter(function (key) {
				return key !== KEY_RUSSIA_STRING;
			})
			.sort(function (keyA, keyB) {
				var casesA = dataDeepStat.data[keyA].info.cases;
				var casesB = dataDeepStat.data[keyB].info.cases;

				return casesB - casesA;
			});

		var keyMin = keysSorted[keysSorted.length - 1];
		var keyMax = keysSorted[0];
		var casesRadiusMin = dataDeepStat.data[keyMin].info.cases / dataDeepStat.data[keyMin].info.population / 100000.0;
		var casesRadiusMax = dataDeepStat.data[keyMax].info.cases / dataDeepStat.data[keyMax].info.population / 100000.0;

		var casesColorMin = dataDeepStat.data[keyMin].info.cases_delta / dataDeepStat.data[keyMin].info.population / 1000.0;
		var casesColorMax = dataDeepStat.data[keyMax].info.cases_delta / dataDeepStat.data[keyMax].info.population / 1000.0;
		var scaleColor = d3
			.scaleLinear()
			.domain([casesColorMin, casesColorMax])
			.range([COLOR_SETTINGS.cases.scaleColor.colorMin, COLOR_SETTINGS.cases.scaleColor.colorMax]);
		var scaleRadius = d3.scaleLinear().domain([casesRadiusMin, casesRadiusMax]).range([20000, 200000]);

		window.circles = [];
		keysSorted.forEach(function (key) {
			var regionInfo = COVID_DATA.regions_coordinates[key];
			var regionData = COVID_DATA.deep.russia_stat_struct.data[key];

			var tooltipHtml = [
				`<div class="regions-stat-map-tooltip-row"><div class="regions-stat-map-tooltip-row-col-name">${regionInfo.name}</div></div>`,
				`<div class="regions-stat-map-tooltip-row"><div class="regions-stat-map-tooltip-row-col-ind-name">Заражений:</div><div class="regions-stat-map-tooltip-row-col-ind-value">${COVID_UTILS.number.format(
					regionData.info.cases
				)}</div></div>`,
				`<div class="regions-stat-map-tooltip-row"><div class="regions-stat-map-tooltip-row-col-ind-name">Смертей:</div><div class="regions-stat-map-tooltip-row-col-ind-value">${COVID_UTILS.number.format(
					regionData.info.deaths
				)}</div></div>`,
			];

			window.circles.push(
				L.circle(regionInfo.coordinates, {
					color: scaleColor(regionData.info.cases_delta / regionData.info.population / 1000.0),
					fillColor: scaleColor(regionData.info.cases_delta / regionData.info.population / 1000.0),
					fillOpacity: 0.8,
					radius: scaleRadius(regionData.info.cases / regionData.info.population / 100000.0),
				})
					.bindTooltip(`<div class="regions-stat-map-tooltip">${tooltipHtml.join("")}</div>`)
					.addTo(map)
			);
		});

		callbackRendered();
	};

	var resizeStatRegionsMap = function () {};

	L.TimeDimension.Layer.CDrift = L.TimeDimension.Layer.GeoJson.extend({
		// CDrift data has property time in seconds, not in millis.
		_getFeatureTimes: function (feature) {
			if (!feature.properties) {
				return [];
			}
			if (feature.properties.hasOwnProperty("coordTimes")) {
				return feature.properties.coordTimes;
			}
			if (feature.properties.hasOwnProperty("times")) {
				return feature.properties.times;
			}
			if (feature.properties.hasOwnProperty("linestringTimestamps")) {
				return feature.properties.linestringTimestamps;
			}
			if (feature.properties.hasOwnProperty("time")) {
				return [feature.properties.time];
			}
			return [];
		},

		// Do not modify features. Just return the feature if it intersects
		// the time interval
		_getFeatureBetweenDates: function (feature, minTime, maxTime) {
			var featureStringTimes = this._getFeatureTimes(feature);
			if (featureStringTimes.length == 0) {
				return feature;
			}
			var featureTimes = [];
			for (var i = 0, l = featureStringTimes.length; i < l; i++) {
				var time = featureStringTimes[i];
				if (typeof time == "string" || time instanceof String) {
					time = Date.parse(time.trim());
				}
				featureTimes.push(time);
			}

			if (featureTimes[0] > maxTime || featureTimes[l - 1] < minTime) {
				return null;
			}
			return feature;
		},
	});

	L.timeDimension.layer.cDrift = function (layer, options) {
		return new L.TimeDimension.Layer.CDrift(layer, options);
	};

	var initViewStatRegionsDynamicMap = function (callbackRendered) {
		//Отображение статистики по заражениям на карте в динамике
		var dataDeepStat = COVID_DATA.deep.russia_stat_struct;
		//Выводим дату, на которую представлены данные "По данным на XX xxxx"
		var dataDate = dataDeepStat.data[COVID_DATA.deep_keys.russia_stat_struct[0]].info.date;
		document.getElementById("regionsStatMapDate").innerText = COVID_UTILS.date.format_ddMMMM(dataDate);

		var map = L.map("regionsStatDynamicMap", {
			center: [63.28514, 92.059212],
			zoom: 3,
			timeDimension: true,
			// timeDimensionOptions: {
			// 	// timeInterval: '2014-09-30/2014-10-30',
			// 	// period: 'PT24H',
			// 	loopButton: true,
			// },
			timeDimensionControl: true,
			timeDimensionControlOptions: {
				position: "bottomleft",
				autoPlay: false,
				timeSlider: false,
				loopButton: true,
				playerOptions: {
					// transitionTime: 125,
					transitionTime: 250,
					loop: false,
				},
			},
		});
		L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
		}).addTo(map);

		var keys = COVID_DATA.deep_keys.russia_stat_struct.filter(function (key) {
			return key !== KEY_RUSSIA_STRING;
		});

		var keysSorted = keys.sort(function (keyA, keyB) {
			var casesA = dataDeepStat.data[keyA].info.cases;
			var casesB = dataDeepStat.data[keyB].info.cases;

			return casesB - casesA;
		});
		var keyMin = keysSorted[keysSorted.length - 1];
		var keyMax = keysSorted[0];

		var casesRadiusMin = 0;
		var casesRadiusMax = dataDeepStat.data[keyMax].info.cases / dataDeepStat.data[keyMax].info.population / 100000.0;
		var scaleRadius = d3.scaleLinear().domain([casesRadiusMin, casesRadiusMax]).range([2, 500]);

		var features = [];
		var timeInstants = [];
		COVID_DATA.deep.russia_stat_struct.dates
			.slice()
			.reverse()
			.filter(function (date, dateIdx) {
				return dateIdx % 5 === 0;
			})
			.reverse()
			.forEach(function (date, dateIdx) {
				var dateEpoch = COVID_UTILS.date.formatEpoch(date);
				timeInstants.push(dateEpoch);

				keys.forEach(function (key) {
					var regionInfo = COVID_DATA.regions_coordinates[key];
					var regionData = COVID_DATA.deep.russia_stat_struct.data[key];

					features.push({
						type: "Feature",
						geometry: {
							coordinates: [regionInfo.coordinates[1], regionInfo.coordinates[0]],
							type: "Point",
						},
						properties: {
							time: dateEpoch,
							radius: scaleRadius(regionData.cases[dateIdx][0] / regionData.info.population / 100000.0),
						},
					});
				});
			});

		var geoJsonData = {
			type: "FeatureCollection",
			features: features,
			properties: {
				time_instants: timeInstants,
				num_time_instants: timeInstants.length,
			},
		};
		var cdriftLayer = L.geoJson(geoJsonData, {
			pointToLayer: function (feature, latlng) {
				var color = "#FF0000";
				return L.circleMarker(latlng, {
					color: color,
					weight: 1,
					fill: true,
					fillColor: color,
					fillOpacity: 0.5,
					opacity: 0.5,
					radius: feature.properties.radius,
				});
			},
		});
		var cdriftTimeLayer = L.timeDimension.layer.cDrift(cdriftLayer, {
			updateTimeDimension: true,
			updateTimeDimensionMode: "replace",
			addlastPoint: false,
			// duration: 'PT20M',
		});
		cdriftTimeLayer.addTo(map);
		map.fitBounds(cdriftLayer.getBounds());

		callbackRendered();
	};

	var resizeStatRegionsDynamicMap = function () {};

	var initViewStatRegionsTable = function (callbackRendered) {
		//Статистика по регионам
		var dataDeepStat = COVID_DATA.deep.russia_stat_struct;
		var datesFormatted = dataDeepStat.dates.map(function (date) {
			return COVID_UTILS.date.format_ddMMMM(date);
		});

		//Выводим дату, на которую представлены данные "По данным на XX xxxx"
		var dataDate = dataDeepStat.data[COVID_DATA.deep_keys.russia_stat_struct[0]].info.date;
		document.getElementById("regionsStatDate").innerText = COVID_UTILS.date.format_ddMMMM(dataDate);

		//Сортируем ключи данных статистики по общему числу заражений от большего к меньшему (casesB-casesA)
		var keysSorted = COVID_DATA.deep_keys.russia_stat_struct
			.filter(function (key) {
				return key !== KEY_RUSSIA_STRING;
			})
			.sort(function (keyA, keyB) {
				var casesA = dataDeepStat.data[keyA].info.cases;
				var casesB = dataDeepStat.data[keyB].info.cases;

				return casesB - casesA;
			});

		//Выводим список строк таблицы
		var table = document.getElementById("regionsStatTable");
		var tableBody = document.getElementById("regionsStatTableBody");
		var rowsInfo = [];
		keysSorted.forEach(function (key) {
			let itemData = dataDeepStat.data[key];

			var divRow = document.createElement("div");
			divRow.classList.add("c-covid-stat-table__row");
			divRow.classList.add("c-covid-stat-table__row--hidden");

			var cellDiv2 = COVID_UTILS.table.initCellDiv(
				"c-covid-stat-table__cell c-covid-stat-table__chart c-covid-stat-table__cell--hidden@down-lg"
			);
			initViewStatTableCellStat(cellDiv2, itemData.cases, datesFormatted);

			divRow.appendChild(COVID_UTILS.table.initCellDiv("c-covid-stat-table__cell", itemData.info.short_name));
			divRow.appendChild(cellDiv2);
			divRow.appendChild(
				COVID_UTILS.table.initCellDiv(
					"c-covid-stat-table__cell c-covid-stat-table__cell--align-right",
					COVID_UTILS.number.format(itemData.info.cases)
				)
			);
			divRow.appendChild(
				COVID_UTILS.table.initCellDiv(
					"c-covid-stat-table__cell c-covid-stat-table__cell--align-right c-covid-stat-table__cell--hidden@down-lg",
					COVID_UTILS.number.format(COVID_UTILS.number.formatPrecision(itemData.info.cases / (itemData.info.population / 100000.0), 1))
				)
			);
			divRow.appendChild(
				COVID_UTILS.table.initCellDiv(
					"c-covid-stat-table__cell c-covid-stat-table__cell--align-right",
					COVID_UTILS.number.format(itemData.info.deaths)
				)
			);
			divRow.appendChild(
				COVID_UTILS.table.initCellDiv(
					"c-covid-stat-table__cell c-covid-stat-table__cell--align-right c-covid-stat-table__cell--hidden@down-lg",
					COVID_UTILS.number.format(COVID_UTILS.number.formatPrecision(itemData.info.deaths / (itemData.info.population / 100000.0), 1))
				)
			);

			rowsInfo.push({
				key: key,
				name: itemData.info.short_name.toLowerCase(),
				div: divRow,
			});

			tableBody.appendChild(divRow);
		});

		var showMore = true;
		var initTableRows = function () {
			let rowsToShowCount = showMore ? 10 : rowsInfo.length;

			for (var i = 0; i < rowsToShowCount; i++) {
				rowsInfo[i].div.classList.remove("c-covid-stat-table__row--hidden");
			}
			for (var i = rowsToShowCount; i < rowsInfo.length; i++) {
				rowsInfo[i].div.classList.add("c-covid-stat-table__row--hidden");
			}
		};
		initTableRows();

		var buttonShowMore = document.getElementById("regionsStatButtonShowMore");
		buttonShowMore.addEventListener("click", function () {
			showMore = !showMore;
			initTableRows();

			this.innerText = showMore ? "Показать еще" : "Свернуть";

			if (showMore) {
				table.scrollIntoView();
			}
		});

		//Инициализируем фильтр
		var inputFilter = document.getElementById("regionsStatFilterInput");
		var debouncedFilter = _.debounce(function (value) {
			if (value !== "") {
				buttonShowMore.classList.add("is-hidden");
				value = value.toLowerCase();
				rowsInfo.forEach(function (rowInfo) {
					if (rowInfo.name.indexOf(value) > -1) {
						rowInfo.div.classList.remove("c-covid-stat-table__row--hidden");
					} else {
						rowInfo.div.classList.add("c-covid-stat-table__row--hidden");
					}
				});
			} else {
				initTableRows();
				buttonShowMore.classList.remove("is-hidden");
			}
		}, 300);
		inputFilter.oninput = function () {
			debouncedFilter(this.value);
		};

		callbackRendered();
	};

	var resizeStatRegionsTable = function () {};

	var initViewStatCountries = function (callbackRendered) {
		//Статистика по странам - таблица с градиентом
		var dataDeepStat = COVID_DATA.deep.world_stat_struct;
		var datesFormatted = dataDeepStat.dates.map(function (date) {
			return COVID_UTILS.date.format_ddMMMM(date);
		});

		//Выводим дату, на которую представлены данные "По данным на XX xxxx"
		var dataDate = dataDeepStat.data[COVID_DATA.deep_keys.world_stat_struct[0]].info.date;
		document.getElementById("countriesStatDate").innerText = COVID_UTILS.date.format_ddMMMM(dataDate);

		//Сортируем ключи данных статистики по общему числу заражений от большего к меньшему (casesB-casesA)
		var keysSorted = COVID_DATA.deep_keys.world_stat_struct
			.filter(function (key) {
				return key !== "10000";
			})
			.sort(function (keyA, keyB) {
				var casesA = dataDeepStat.data[keyA].info.cases;
				var casesB = dataDeepStat.data[keyB].info.cases;

				return casesB - casesA;
			});

		//Выводим список строк таблицы
		var table = document.getElementById("countriesStatTable");
		var tableBody = document.getElementById("countriesStatTableBody");
		var rowsInfo = [];
		keysSorted.forEach(function (key) {
			let itemData = dataDeepStat.data[key];

			var divRow = document.createElement("div");
			divRow.classList.add("c-covid-stat-table__row");
			divRow.classList.add("c-covid-stat-table__row--hidden");

			var cellDiv2 = COVID_UTILS.table.initCellDiv(
				"c-covid-stat-table__cell c-covid-stat-table__chart c-covid-stat-table__cell--hidden@down-lg"
			);
			initViewStatTableCellStat(cellDiv2, itemData.cases, datesFormatted);

			divRow.appendChild(COVID_UTILS.table.initCellDiv("c-covid-stat-table__cell", itemData.info.short_name));
			divRow.appendChild(cellDiv2);
			divRow.appendChild(
				COVID_UTILS.table.initCellDiv(
					"c-covid-stat-table__cell c-covid-stat-table__cell--align-right",
					COVID_UTILS.number.format(itemData.info.cases)
				)
			);
			divRow.appendChild(
				COVID_UTILS.table.initCellDiv(
					"c-covid-stat-table__cell c-covid-stat-table__cell--align-right c-covid-stat-table__cell--hidden@down-lg",
					COVID_UTILS.number.format(COVID_UTILS.number.formatPrecision(itemData.info.cases / (itemData.info.population / 100000.0), 1))
				)
			);
			divRow.appendChild(
				COVID_UTILS.table.initCellDiv(
					"c-covid-stat-table__cell c-covid-stat-table__cell--align-right",
					COVID_UTILS.number.format(itemData.info.deaths)
				)
			);
			divRow.appendChild(
				COVID_UTILS.table.initCellDiv(
					"c-covid-stat-table__cell c-covid-stat-table__cell--align-right c-covid-stat-table__cell--hidden@down-lg",
					COVID_UTILS.number.format(COVID_UTILS.number.formatPrecision(itemData.info.deaths / (itemData.info.population / 100000.0), 1))
				)
			);

			rowsInfo.push({
				key: key,
				name: itemData.info.short_name.toLowerCase(),
				div: divRow,
			});
			tableBody.appendChild(divRow);
		});

		var showMore = true;
		var initTableRows = function () {
			let rowsToShowCount = showMore ? 10 : rowsInfo.length;

			for (var i = 0; i < rowsToShowCount; i++) {
				rowsInfo[i].div.classList.remove("c-covid-stat-table__row--hidden");
			}
			for (var i = rowsToShowCount; i < rowsInfo.length; i++) {
				rowsInfo[i].div.classList.add("c-covid-stat-table__row--hidden");
			}
		};
		initTableRows();

		var buttonShowMore = document.getElementById("countriesStatButtonShowMore");
		buttonShowMore.addEventListener("click", function () {
			showMore = !showMore;
			initTableRows();

			this.innerText = showMore ? "Показать еще" : "Свернуть";

			if (showMore) {
				table.scrollIntoView();
			}
		});

		//Инициализируем фильтр
		var inputFilter = document.getElementById("countriesStatFilterInput");
		var debouncedFilter = _.debounce(function (value) {
			if (value !== "") {
				buttonShowMore.classList.add("is-hidden");
				value = value.toLowerCase();
				rowsInfo.forEach(function (rowInfo) {
					if (rowInfo.name.indexOf(value) > -1) {
						rowInfo.div.classList.remove("c-covid-stat-table__row--hidden");
					} else {
						rowInfo.div.classList.add("c-covid-stat-table__row--hidden");
					}
				});
			} else {
				initTableRows();
				buttonShowMore.classList.remove("is-hidden");
			}
		}, 300);
		inputFilter.oninput = function () {
			debouncedFilter(this.value);
		};

		callbackRendered();
	};

	var resizeStatCountries = function () {};
	//КОНЕЦ: Отрисовка статистики по регионам РФ и странам

	//НАЧАЛО: Отрисовка статистики "Опыт разных стран"
	var EXPERIENCE_TOP_COUNT = 5;
	var EXPERIENCE_COLORS = [
		"rgb(81,87,74)",
		"rgb(68,124,105)",
		"rgb(116,196,147)",
		"rgb(142,140,109)",
		"rgb(228,191,128)",
		"rgb(233,215,142)",
		"rgb(154,191,136)",
		"rgb(191,135,165)",
		"rgb(153,170,204)",
		"rgb(153,119,85)",
		"rgb(153,119,153)",
		"rgb(176,135,191)",
		"rgb(135,148,191)",
		"rgb(226,151,93)",
		"rgb(241,150,112)",
		"rgb(225,101,82)",
		"rgb(201,74,83)",
		"rgb(190,81,104)",
		"rgb(163,73,116)",
		"rgb(153,55,103)",
		"rgb(101,56,125)",
		"rgb(78,36,114)",
		"rgb(145,99,182)",
		"rgb(226,121,163)",
		"rgb(224,89,139)",
		"rgb(124,159,176)",
		"rgb(86,152,196)",
	];
	var initViewExperienceCases = function (xAxisData, keysColors, rendered) {
		//Отрисовка статистики "Опыт разных стран - заражения"
		var data = COVID_DATA.deep.world_stat_struct.data;
		var keysSorted = COVID_DATA.deep_keys.world_stat_struct.sort(function (keyA, keyB) {
			return data[keyB].info.deaths - data[keyA].info.deaths;
		});

		var keysTop = keysSorted.slice(1, 1 + EXPERIENCE_TOP_COUNT); //на первом месте всегда будет ключ 10000 - МИР
		if (keysTop.indexOf(KEY_RUSSIA_STRING) < 0) {
			//Если в списке ключей нет ключа России, то добавляем его в конец, чтобы Россия всегда была на графике
			keysTop.splice(EXPERIENCE_TOP_COUNT - 1, 1, KEY_RUSSIA_STRING);
		}

		var keysToShow = keysTop.slice();
		var keysToShowMapIdx = {};
		keysToShow.forEach(function (key, idx) {
			keysToShowMapIdx[key] = idx + 1;
		});

		var initSeriesItem = function (key) {
			var dataItem = data[key];
			return {
				name: dataItem.info.short_name,
				type: "line",
				symbol: "none",
				color: keysColors[key],
				sampling: "lttb",
				data: dataItem.cases.map(function (casesItem) {
					return parseFloat(COVID_UTILS.number.formatPrecision(casesItem[1] / 1000.0, 1));
				}),
				emphasis: { focus: "series" },
			};
		};
		//Формируем массив серий данных
		var series = keysToShow.map(initSeriesItem);
		var option = {
			legend: {
				show: true,
				type: "scroll",
				orient: "horizontal",
				top: "top",
			},
			xAxis: {
				data: xAxisData,
				boundaryGap: false,
			},
			dataZoom: [
				{
					startValue: xAxisData[xAxisData.length - 100].value,
				},
				{
					type: "inside",
				},
			],
			yAxis: {
				show: true,
			},
			series: series,
			grid: {
				left: 40,
				top: 35,
				bottom: 70,
				right: 0,
			},
			tooltip: {
				show: true,
				trigger: "axis",
			},
		};
		panes.experienceTabPane.charts.cases = echarts.init(document.getElementById("experienceChartCases"));
		panes.experienceTabPane.charts.cases.on("rendered", rendered.initSetRendered("cases"));
		panes.experienceTabPane.charts.cases.setOption(option);

		var onCheckboxChange = function () {
			if (this.checked === true) {
				var keyIdx = parseInt(this.dataset.keyIdx);
				var seriesItem = initSeriesItem(this.dataset.key);

				var idxToInsert = false;
				for (var i = 0; i < keysToShow.length; i++) {
					if (keyIdx < keysToShowMapIdx[keysToShow[i]]) {
						idxToInsert = i;
						break;
					}
				}

				if (idxToInsert !== false) {
					keysToShow.splice(idxToInsert, 0, this.dataset.key);
					keysToShowMapIdx[this.dataset.key] = keyIdx;
					series.splice(idxToInsert, 0, seriesItem);
				} else {
					keysToShow.push(this.dataset.key);
					keysToShowMapIdx[this.dataset.key] = keyIdx;
					series.push(seriesItem);
				}
			} else {
				var idx = keysToShow.indexOf(this.dataset.key);
				if (idx > -1) {
					series.splice(idx, 1);
					keysToShow.splice(idx, 1);
					delete keysToShowMapIdx[this.dataset.key];
				}
			}
			panes.experienceTabPane.charts.cases.setOption(
				{
					series: series,
				},
				{
					replaceMerge: "series",
				}
			);
		};

		var divCountriesList = document.getElementById("experienceChartCasesCountriesList");
		keysSorted.forEach(function (key, keyIdx) {
			var checkboxId = `experienceCasesCountry${key}`;
			var dataItem = data[key];
			var divCountry = document.createElement("div");
			divCountry.className = "c-form-check c-form-check--kind-checkbox c-covid-stat-experience-filter__check";

			var checkboxCountry = document.createElement("input");
			checkboxCountry.className = "c-form-check__input";
			checkboxCountry.type = "checkbox";
			checkboxCountry.setAttribute("id", checkboxId);
			if (keysToShow.indexOf(key) > -1) {
				checkboxCountry.setAttribute("checked", true);
			}
			checkboxCountry.dataset.key = key;
			checkboxCountry.dataset.keyIdx = keyIdx;
			checkboxCountry.onchange = onCheckboxChange;
			divCountry.appendChild(checkboxCountry);

			var labelCountry = document.createElement("label");
			labelCountry.className = "c-form-check__label";
			labelCountry.setAttribute("for", checkboxId);
			labelCountry.innerText = dataItem.info.short_name;
			divCountry.appendChild(labelCountry);

			divCountriesList.appendChild(divCountry);
		});
	};
	var initViewExperienceDeaths = function (xAxisData, keysColors, rendered) {
		//Отрисовка статистики "Опыт разных стран - смерти"
		var data = COVID_DATA.deep.world_stat_struct.data;
		var keysSorted = COVID_DATA.deep_keys.world_stat_struct.sort(function (keyA, keyB) {
			return data[keyB].info.cases - data[keyA].info.cases;
		});
		var keysTop = keysSorted.slice(1, 1 + EXPERIENCE_TOP_COUNT); //на первом месте всегда будет ключ 10000 - МИР
		if (keysTop.indexOf(KEY_RUSSIA_STRING) < 0) {
			//Если в списке ключей нет ключа России, то добавляем его в конец, чтобы Россия всегда была на графике
			keysTop.splice(EXPERIENCE_TOP_COUNT - 1, 1, KEY_RUSSIA_STRING);
		}

		var keysToShow = keysTop.slice();
		var keysToShowMapIdx = {};
		keysToShow.forEach(function (key, idx) {
			keysToShowMapIdx[key] = idx + 1;
		});

		var initSeriesItem = function (key) {
			var dataItem = data[key];
			return {
				name: dataItem.info.short_name,
				type: "line",
				symbol: "none",
				color: keysColors[key],
				sampling: "lttb",
				data: dataItem.deaths.map(function (deathsItem) {
					//return parseFloat(COVID_UTILS.number.formatPrecision(deathsItem[1] / 1000.0, 1))
					return deathsItem[1];
				}),
				emphasis: { focus: "series" },
			};
		};
		//Формируем массив серий данных
		var series = keysToShow.map(initSeriesItem);
		var option = {
			legend: {
				show: true,
				type: "scroll",
				orient: "horizontal",
				top: "top",
			},
			xAxis: {
				data: xAxisData,
				boundaryGap: false,
			},
			dataZoom: [
				{
					startValue: xAxisData[xAxisData.length - 100].value,
				},
				{
					type: "inside",
				},
			],
			yAxis: {
				show: true,
			},
			series: series,
			grid: {
				left: 40,
				top: 35,
				bottom: 70,
				right: 0,
			},
			tooltip: {
				show: true,
				trigger: "axis",
			},
		};
		panes.experienceTabPane.charts.deaths = echarts.init(document.getElementById("experienceChartDeaths"));
		panes.experienceTabPane.charts.deaths.on("rendered", rendered.initSetRendered("deaths"));
		panes.experienceTabPane.charts.deaths.setOption(option);

		var onCheckboxChange = function () {
			if (this.checked === true) {
				var keyIdx = parseInt(this.dataset.keyIdx);
				var seriesItem = initSeriesItem(this.dataset.key);

				var idxToInsert = false;
				for (var i = 0; i < keysToShow.length; i++) {
					if (keyIdx < keysToShowMapIdx[keysToShow[i]]) {
						idxToInsert = i;
						break;
					}
				}

				if (idxToInsert !== false) {
					keysToShow.splice(idxToInsert, 0, this.dataset.key);
					keysToShowMapIdx[this.dataset.key] = keyIdx;
					series.splice(idxToInsert, 0, seriesItem);
				} else {
					keysToShow.push(this.dataset.key);
					keysToShowMapIdx[this.dataset.key] = keyIdx;
					series.push(seriesItem);
				}
			} else {
				var idx = keysToShow.indexOf(this.dataset.key);
				if (idx > -1) {
					series.splice(idx, 1);
					keysToShow.splice(idx, 1);
					delete keysToShowMapIdx[this.dataset.key];
				}
			}
			panes.experienceTabPane.charts.deaths.setOption(
				{
					series: series,
				},
				{
					replaceMerge: "series",
				}
			);
		};

		var divCountriesList = document.getElementById("experienceChartDeathsCountriesList");
		keysSorted.forEach(function (key, keyIdx) {
			var checkboxId = `experienceDeathsCountry${key}`;
			var dataItem = data[key];
			var divCountry = document.createElement("div");
			divCountry.className = "c-form-check c-form-check--kind-checkbox c-covid-stat-experience-filter__check";

			var checkboxCountry = document.createElement("input");
			checkboxCountry.className = "c-form-check__input";
			checkboxCountry.type = "checkbox";
			checkboxCountry.setAttribute("id", checkboxId);
			if (keysToShow.indexOf(key) > -1) {
				checkboxCountry.setAttribute("checked", true);
			}
			checkboxCountry.dataset.key = key;
			checkboxCountry.dataset.keyIdx = keyIdx;
			checkboxCountry.onchange = onCheckboxChange;
			divCountry.appendChild(checkboxCountry);

			var labelCountry = document.createElement("label");
			labelCountry.className = "c-form-check__label";
			labelCountry.setAttribute("for", checkboxId);
			labelCountry.innerText = dataItem.info.short_name;
			divCountry.appendChild(labelCountry);

			divCountriesList.appendChild(divCountry);
		});
	};

	var initViewExperience = function (callbackRendered) {
		var xAxisData = COVID_DATA.deep.world_stat_struct.dates.map(function (date) {
			return {
				value: COVID_UTILS.date.format_dd_dot_MM_dot_yy(date),
				label: COVID_UTILS.date.format_ddMMMMyyyy(date),
				interval: COVID_UTILS.date.format_dd(date) === "01",
				intervalSmall: ["0101", "0401", "0701", "1001"].indexOf(COVID_UTILS.date.format_MMdd(date)) > -1,
			};
		});
		panes.experienceTabPane.xAxisData = xAxisData;
		//Формируем цвета для каждой серии данных - чтобы они не прыгали при отключении/включении
		var keysColors = {};
		COVID_DATA.deep_keys.world_stat_struct.forEach(function (key, idx) {
			keysColors[key] = EXPERIENCE_COLORS[idx % EXPERIENCE_COLORS.length];
		});

		var rendered = {
			cases: false,
			deaths: false,
			initSetRendered(key) {
				let that = this;
				return function () {
					that[key] = true;
					that.check();
				};
			},
			check() {
				if (this.cases && this.deaths) {
					if (typeof callbackRendered === "function") {
						callbackRendered();
					}
				}
			},
		};

		initViewExperienceCases(xAxisData, keysColors, rendered);
		initViewExperienceDeaths(xAxisData, keysColors, rendered);
	};
	var resizeExperience = function () {
		COVID_UTILS.charts.resize(panes.experienceTabPane.charts);
	};
	//КОНЕЦ: Отрисовка статистики "Опыт разных стран"

	var panes = {
		eventsTabPane: {
			inited: false,
			init: initViewEvents,
			resize: resizeEvents,
			charts: {},
			chartsData: {},
		},
		regionsStatTabPane: {
			inited: false,
			init: initViewStatRegionsTable,
			resize: resizeStatRegionsTable,
			charts: {},
		},
		countriesStatTabPane: {
			inited: false,
			init: initViewStatCountries,
			resize: resizeStatCountries,
			charts: {},
		},
		experienceTabPane: {
			inited: false,
			init: initViewExperience,
			resize: resizeExperience,
			charts: {},
		},
		regionsStatMapTabPane: {
			inited: false,
			init: initViewStatRegionsMap,
			resize: resizeStatRegionsMap,
			charts: {},
		},
		regionsStatDynamicMapTabPane: {
			inited: false,
			init: initViewStatRegionsDynamicMap,
			resize: resizeStatRegionsDynamicMap,
			charts: {},
		},
	};
	var currentTabPane = "eventsTabPane";

	var setData = function (key, keyedData) {
		COVID_DATA[key] = keyedData;

		if (COVID_DATA.default !== false && COVID_DATA.deep !== false && COVID_DATA.regions_coordinates !== false) {
			COVID_DATA.deep_keys = {
				russia_stat_struct: Object.keys(COVID_DATA.deep.russia_stat_struct.data),
				world_stat_struct: Object.keys(COVID_DATA.deep.world_stat_struct.data),
			};

			// Получим все табы
			var tabElList = document.querySelectorAll('[data-exo-toggle="tab"]');

			// Инициализация вкладки при переключении
			var tabPaneInit = function (key) {
				if (panes.hasOwnProperty(key)) {
					let pane = panes[key];
					if (pane.inited === true) {
						pane.resize();
					} else {
						var targetEl = document.getElementById(key);
						targetEl.classList.add("is-loading");
						setTimeout(function () {
							pane.init(function () {
								targetEl.classList.remove("is-loading");
								pane.inited = true;
							});
						}, 100);
					}
				} else {
					console.error('tabPaneInit called with non-existing key "' + key + '"');
				}
			};

			tabPaneInit(currentTabPane);

			// Повесим на каждый элемент слушатель события, вызываемого при переключении вкладок
			tabElList.forEach((element) => {
				element.addEventListener("shown.exo.tab", function (event) {
					var tabEl = event.target;

					var tabPaneEl = document.querySelector(tabEl.dataset.exoTarget);

					if (element.parentElement.id === "regionsTabList") {
						getSiblings(element).forEach((item) => {
							item.classList.remove("c-btn--kind-primary");
							item.classList.add("c-btn--kind-outline-primary");
						});

						if (element.classList.contains("is-active")) {
							element.classList.remove("c-btn--kind-outline-primary");
							element.classList.add("c-btn--kind-primary");
						}
					}

					//Вызываем метод инициалиазации вкладки
					switch (tabPaneEl.id) {
						case "regionsStatPivotTableTabPane":
							tabPaneInit("regionsStatTabPane");
							break;
						default:
							tabPaneInit(tabPaneEl.id);
							break;
					}

					currentTabPane = tabPaneEl.id;
				});
			});
		}
	};

	var BASE_URL = "/upload/covid-stat";
	//После формирования всех фукнций для отрисовки, запускаем запрос данных
	fetch(`${BASE_URL}/regions_coordinates.json`)
		.then((response) => response.json())
		.then(function (data) {
			setData("regions_coordinates", data);
		});

	fetch(`${BASE_URL}/default_data.json`)
		.then((response) => response.json())
		.then(function (data) {
			setData("default", data);
		});

	fetch(`${BASE_URL}/deep_data.json`)
		.then((response) => response.json())
		.then(function (data) {
			setData("deep", data);
		});

	var debouncedResize = _.debounce(function () {
		checkWindowSize();
		panes[currentTabPane].resize();
	}, 200);

	window.addEventListener("resize", function () {
		debouncedResize();
	});
})();
