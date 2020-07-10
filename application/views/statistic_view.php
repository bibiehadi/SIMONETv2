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

	$('#daterangepicker2').daterangepicker({
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
			'Last 7 Days': [moment().subtract('days', 6), moment()],
			'Last 30 Days': [moment().subtract('days', 29), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
		},
		opens: 'left',
		startDate: moment().subtract('days', 6),
		endDate: moment()
		},
		function(start, end) {
			var date = {start: start.format('YYYY-MM-DD 00:00:00'),
				end: end.format('YYYY-MM-D 23:59:59'),
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

	Highcharts.setOptions({
		global: {
			timezoneOffset: -7 * 60
		}
	});

	function updateLegendLabel() {
		var chrt = !this.chart ? this : this.chart;
		chrt.update({
			legend: {
			labelFormatter: function() {
				var lastVal = this.yData[this.yData.length - 1],
				chart = this.chart,
				xAxis = this.xAxis,
				points = this.points,
				avg = 0,
				counter = 0,
				min, minPoint, max, maxPoint;

				points.forEach(function(point, inx) {
				if (point.isInside) {
					if (!min || min > point.y) {
					min = point.y;
					minPoint = point;
					}

					if (!max || max < point.y) {
					max = point.y;
					maxPoint = point;
					}

					counter++;
					avg += point.y;
				}
				});
				avg /= counter;

				return this.name + '<br>' + 'Now: ' + lastVal + ' °C<br>' +
				'<span style="color: red">Min: ' + min + ' °C</span><br/>' +
				'<span style="color: red">Max: ' + max + ' °C</span><br/>' +
				'<span style="color: red">Average: ' + avg.toFixed(2); + ' °C</span><br/>';
			}
			}
		});
		}

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
				console.log(data);
				charts[id].hideLoading();
				// charts[id].xAxis[0].setCategories(data.point);
				charts[id].series[0].setData(data.tx);
				charts[id].series[1].setData(data.rx);
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
			console.log(interface);
			// var title = container.data('title');
			
			
			charts[id] = new Highcharts.Chart({
			chart: {
				renderTo: id,
		  		animation: Highcharts.svg,
				type: 'areaspline',
				// zoomType: 'x',
				events: {
					load: function () {
					// setInterval(function () {
					// 	charts[id].showLoading();
						requestDataInterface(interface, id, date);
					// }, 99000);
					}				
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
				// categories : data.point,
				// tickInterval: 60
				
				// labels: {
				//     data : data.point,
				// format: '{value:%Y-%m-%d}',
				// rotation: 45,
				// align: 'left'
				// }
			},
			yAxis: {
				// title: {
				//     text: 'Y-Axis'
				// }
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
			tooltip: {
				// formatter: function () { 
				// 	var _0x2f7f=["\x70\x6F\x69\x6E\x74\x73","\x79","\x62\x70\x73","\x6B\x62\x70\x73","\x4D\x62\x70\x73","\x47\x62\x70\x73","\x54\x62\x70\x73","\x3C\x73\x70\x61\x6E\x20\x73\x74\x79\x6C\x65\x3D\x22\x63\x6F\x6C\x6F\x72\x3A","\x63\x6F\x6C\x6F\x72","\x73\x65\x72\x69\x65\x73","\x3B\x20\x66\x6F\x6E\x74\x2D\x73\x69\x7A\x65\x3A\x20\x31\x2E\x35\x65\x6D\x3B\x22\x3E","\x73\x79\x6D\x62\x6F\x6C\x55\x6E\x69\x63\x6F\x64\x65","\x3C\x2F\x73\x70\x61\x6E\x3E\x3C\x62\x3E","\x6E\x61\x6D\x65","\x3A\x3C\x2F\x62\x3E\x20\x30\x20\x62\x70\x73","\x70\x75\x73\x68","\x6C\x6F\x67","\x66\x6C\x6F\x6F\x72","\x3A\x3C\x2F\x62\x3E\x20","\x74\x6F\x46\x69\x78\x65\x64","\x70\x6F\x77","\x20","\x65\x61\x63\x68","\x3C\x62\x3E\x4D\x69\x6B\x68\x6D\x6F\x6E\x20\x54\x72\x61\x66\x66\x69\x63\x20\x4D\x6F\x6E\x69\x74\x6F\x72\x3C\x2F\x62\x3E\x3C\x62\x72\x20\x2F\x3E\x3C\x62\x3E\x54\x69\x6D\x65\x3A\x20\x3C\x2F\x62\x3E","\x25\x48\x3A\x25\x4D\x3A\x25\x53","\x78","\x64\x61\x74\x65\x46\x6F\x72\x6D\x61\x74","\x3C\x62\x72\x20\x2F\x3E","\x20\x3C\x62\x72\x2F\x3E\x20","\x6A\x6F\x69\x6E"];var s=[];$[_0x2f7f[22]](this[_0x2f7f[0]],function(_0x3735x2,_0x3735x3){var _0x3735x4=_0x3735x3[_0x2f7f[1]];var _0x3735x5=[_0x2f7f[2],_0x2f7f[3],_0x2f7f[4],_0x2f7f[5],_0x2f7f[6]];if(_0x3735x4== 0){s[_0x2f7f[15]](_0x2f7f[7]+ this[_0x2f7f[9]][_0x2f7f[8]]+ _0x2f7f[10]+ this[_0x2f7f[9]][_0x2f7f[11]]+ _0x2f7f[12]+ this[_0x2f7f[9]][_0x2f7f[13]]+ _0x2f7f[14])};var _0x3735x2=parseInt(Math[_0x2f7f[17]](Math[_0x2f7f[16]](_0x3735x4)/ Math[_0x2f7f[16]](1024)));s[_0x2f7f[15]](_0x2f7f[7]+ this[_0x2f7f[9]][_0x2f7f[8]]+ _0x2f7f[10]+ this[_0x2f7f[9]][_0x2f7f[11]]+ _0x2f7f[12]+ this[_0x2f7f[9]][_0x2f7f[13]]+ _0x2f7f[18]+ parseFloat((_0x3735x4/ Math[_0x2f7f[20]](1024,_0x3735x2))[_0x2f7f[19]](2))+ _0x2f7f[21]+ _0x3735x5[_0x3735x2])});return _0x2f7f[23]+ Highcharts[_0x2f7f[26]](_0x2f7f[24], new Date(this[_0x2f7f[25]]))+ _0x2f7f[27]+ s[_0x2f7f[29]](_0x2f7f[28])
				// },
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
					chartsResource[id].series[0].setName('CPU');
					chartsResource[id].series[0].setData(data.cpu);
				}else{
					chartsResource[id].series[0].setName('Memory');
					chartsResource[id].series[0].setData(data.memory);
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
			  console.error("Status: " + textStatus + " request: " + XMLHttpRequest); console.error("Error: " + errorThrown); 
			}       
		});
	}

	function resourceChart(id,date) { 
			var container = $('#'+id);
			// if(!container.length) return false;
			// var title = container.data('title');
			
			
			chartsResource[id] = new Highcharts.Chart({
			chart: {
				renderTo: id,
		  		animation: Highcharts.svg,
				type: 'area',
				// zoomType: 'x',
				events: {
					load: function () {
					// setInterval(function () {
					// 	charts[id].showLoading();
						requestDataResource(id,date);
					// }, 99000);
					}				
				},
			},
			title: {
				text: null
			},
			exporting: {
				enabled: false
			},
			xAxis: {
				// type: 'datetime',
				type: 'datetime',
				dateTimeLabelFormats: {
					day: '%e of %b'
				}
				// categories : data.point,
				// tickInterval: 60
				
				// labels: {
				//     data : data.point,
				// format: '{value:%Y-%m-%d}',
				// rotation: 45,
				// align: 'left'
				// }
			},
			yAxis: {
				labels: {
					format: '{value}%'
				},
				title: {
					enabled: false
				}
				// title: {
				//     text: 'Y-Axis'
				// }
				// minPadding: 0.2,
				// maxPadding: 0.2,
				// title: {text: null},
				// labels: {
				// formatter: function () {      
				// 	var bytes = this.value;                          
				// 	var sizes = ['b/s', 'kb/s', 'Mb/s', 'Gb/s', 'Tb/s'];
				// 	if (bytes == 0) return '0 bps';
				// 	var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
				// 	return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];                    
				// },
				// },    
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
			tooltip: {
				
				shared: true                                                      
			},
			series: [{
				name: '',
				data: {'x': [], 'y': []},
				marker: {enabled: false},
				color: '#f1c40f'
			}],
		})
	}
</script>

</body>
</html>
