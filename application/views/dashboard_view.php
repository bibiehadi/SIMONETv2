<?php $this->load->view('templates/headersidebar_view'); ?>
   </div>
                </div>
                <div class="static-content-wrapper">
                    <div class="static-content">
                        <div class="page-content">
                            <div class="container-fluid">

<div class="row" style = "margin-top: 20px">
	<div class="col-sm-3">
		<div class="panel panel-profile">
			<div class="panel-body">
			<div class="name">Main Router</div>
			<div class="info">CCR - 1036</div>
			<div class="row" style="text-align : left; margin-top: 5px">  
				<div class="info">CPU</div>
				<div class="progress" style="height: 20px">
					<div id="cpu" class="progress-bar"></div>
				</div>
				<div class="info">Memory</div>
				<div class="progress" style="height: 20px">
					<div id="mem" class="progress-bar"></div>
				</div>
				<div class="col-md-6">
					<div class="info">CPU Temperature : </div> 
					<p id="volt"></p>
				</div>
				<div class="col-md-6">
					<div class="info">Temperature : </div> 
					<p id="temp"></p>
				</div>
			</div>
			</div>
		</div><!-- panel -->
	</div><!-- col-sm-3 -->
	<div class="col-sm-9">
		<div class="tab-content">
			<div class="tab-pane active" id="tab-about">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="about-area">
							<h4>Network</h4>
							<div class="col-sm-3">
								<div style="text-align:center">
									<img src="<?php echo base_url('assets/img/rb.png')?>" class="img-circle" style="width : 100px; ">
									<h4>Routerboard</h4>
									<h3>.../...</h3>
								</div>
							</div>
							<div class="col-sm-3">
								<div style="text-align:center">
									<img src="<?php echo base_url('assets/img/unifi.png')?>" class="img-circle" style="width : 100px; ">
									<h4>AP UniFi</h4>
									<h3>.../...</h3>
								</div>
							</div>
							<div class="col-sm-3">
								<div style="text-align:center">
									<img src="<?php echo base_url('assets/img/clients.png')?>" class="img-circle" style="width : 100px; ">
									<h4>Users Connect</h4>
									<h3>.../...</h3>
								</div>
							</div>
							<div class="col-sm-3">
								<div style="text-align:center">
									<img src="<?php echo base_url('assets/img/users.png')?>" class="img-circle" style="width : 100px; ">
									<h4>User Login</h4>
									<h3>.../...</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .tab-content -->
	</div><!-- col-sm-8 -->
</div>

<div data-widget-group="group1">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-bluegray" data-widget='{"id" : "wiget9", "draggable": "false"}'>
				<div class="panel-heading">
					<h2>Indosat</h2>
					<div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-editbox" data-widget-controls=""></div>
				<div class="panel-body">
					<div class="mychart" id="chart1" style="height: 272px;" class="mt-sm mb-sm" data-interface="Indosat"></div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-bluegray" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2>MyRep BPro 100</h2>
					<div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-body">
					<div class="mychart" id="chart2" style="height: 272px;" class="mt-sm mb-sm" data-interface="BPro100"></div>
				</div>
			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-bluegray" data-widget='{"id" : "wiget9", "draggable": "false"}'>
				<div class="panel-heading">
					<h2>MyRep B300</h2>
					<div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-editbox" data-widget-controls=""></div>
				<div class="panel-body">
					<div class="mychart" id="chart3" style="height: 272px;" class="mt-sm mb-sm" data-interface="B300"></div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-bluegray" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2>MyRep B100</h2>
					<div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-body">
					<div class="mychart" id="chart4" style="height: 272px;" class="mt-sm mb-sm" data-interface="B100"></div>
				</div>
			</div>
		</div>

	</div>

</div>

                            </div> <!-- .container-fluid -->
                        </div> <!-- #page-content -->
                    </div>
                    <footer role="contentinfo">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li><h6 style="margin: 0;">&copy; 2015 Avenxo</h6></li>
        </ul>
        <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
    </div>
</footer>
    </body>
    <?php $this->load->view('templates/footer_view'); ?>
<script>
	var charts = {};
	var chart;
	$(document).ready(function() {
		$('.mychart').each(function(){
			interfaceChart($(this).attr('id'));
		})
		
		$('.highcharts-credits').hide();
		getResource();
		
	});

	function requestData(iface, id) 
	{
		$.ajax({
			url: '<?php echo site_url("dashboard/interface");?>',     						
			type: "POST",
			dataType: "JSON",
			data: {iface:iface} ,
			success: function(data) {	
				console.log(data);
				charts[id].xAxis[0].setCategories(data.point);
				charts[id].series[0].setData(data.tx);
				charts[id].series[1].setData(data.rx);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
			  console.error("Status: " + textStatus + " request: " + XMLHttpRequest); console.error("Error: " + errorThrown); 
			}       
		});
		
	}

	function interfaceChart(id) { 
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
					setInterval(function () {
						requestData(interface, id);
					}, 8000);
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
				name: 'Tx',
				data: [],
				marker: {enabled: false}
			}, {
				name: 'Rx',
				data: [],
				marker: {enabled: false}
			}],
		})
	}

	function getResource(){
        var url = "<?php echo site_url('devices/getResource')?>";

        $.ajax({
            url : url,
            type: "POST",
            data: {ip : '10.10.10.1'},
            dataType: "JSON",
            success: function(data)
            {
				console.log(data);
                if(data.status) 
                {
                    $('#cpu').css("width", data.data['cpu-load'] + "%").text(data.data['cpu-load'] + " %");
                    $('#mem').css("width", Math.round(((data.data['total-memory'] - data.data['free-memory'])/data.data['total-memory'])*100) + "%").text(Math.round(((data.data['total-memory'] - data.data['free-memory'])/data.data['total-memory'])*100) + " %");
                    $('#volt').text(data.data['voltage']);
                    $('#temp').text(data.data['temperature']);
                }
                $.skylo('end');
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log("Error getResource");
            }
		});
		
        setTimeout(function(){ getResource(); }, 5000);
    }
	</script>
</html>