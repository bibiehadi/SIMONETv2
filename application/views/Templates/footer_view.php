<div class="modal fade" id="modal_log" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title">Log Activity</h4>
                    
            </div>
            <div class="modal-body form">
                <div class="row ">
                    <div class="col-sm-4 pull-right">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            <input class="form-control" placeholder='Search..' type="text" id="searchLog">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin : 5px">
                    <table id="tb_simonetlog" class="table about-table " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 120px">Date</th>
                                <th>Event</th>
                                <th style="width: 80px">Tag</th>
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

<div class="modal fade" id="modal_settings" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title">Settings</h4>
            </div>
            <div class="modal-body form">
                <div class="tab-container tab-left tab-default">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tabAdmin" data-toggle="tab">Admins</a>
                        </li>
                        <li>
                            <a href="#tabDev" data-toggle="tab">Device Auth</a>
                        </li>
                        <li>
                            <a href="#tabSetting" data-toggle="tab">Template Default Setting</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabAdmin">
                            <h4>Admins</h4>
                            <hr>
                            <table id="tb_discovery" class="table about-table " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>E-mail</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tabDev">
                            <h4>Device Authentication</h4>
                            <hr>
                            <table id="tb_deviceAuth" class="table about-table " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Port</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tabSetting">
                            <h4>Template Setting</h4>
                            <hr>
                            <table id="tb_settings" class="table about-table " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Comment</th>
                                        <th>Script</th>
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

    tableLog = $('#tb_simonetlog').DataTable({
        responsive : true,
        pageLength : 100,
        lengthChange: false,
        dom: 'Trt<"bottom"ip><"clear">',
        // order: [[ 2, "desc" ]],
        scrollY: "300px",
        scrollCollapse: true,
        // paging: false,
        oLanguage: {
        "sSearch": "<span>Search..</span> _INPUT_"
        },
        ajax : {
            "url" : "<?php echo site_url('log/logEventJSON')?>",
            "type" : "POST"
            // "dataSrc" : ""
        },
        columns : [
            {"data" : "DeviceReportedTime"},
            {"data" : "Message"},
            {"data" : "SysLogTag"},
            {"data" : "FromHost"}
        ],
        "createdRow": function(row, data, dataIndex) {
            if (data["SysLogTag"] == 'ipsec,error' || data["SysLogTag"] == 'ipsec,error') {
            $(row).css("background-color", "#B9BAB8");
            // $(row).addClass("label label-danger");
            }
        }
    });

    $('#searchLog').keyup(function(){
            tableLog.search($(this).val()).draw() ;
        })

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

    function getadmins(){
        var url = "<?php echo site_url('dashboard/getAdmins')?>";

        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) 
                {
                    var trHTML = '';
                    $.each(data, function (i, item) {
                        trHTML += '<tr><td>' + item.rank + '</td><td>' + item.content + '</td><td>' + item.UID + '</td></tr>';
                    });
                    $('#records_table').append(trHTML);
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log("Error getResource");
            }
        });

        setTimeout(function(){ getResource(); }, 5000);
    }
// $('#logPopover').on('click').popover('show');
</script>