<?php $this->load->view('Templates/headersidebar_view'); ?>
</div>
                </div>
                <div class="static-content-wrapper">
                    <div class="static-content">
                        <div class="page-content">
                            <div class="container-fluid">
                                <div class="container-topology cols-sm-12">

                                </div>

                    <div id="topology-container"></div>
<footer role="contentinfo">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li><h6 style="margin: 0;">&copy; 2015 Avenxo</h6></li>
        </ul>
        <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
    </div>
</footer>

<?php $this->load->view('Templates/footer_view'); ?>
<script>
    

    var topologyData = {"nodes": [], "links": []};
    getData();

    // {
    //     "nodes": [
    //         {
    //             "id": 0,
    //             "name": "HQ"
    //         },
    //         {
    //             "id": 1,
    //             "name": "Mars"
    //         },
    //         {
    //             "id": 2,
    //             "name": "Saturn"
    //         },
    //         {
    //             "id": 3,
    //             "name": "Pluto"
    //         },
    //         {
    //             "id": 4,
    //             "name": "Bumi"
    //         }
    //     ],
    //     "links": [
    //         {
    //             "id": 0,
    //             "source": 0,
    //             "target": 1
    //         },
    //         {
    //             "id": 1,
    //             "source": 0,
    //             "target": 2
    //         },
    //         {
    //             "id": 2,
    //             "source": 0,
    //             "target": 3
    //         },
    //         {
    //             "id": 3,
    //             "source": 1,
    //             "target": 2
    //         },
    //         {
    //             "id": 4,
    //             "source": 2,
    //             "target": 3
    //         },
    //         {
    //             "id": 5,
    //             "source": 3,
    //             "target": 1
    //         },
    //         {
    //             "id": 6,
    //             "source": 4,
    //             "target": 2
    //         },
    //         {
    //             "id": 7,
    //             "source": 4,
    //             "target": 1
    //         }
    //     ]
    // };


    function getData(){
        $.ajax({
			url: '<?php echo site_url("Topology/getNodes");?>',     						
            type: "POST",
            async : false,
			dataType: "JSON",
			success: function(data) {
                // var temp = $.parseJSON(data);
                $.each(data.data.nodes, function(k,v){
                    topologyData['nodes'].push(v);
                })
                $.each(data.data.links, function(k,v){
                    topologyData['links'].push(v);

                })
                // console.log(data);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
              console.error("Status: " + textStatus + " request: " + XMLHttpRequest); 
              console.error("Error: " + errorThrown); 
			}       
		});
    }

                // console.log(topologyData);	

    (function(nx){
        nx.define('ExtendedNode', nx.graphic.Topology.Node, {
            view: function (view) {
                view.content.push({
                    // name to retrieve the object
                    "name": "deviceDownBadge",
                    // inherit from "Circle" class
                    "type": "nx.graphic.Circle",
                    "props": {
                        // radius
                        "r": 5,
                        // background color
                        "fill": "#ff0000",
                        // should be invisible by default
                        "visible": false
                    }
                });
                return view;
            },
            methods: {

                // called when the model is about to initialize
                'setModel': function (model) {
                    this.inherited(model);
                    var status = model['_data']['status'];
                    // draw/not draw the badge based on status
                    if (status == 'Connected'){
                        
                        this._hideDownBadge();
                    }else{
                        this._showDownBadge();
                    }
                },

                // display the red badge
                "_showDownBadge": function () {
                    // view of badge
                    var badge = this.view("deviceDownBadge");

                    // set properties
                    badge.sets({
                        // make visible
                        "visible": true,
                        // set X offset
                        "cx": -5,
                        // set Y offset
                        "cy": 5
                    });

                },

                // make the badge invisible
                "_hideDownBadge": function () {
                    this.view("deviceDownBadge").set("visible", false);
                }
            }
        });
    })(nx);

    (function (nx) {
	nx.define('MyTopology', nx.graphic.Topology, {
		methods: {
			"init": function(){
				this.inherited({
					// width 100% if true
					'adaptive': false,
					// show icons' nodes, otherwise display dots
					'showIcon': true,
					// special configuration for nodes
					'nodeConfig': {
						'label': 'model.name',
						'iconType': function (model, node) {
                            var platform = model['_data']['platform'];
                            // console.log(;
							if(typeof platform == "string" && platform == "MikroTik"){
                                return "rb";
                            }else if(typeof platform == "string" && platform == "UniFi"){
                                return "unifi";    
                            }

						},
						'color': '#0how00'
					},
					// special configuration for links
					'linkConfig': {
						'linkType': 'curve'
					},
					// property name to identify unique nodes
					'identityKey': 'id', // helps to link source and target
					// canvas size
					'width': 1200 ,
					'height': 600,
					// "engine" that process topology prior to rendering
					'dataProcessor': 'force',
					// moves the labels in order to avoid overlay
					'enableSmartLabel': true,
					// smooth scaling. may slow down, if true
					'enableGradualScaling': true,
					// if true, two nodes can have more than one link
					'supportMultipleLink': true,
					// enable scaling
                    "scalable": true,
                    // extended node
					"nodeInstanceClass": "ExtendedNode"
				});
			}
		}
    });
    // instantiate NeXt app
	var app = new nx.ui.Application();

    // instantiate Topology class
    var topology = new MyTopology();

    topology.registerIcon("rb", "<?php echo base_url('assets/img/rb.png')?>", 40, 40);
    topology.registerIcon("unifi", "<?php echo base_url('assets/img/unifi.png')?>", 40, 40);
    // load topology data from app/data.js
    topology.data(topologyData);

    // bind the topology object to the app
    topology.attach(app);

    // app must run inside a specific container. In our case this is the one with id="topology-container"
    app.container(document.getElementById("topology-container"));
})(nx);
$('.n-topology').appendTo($('.container-topology'));
</script>

</body>
</html>