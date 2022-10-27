am4core.useTheme(am4themes_animated);

var chart = am4core.create("chartdiv", am4charts.XYChart);

chart.data = [{
	"region": "Nairobi",
	"visits":  {{ nrNairobi }}
}, {
	"region": "Coast",
	"visits": {{ nrCoast }}
}, {
	"region": "Central",
	"visits": {{ nrCentral }}
}, {
	"region": "Rift Valley",
	"visits": {{ nrRift }}
}, {
	"region": "Nyanza",
	"visits": {{ nrNyanza }}
}, {
	"region": "Eastern",
	"visits": {{ nrEastern }}
}, {
	"region": "Western",
	"visits": {{ nrWestern }}
}];

chart.padding(40, 40, 40, 40);

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = "region";
categoryAxis.renderer.minGridDistance = 60;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.categoryX = "region";
series.dataFields.valueY = "visits";
series.tooltipText = "{valueY.value}"
series.columns.template.strokeOpacity = 0;

chart.cursor = new am4charts.XYCursor();

// as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
series.columns.template.adapter.add("fill", function (fill, target) {
	return chart.colors.getIndex(target.dataItem.index);
});
