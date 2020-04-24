<!-- Styles -->
<style>
    #chartdiv {
      width: 100%;
      height: 500px;
    }
    
    .amcharts-amexport-item {
    border: 2px solid #777;
    }

    .amcharts-amexport-top .amcharts-amexport-item > .amcharts-amexport-menu {
    top: -3px!important;
    left: 2px
    }
    </style>
    
    <!-- Resources -->
    <script src="<?php echo base_url('') ?>assets/js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url('') ?>assets/plugins/amcharts4/core.js"></script>
    <script src="<?php echo base_url('') ?>assets/plugins/amcharts4/charts.js"></script>
    <script src="<?php echo base_url('') ?>assets/plugins/amcharts4/themes/animated.js"></script>
 
    <script>
    am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    var chart = am4core.create("chartdiv", am4charts.XYChart);

    var data = [];
    var intface = 'indosat';
    var tgl,tx = [],rx = [];
    var dataJSON = $.ajax({
        url : '<?php echo site_url('bandwidth/linegraph')?>/'+intface,
        async : false,
        dataType : 'json'
    }).responseJSON;

    for(var i = 0; i < dataJSON.date.length; i++){
        time = dataJSON.date[i];
        date = new Date(time.replace(/-/g,"/"));
        // tx.push(dataJSON.tx[i]);
        // rx.push(dataJSON.tx);
        data.push({date : date, tx: parseInt(dataJSON.tx[i]), rx: parseInt(dataJSON.rx[i]),});
    }

    chart.data = data;
    // chart.dateFormatter.inputDateFormat = "yyyy";
    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.renderer.minGridDistance = 60;
    dateAxis.startLocation = 0.5;
    dateAxis.endLocation = 0.5;
    dateAxis.baseInterval = {
      timeUnit: "minute",
      count: 5
    }

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.tooltip.disabled = true;

    var series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.dateX = "date";
    series.name = "Tx";
    series.dataFields.valueY = "tx";
    series.tooltipHTML = "<img src='https://www.amcharts.com/lib/3/images/car.png' style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'><b>{valueY.value}</b></span>";
    series.tooltipText = "[#000]{valueY.value}[/]";
    series.tooltip.background.fill = am4core.color("#FFF");
    series.tooltip.getStrokeFromObject = true;
    series.tooltip.background.strokeWidth = 3;
    series.tooltip.getFillFromObject = false;
    series.fillOpacity = 0.6;
    series.strokeWidth = 2;
    series.connect = false;


    var series2 = chart.series.push(new am4charts.LineSeries());
    series2.name = "Rx";
    series2.dataFields.dateX = "date";
    series2.dataFields.valueY = "rx";
    series2.tooltipHTML = "<img src='https://www.amcharts.com/lib/3/images/motorcycle.png' style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'><b> Rx : {valueY.value}</b></span>";
    series2.tooltipText = "[#000]{valueY.value}[/]";
    series2.tooltip.background.fill = am4core.color("#FFF");
    series2.tooltip.getFillFromObject = false;
    series2.tooltip.getStrokeFromObject = true;
    series2.tooltip.background.strokeWidth = 3;
    series2.sequencedInterpolation = true;
    series2.fillOpacity = 0.6;
    series2.strokeWidth = 2;
    series2.connect = false;

    // chart.numberFormatter.numberFormat = "#.b";
    chart.numberFormatter.numberFormat = "#a";
    chart.numberFormatter.bigNumberPrefixes = [
        { "number": 1e+3, "suffix": " Kbps" },
        { "number": 1e+6, "suffix": " Mbps" },
        { "number": 1e+9, "suffix": " Gbps" }
        ];
    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "right";
    chart.exporting.menu.verticalAlign = "top";
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.xAxis = dateAxis;
    chart.scrollbarX = new am4core.Scrollbar();

    // Add a legend
    chart.legend = new am4charts.Legend();
    chart.legend.position = "bottom";

    // axis ranges
    // var range = dateAxis.axisRanges.create();
    // range.date = new Date(2020, 0, 1);
    // range.endDate = new Date(2021, 0, 1);
    // range.axisFill.fill = chart.colors.getIndex(7);
    // range.axisFill.fillOpacity = 0.2;

    // range.label.text = "Fines for speeding increased";
    // range.label.inside = true;
    // range.label.rotation = 90;
    // range.label.horizontalCenter = "right";
    // range.label.verticalCenter = "bottom";

    // var range2 = dateAxis.axisRanges.create();
    // range2.date = new Date(2020, 0, 1);
    // range2.endDate = new Date(2021, 0, 1);
    // range2.grid.stroke = chart.colors.getIndex(7);
    // range2.grid.strokeOpacity = 0.6;
    // range2.grid.strokeDasharray = "5,2";


    // range2.label.text = "Motorcycle fee introduced";
    // range2.label.inside = true;
    // range2.label.rotation = 90;
    // range2.label.horizontalCenter = "right";
    // range2.label.verticalCenter = "bottom";

    }); // end am4core.ready()
    </script>
    



    <!-- HTML -->
    <div id="chartdiv"></div>


    