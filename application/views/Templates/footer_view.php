<div class="modal fade" id="modal_log" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title">Log Activity</h4>
            </div>
            <div class="modal-body form">
                    <table id="tb_simonetlog" class="table about-table " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Tag</th>
                                <th>Date Time</th>
                                <th>From</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_settings" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title">Add Device</h4>
            </div>
            <div class="modal-body form">
                <div class="tab-container tab-left tab-default">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#AddManualy" data-toggle="tab">Settings</a>
                        </li>
                        <li>
                            <a href="#DiscoveryDevice" data-toggle="tab">Discover MikroTik</a>
                        </li>
                        <li>
                            <a href="#UniFiDevice" data-toggle="tab">Discover UniFi</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="AddManualy">
                            <form id="form" action="＃" method="post" class="form-horizontal row-border">
                                <input type="hidden" value="" name="id"/> 
                            
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Serial Number</label>
                                    <div class="col-sm-8">
                                        <input type="input" name="serial" class="form-control" placeholder='Serial Number Device'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">IP Address</label>
                                    <div class="col-sm-8">
                                        <input type="input" name="address4" class="form-control" placeholder='IP Address Device' required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Mac-Address</label>
                                    <div class="col-sm-8">
                                        <input type="input" name="mac_address" class="form-control" placeholder='Mac Address' required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Platform</label>
                                    <div class="col-sm-8">
                                        <select name="platform" id="selector_platform" class="form-control">
                                            <option value="">--- Select ---</option>
                                            <option value="MikroTik">MikroTik</option>
                                            <option value="MikroTik Switch">MikroTik Switch</option>
                                            <option value="UniFi">UniFi</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Location</label>
                                    <div class="col-sm-8">
                                        <select name="location" id="selector2" class="form-control">
                                            <option value="">--- Select ---</option>
                                            <?php foreach ($location as $row) : ?>
                                                <option value="<?php print_r($row); ?>"><?php echo $row['nama'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <a type="submit" id="btnSave" data-toggle="tab" href="#addUser" class="btn btn-success pull-right" style="margin: 10px 0px 0px 0px">Save</a>
                        </div>
                        <div class="tab-pane" id="addUser">
                            <table id="tb_discovery" class="table about-table " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>IP Address</th>
                                        <th>Identity</th>
                                        <th>Board</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="DiscoveryDevice">
                            <table id="tb_discovery" class="table about-table " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Interface</th>
                                        <th>IP Address</th>
                                        <th>Identity</th>
                                        <th>Board</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="UniFiDevice">
                            <table id="tb_unifi" class="table about-table " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>IP Address</th>
                                        <th>Identity</th>
                                        <th>Model</th>
                                        <th>Version</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="demo-options">
        <div class="demo-options-icon"><i class="ti ti-paint-bucket"></i></div>
        <div class="demo-heading">Settings</div>

        <div class="demo-body">
            <div class="tabular">
                <div class="tabular-row">
                    <div class="tabular-cell">Collapse Leftbar</div>
                    <div class="tabular-cell demo-switches"><input class="bootstrap-switch" type="checkbox" data-size="mini" data-on-color="success" data-off-color="default" name="demo-collapseleftbar" data-on-text="&nbsp;" data-off-text="&nbsp;"></div>
                </div>
            </div>
        </div>

        <div class="demo-body">
            <div class="option-title">Topnav</div>
            <ul id="demo-header-color" class="demo-color-list">
                <li><span class="demo-cyan"></span></li>
                <li><span class="demo-light-blue"></span></li>
                <li><span class="demo-blue"></span></li>
                <li><span class="demo-indigo"></span></li>
                <li><span class="demo-deep-purple"></span></li> 
                <li><span class="demo-purple"></span></li> 
                <li><span class="demo-pink"></span></li> 
                <li><span class="demo-red"></span></li>
                <li><span class="demo-teal"></span></li>
                <li><span class="demo-green"></span></li>
                <li><span class="demo-light-green"></span></li>
                <li><span class="demo-lime"></span></li>
                <li><span class="demo-yellow"></span></li>
                <li><span class="demo-amber"></span></li>
                <li><span class="demo-orange"></span></li>               
                <li><span class="demo-deep-orange"></span></li>
                <li><span class="demo-midnightblue"></span></li>
                <li><span class="demo-bluegray"></span></li>
                <li><span class="demo-bluegraylight"></span></li>
                <li><span class="demo-black"></span></li> 
                <li><span class="demo-gray"></span></li> 
                <li><span class="demo-graylight"></span></li> 
                <li><span class="demo-default"></span></li>
                <li><span class="demo-brown"></span></li>
            </ul>
        </div>

        <div class="demo-body">
            <div class="option-title">Sidebar</div>
            <ul id="demo-sidebar-color" class="demo-color-list">
                <li><span class="demo-cyan"></span></li>
                <li><span class="demo-light-blue"></span></li>
                <li><span class="demo-blue"></span></li>
                <li><span class="demo-indigo"></span></li>
                <li><span class="demo-deep-purple"></span></li> 
                <li><span class="demo-purple"></span></li> 
                <li><span class="demo-pink"></span></li> 
                <li><span class="demo-red"></span></li>
                <li><span class="demo-teal"></span></li>
                <li><span class="demo-green"></span></li>
                <li><span class="demo-light-green"></span></li>
                <li><span class="demo-lime"></span></li>
                <li><span class="demo-yellow"></span></li>
                <li><span class="demo-amber"></span></li>
                <li><span class="demo-orange"></span></li>               
                <li><span class="demo-deep-orange"></span></li>
                <li><span class="demo-midnightblue"></span></li>
                <li><span class="demo-bluegray"></span></li>
                <li><span class="demo-bluegraylight"></span></li>
                <li><span class="demo-black"></span></li> 
                <li><span class="demo-gray"></span></li> 
                <li><span class="demo-graylight"></span></li> 
                <li><span class="demo-default"></span></li>
                <li><span class="demo-brown"></span></li>
            </ul>
        </div>
    </div>


<!-- Load site level scripts -->

<script type="text/javascript" src="<?php echo base_url('') ?>assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
<script type="text/javascript" src="<?php echo base_url('') ?>assets/js/jqueryui-1.10.3.min.js"></script> 							<!-- Load jQueryUI -->
<script type="text/javascript" src="<?php echo base_url('') ?>assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
<script type="text/javascript" src="<?php echo base_url('') ?>assets/js/enquire.min.js"></script> 									

<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/velocityjs/velocity.min.js"></script>					
<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/velocityjs/velocity.ui.min.js"></script>

<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/wijets/wijets.js"></script>     						

<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/codeprettifier/prettify.js"></script> 				
<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		

<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  

<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/iCheck/icheck.min.js"></script>   

<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script>

<script type="text/javascript" src="<?php echo base_url('') ?>assets/js/application.js"></script>
<script type="text/javascript" src="<?php echo base_url('') ?>assets/js/bootbox.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url('') ?>assets/demo/demo.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('') ?>assets/demo/demo-switcher.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/form-daterangepicker/moment.min.js"></script>              			

<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/form-colorpicker/js/bootstrap-colorpicker.min.js"></script> 			
<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>      			
<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>      			 -->

<!-- <script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/clockface/js/clockface.js"></script>     								Clockface -->


<!-- <script type="text/javascript" src="<?php echo base_url('') ?>assets/demo/demo-pickers.js"></script> -->
<!-- End loading site level scripts -->
    
<!-- Load page level scripts -->
<!-- <script type="text/javascript" src="<?php echo base_url('') ?>assets/demo/demo-datatables.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/progress-skylo/skylo.js"></script>

<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.4/js/responsive.bootstrap.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>

    table = $('#tb_simonetlog').DataTable({
        responsive : true,
        pageLength : 10,
        lengthChange: false,
        // dom: 'Trt<"bottom"ip><"clear">',
        tableTools: {
            "sSwfPath": "/swf/copy_csv_xls_pdf.swf"
        },
        order: [[ 2, "desc" ]],
        oLanguage: {
        "sLengthMenu": " _MENU_ ",
        "sSearch": "<span>Search..</span> _INPUT_"
        },
        ajax : {
            "url" : "<?php echo site_url('log/logEventJSON')?>",
            "type" : "POST"
            // "dataSrc" : ""
        },
        columns : [
            {"data" : "Message"},
            {"data" : "SysLogTag"},
            {"data" : "DeviceReportedTime"},
            {"data" : "FromHost"}
        ],
        "createdRow": function(row, data, dataIndex) {
            if (data["SysLogTag"] == 'ipsec,error' || data["SysLogTag"] == 'ipsec,error') {
            $(row).css("background-color", "#B9BAB8");
            // $(row).addClass("label label-danger");
            }
        }
    });

    $('body').on('click','a[data-aksi="log"]',function(){
        log();
    })

    $('body').on('click','a[data-aksi="settings"]',function(){
        settings();
    })

    function log(){
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_log').modal('show');
    }

    function settings(){
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_settings').modal('show');
    }
// $('#logPopover').on('click').popover('show');
</script>