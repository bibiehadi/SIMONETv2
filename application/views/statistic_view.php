<?php $this->load->view('Templates/headersidebar_view'); ?>
</div>
    </div>
    <div class="static-content-wrapper">
        <div class="static-content">
            <div class="page-content">
                <div class="container-fluid" style="margin-top: 10px">
                    <!-- <div data-widget-group="group1"> -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"> 
										<!-- <form action="" class="form-horizontal row-border">	 -->
											<!-- <div class="form-group"> -->
												<div class="col-md-3 pull-right">
													<button class="btn btn-default" id="daterangepicker2">
														<i class="ti ti-calendar"></i> 
														<span></span> <b class="caret"></b>
													</button>
												</div>
											<!-- </div> -->
										<!-- </form> -->
										<a class="btn btn-success pull-right" data-aksi="refresh" style="margin:10px 0 0 0px"><i class="fa fa-refresh"></i></a> 

                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div style="margin: 10px">
                                                <h5>CPU</h5>
                                                <div class="mychartResource" id="chartCPU" style="height: 300px;" class="mt-sm mb-sm" data-interface="Resource"></div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div style="margin: 10px">
                                                <h5>Memory</h5>
                                                <div class="mychartResource" id="chartMemory" style="height: 300px;" class="mt-sm mb-sm" data-interface="Resource"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div style="margin: 10px">
                                                <h5><i class="fa fa-circle" style="color: #5cb85c"></i> Indosat</h5>
                                                <div class="mychartInterface" id="chart1" style="height: 300px;" class="mt-sm mb-sm" data-interface="Indosat"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div style="margin: 10px">
                                                <h5><i class="fa fa-circle" style="color: #5cb85c"></i> MyRepublic Pro 100</h5>
                                                <div class="mychartInterface" id="chart2" style="height: 300px;" class="mt-sm mb-sm" data-interface="BPro100"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div style="margin: 10px">
                                                <h5><i class="fa fa-circle" style="color: #5cb85c"></i> MyRepublic 300</h5>
                                                <div class="mychartInterface" id="chart3" style="height: 300px;" class="mt-sm mb-sm" data-interface="B300"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div style="margin: 10px">
                                                <h5><i class="fa fa-circle" style="color: #5cb85c"></i> MyRepublic 100</h5>
                                                <div class="mychartInterface" id="chart4" style="height: 300px;" class="mt-sm mb-sm" data-interface="B100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div> 
                        <!-- </div>  -->
                    <!-- </div> -->
                <!-- <footer role="contentinfo">
                    <div class="clearfix">
                        <ul class="list-unstyled list-inline pull-left">
                            <li><h6 style="margin: 0;">&copy; 2015 Avenxo</h6></li>
                        </ul>
                        <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
                    </div>
                </footer> -->



<?php $this->load->view('Templates/footer_view'); ?>


<script type="text/javascript">
	var charts = {};
	var chart;
	var chartsResource = {};
	var chartResource;


	Highcharts.setOptions({
		global: {
			timezoneOffset: -7 * 60
		}
	});

	$('#daterangepicker2').daterangepicker({
		timePicker: true,
		timePickerIncrement: 5,
		use24hours: true,
		ranges: {
			'Today': [moment().startOf('day'), moment()],
			'Yesterday': [moment().subtract('days', 1).startOf('day'), moment().subtract('days', 1).endOf('day')],
			'Last 7 Days': [moment().subtract('days', 6).startOf('day'), moment()],
			'Last 30 Days': [moment().subtract('days', 29).startOf('day'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			// 'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
		},
		opens: 'left',
		startDate: moment().subtract('days', 1),
		endDate: moment()
		},
		function(start, end) {
			var date = {start: start.format('YYYY-MM-DD HH:mm:ss'),
				end: end.format('YYYY-MM-D HH:mm:ss'),
			};
			$('#daterangepicker2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			$('.mychartInterface').each(function(){
				interfaceChart($(this).attr('id'),date);
			})
			$('.mychartResource').each(function(){
				resourceChart($(this).attr('id'),date);
			})
			$('.highcharts-credits').hide();
	});

	function calculateStatistics(){
		this.series.slice(0, 2).forEach( series => {
			const data = series.data.filter(point => point.isInside).map(point => point.y);

			const statistics = [
				data[data.length - 1],
				Math.max.apply(null, data),
				Math.min.apply(null, data),
				(data.reduce((a , b)=> a + b, 0)/data.length).toFixed(1)
			];

			const legendItem = series.legendItem;
			let i = -1;
			// construct the legend string
			const text = legendItem.textStr.replace(/-?\d+\.\d/g, () => statistics[++i]);
			
			// set the constructed text for the legend
			legendItem.attr({
			text: text
			});
		});
	}

	// function updateLegendLabel() {
	// 	var chrt = !this.chart ? this : this.chart;
	// 	chrt.update({
	// 		legend: {
	// 		labelFormatter: function() {
	// 			var lastVal = this.yData[this.yData.length - 1],
	// 			chart = this.chart,
	// 			xAxis = this.xAxis,
	// 			points = this.points,
	// 			avg = 0,
	// 			counter = 0,
	// 			min, minPoint, max, maxPoint;

	// 			points.forEach(function(point, inx) {
	// 			if (point.isInside) {
	// 				if (!min || min > point.y) {
	// 				min = point.y;
	// 				minPoint = point;
	// 				}

	// 				if (!max || max < point.y) {
	// 				max = point.y;
	// 				maxPoint = point;
	// 				}

	// 				counter++;
	// 				avg += point.y;
	// 			}
	// 			});
	// 			avg /= counter;

	// 			return this.name + '<br>' + 'Now: ' + lastVal + ' °C<br>' +
	// 			'<span style="color: red">Min: ' + min + ' °C</span><br/>' +
	// 			'<span style="color: red">Max: ' + max + ' °C</span><br/>' +
	// 			'<span style="color: red">Average: ' + avg.toFixed(2); + ' °C</span><br/>';
	// 		}
	// 		}
	// 	});
	// 	}
	var maxTx = {}, minTx = {}, avgTx = {};
	var maxRx = {}, minRx = {}, avgRx = {};
	function requestDataInterface(iface, id, date) 
	{
		$.ajax({
			url: '<?php echo site_url("Statistic/lineGraphInterface");?>',     						
			type: "POST",
			dataType: "JSON",
			data: {iface:iface,
			start: date.start,
			end: date.end} ,
			success: function(data) {
				charts[id].maxTx = data.stat['MaxTx'];
				charts[id].minTx = data.stat['MinTx'];
				charts[id].avgTx = data.stat['AvgTx'];
				charts[id].maxRx = data.stat['MaxRx'];
				charts[id].minRx = data.stat['MinRx'];
				charts[id].avgRx = data.stat['AvgRx'];
				charts[id].hideLoading();
				// charts[id].xAxis[0].setCategories(data.point);
				charts[id].series[0].setData(data.tx);
				charts[id].series[1].setData(data.rx);
				console.log(data.stat);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
			  console.error("Status: " + textStatus + " request: " + XMLHttpRequest); console.error("Error: " + errorThrown); 
			}       
		});
	}

	

	function interfaceChart(id,date) { 
			var container = $('#'+id);
			if(!container.length) return false;
			var interface = container.data('interface');
			// console.log(interface);
			// var title = container.data('title');
			
			
			charts[id] = new Highcharts.Chart({
			chart: {
				renderTo: id,
		  		animation: Highcharts.svg,
				type: 'areaspline',
				// zoomType: 'x',
				events: {
					load: function () {
						requestDataInterface(interface, id, date);
					},	
				},
			},
			title: {
				text: null
			},
			exporting: {
				enabled: false
			},
			xAxis: {
				type: 'datetime',
			},
			yAxis: {
				minPadding: 0.2,
				maxPadding: 0.2,
				title: {text: null},
				labels: {
				formatter: function () {      
					var bytes = this.value;                          
					var sizes = ['b/s', 'kb/s', 'Mb/s', 'Gb/s', 'Tb/s'];
					if (bytes == 0) return '0 bps';
					var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
					return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];                    
				},
				},    
			},
			plotOptions: {
				area: {
					fillOpacity: 0.5,
					marker: {
						enabled: false,
						symbol: 'circle',
						radius: 2,
						states: {
							hover: {
								enabled: true
							}
						}
					}
				}
			},
			legend: {
				labelFormatter: function() {
					if(typeof charts[id] != 'undefined' && typeof charts[id].maxTx != 'undefined'){ 
						var maxTx = convertBit(charts[id].maxTx);
						var minTx = convertBit(charts[id].minTx);
						var avgTx = convertBit(Math.round(charts[id].avgTx,2));
						var maxRx = convertBit(charts[id].maxRx);
						var minRx = convertBit(charts[id].minRx); 
						var avgRx = convertBit(Math.round(charts[id].avgRx,2)); 
					}else{ 
						var maxTx = 0;  
						var maxTx = 0;
						var minTx = 0;
						var avgTx = 0;
						var maxRx = 0;
						var minRx = 0; 
						var avgRx = 0; 
					}
					
					// return this.name + '<br>Max: ' + maxTx + '<br>Min:  <br>Avg: ' + avgTx;
					return (this.name == 'Upload') ? this.name + '<br>Max: ' + maxTx + '<br>Min: ' + minTx + ' <br>Avg: ' + avgTx : this.name + '<br>Max: ' + maxRx + '<br>Min: ' + minRx + ' <br>Avg: ' + avgRx;
					},
				enabled :true,
				
			},
			tooltip: {   
				shared: true                                        
			},
			credits: {
				enabled: true
			},
			series: [{
				name: 'Upload',
				data: [],
				color: '#3498db',
				marker: {enabled: false}
			}, {
				name: 'Download',
				data: [],
				color: '#2ecc71',
				marker: {enabled: false}
			}],
		})
	}

	function requestDataResource(id,date) 
	{
		$.ajax({
			url: '<?php echo site_url("Statistic/lineGraphResource");?>',     						
			type: "POST",
			data: {start: date.start,
			end: date.end} ,
			dataType: "JSON",
			success: function(data) {
				if(id == 'chartCPU'){
					chartsResource[id].max = data.stat['MaxCPU'];
					chartsResource[id].min = data.stat['MinCPU'];
					chartsResource[id].avg = data.stat['AvgCPU'];
					chartsResource[id].series[0].setName('CPU');
					chartsResource[id].series[0].setData(data.cpu);
				}else{
					chartsResource[id].max = data.stat['MaxMemory'];
					chartsResource[id].min = data.stat['MinMemory'];
					chartsResource[id].avg = data.stat['AvgMemory'];
					chartsResource[id].series[0].setName('Memory');
					chartsResource[id].series[0].setData(data.memory);
				}
				// console.log(chartsResource[id].max)
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
			  console.error("Status: " + textStatus + " request: " + XMLHttpRequest); console.error("Error: " + errorThrown); 
			}       
		});
	}

	function resourceChart(id,date) { 
			var container = $('#'+id);
			chartsResource[id] = new Highcharts.Chart({
			chart: {
				renderTo: id,
		  		animation: Highcharts.svg,
				type: 'area',
				// zoomType: 'x',
				events: {
					load: requestDataResource(id,date),					
				},
			},
			title: {
				text: null
			},
			exporting: {
				enabled: false
			},
			xAxis: {
				type: 'datetime',
				dateTimeLabelFormats: {
					day: '%e of %b'
				}
			},
			yAxis: {
				labels: {
					format: '{value}%'
				},
				title: {
					enabled: false
				}
			},
			plotOptions: {
				area: {
					fillOpacity: 0.3,
					marker: {
						enabled: false,
						symbol: 'circle',
						radius: 2,
						states: {
							hover: {
								enabled: true
							}
						}
					}
				}
			},
			legend: {
				labelFormatter: function() {
					if(this.name == 'Memory'){
						if(typeof chartsResource[id] != 'undefined' && typeof chartsResource[id].max != 'undefined'){ 
							var max = convertByte(chartsResource[id].max);
							var min = convertByte(chartsResource[id].min);
							var avg = convertByte(chartsResource[id].avg);
						}else{ 
							var max = 0;  
							var min = 0;
							var avg = 0;
						}
						return this.name + '<br>Max: ' + max + '<br>Min: ' + min + ' <br>Avg: ' + avg;
					}else{
						if(typeof chartsResource[id] != 'undefined' && typeof chartsResource[id].max != 'undefined'){ 
							var max = chartsResource[id].max;
							var min = chartsResource[id].min;
							var avg = chartsResource[id].avg;
						}else{ 
							var max = 0;  
							var min = 0;
							var avg = 0;
						}
						return this.name + '<br>Max: ' + max + '%<br>Min: ' + min + ' %<br>Avg: ' + avg + ' %';

					}
					
					// return this.name + '<br>Max: ' + maxTx + '<br>Min:  <br>Avg: ' + avgTx;
					
					},
				enabled :true,
				
			},
			tooltip: {
				shared: true,
        		valueSuffix: ' %'                                                    
			},
			series: [{
				name: '',
				data: {'x': [], 'y': []},
				marker: {enabled: false},
				color: '#f1c40f'
			}],
		})
	}

	function convertBit(value){
		var bits = value;                          
		var sizes = ['b/s', 'kb/s', 'Mb/s', 'Gb/s', 'Tb/s'];
		if (bits == 0) return '0 bps';
		var i = parseInt(Math.floor(Math.log(bits) / Math.log(1024)));
		return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];                    
	}

	function convertByte(value){
		var bytes = value;                          
		var sizes = ['B', 'kB', 'MB', 'GB', 'TB'];
		if (bytes == 0) return '0 Bps';
		var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
		return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];                    
	}
</script>

</body>
</html>
