$(function () {
	"use strict";
	// chart 1
	Highcharts.chart('chart1', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
			styledMode: true
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'Browser market shares in January, 2018'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %'
				}
			}
		},
		series: [{
			name: 'Brands',
			colorByPoint: true,
			data: [{
				name: 'Chrome',
				y: 61.41,
				sliced: true,
				selected: true
			}, {
				name: 'Internet Explorer',
				y: 11.84
			}, {
				name: 'Firefox',
				y: 10.85
			}, {
				name: 'Edge',
				y: 4.67
			}, {
				name: 'Safari',
				y: 4.18
			}, {
				name: 'Sogou Explorer',
				y: 1.64
			}, {
				name: 'Opera',
				y: 1.6
			}, {
				name: 'QQ',
				y: 1.2
			}, {
				name: 'Other',
				y: 2.61
			}]
		}]
	});
	// chart 2
	// Build the chart
	Highcharts.chart('chart2', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
			styledMode: true
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'Browser market shares in January, 2018'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: false
				},
				showInLegend: true
			}
		},
		series: [{
			name: 'Brands',
			colorByPoint: true,
			data: [{
				name: 'Chrome',
				y: 61.41,
				sliced: true,
				selected: true
			}, {
				name: 'Internet Explorer',
				y: 11.84
			}, {
				name: 'Firefox',
				y: 10.85
			}, {
				name: 'Edge',
				y: 4.67
			}, {
				name: 'Safari',
				y: 4.18
			}, {
				name: 'Other',
				y: 7.05
			}]
		}]
	});
	// chart 3
	Highcharts.chart('chart3', {
		chart: {
			type: 'variablepie',
			styledMode: true
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'Countries compared by population density and total area.'
		},
		tooltip: {
			headerFormat: '',
			pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' + 'Area (square km): <b>{point.y}</b><br/>' + 'Population density (people per square km): <b>{point.z}</b><br/>'
		},
		series: [{
			minPointSize: 10,
			innerSize: '20%',
			zMin: 0,
			name: 'countries',
			data: [{
				name: 'Spain',
				y: 505370,
				z: 92.9
			}, {
				name: 'France',
				y: 551500,
				z: 118.7
			}, {
				name: 'Poland',
				y: 312685,
				z: 124.6
			}, {
				name: 'Czech Republic',
				y: 78867,
				z: 137.5
			}, {
				name: 'Italy',
				y: 301340,
				z: 201.8
			}, {
				name: 'Switzerland',
				y: 41277,
				z: 214.5
			}, {
				name: 'Germany',
				y: 357022,
				z: 235.6
			}]
		}]
	});
	
});