<?php $this->load->view('templates/headersidebar_view'); ?>
</div>
    </div>
    <div class="static-content-wrapper">
        <div class="static-content">
            <div class="page-content">
                <div class="container-fluid" style="margin-top: 10px">
                    <!-- <div data-widget-group="group1"> -->
                        <div class="row">
                            <div class="col-md-12">
                            <?php echo $this->session->flashdata('devices') ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h2>Devices</h2>
                                        <select name="id" id="table-filter" class="list-group list-group-horizontal" style="width: 120px;color: #03a9f4;outline: 0px; background: #fafafa; margin-left :10px">
                                            <option class="list-group-item list-group-item-action active" selected value="">All</option>
                                            <option class="list-group-item list-group-item-action active" value="MikroTik">MikroTik</option>
                                            <option class="list-group-item list-group-item-action active" value="UniFi">UniFi</option>
                                        </select>

                                        <!-- <div class="panel-ctrls"></div> -->
                                        <a class="btn btn-success pull-right" data-aksi="add" style="margin: 10px 10px;"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="panel-body">
                                        <table id="tb_devices" class="hover table " cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Device Name</th>
                                                    <th>Status</th>
                                                    <th>IP Address</th>
                                                    <th>Serial Number</th>
                                                    <th>Version</th>
                                                    <th>Uptime</th>
                                                    <th>Model</th>
                                                    <th>Platform</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
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


<div class="modal fade" id="modal_form" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title">Add User Profile</h4>
            </div>
            <div class="modal-body form">
                <div class="tab-container tab-default">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#AddManualy" data-toggle="tab">Add Device</a>
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
                                        <input type="input" name="serial" class="form-control" placeholder='Serial Number Device' required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Main IP Address</label>
                                    <div class="col-sm-8">
                                        <input type="input" name="address4" class="form-control" placeholder='IP Address Device' required>
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
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <button type="submit" id="btnSave" onClick="save()" class="btn btn-success pull-right" style="margin: 10px 0px 0px 0px">Save</button>
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

<?php $this->load->view('templates/footer_view'); ?>


<script type="text/javascript">
    table = $('#tb_devices').DataTable({
        responsive : true,
        oLanguage: {
        "sLengthMenu": " _MENU_ ",
        "sSearch": "<span>Search..</span> _INPUT_"
        },
        ajax : {
            "url" : "<?php echo site_url('devices/devicesJSON')?>",
            "type" : "POST"
            // "dataSrc" : ""
        },
        columns : [
            {"data" : "id"},
            {"data" : "identity"},
            {"data" : "status"},
            {"data" : "main_address4"},
            {"data" : "serial_number"},
            {"data" : "version"},
            {"data" : "uptime"},
            {"data" : "model"},
            {"data" : "platform"}
        ],
    });

    $('#table-filter').on('change', function(){
       table.search(this.value).draw();   
    });

    setInterval(() => {
        reload_table();
    }, 60000);

    $('#tb_devices_filter input').attr('placeholder',"Search..");

    table2 = $('#tb_discovery').DataTable({
        pageLength: 5,
        responsive : true,
        dom: '<"top"f>rt<"bottom"p><"clear">',
        bLengthChange : false,
        bInfo: false,
        ajax : {
            "url" : "<?php echo site_url('devices/discoverydevices')?>",
            "type" : "POST"
            // "dataSrc" : ""
        },
        columns : [
            {"data" : "id"},
            {"data" : "interface"},
            {"data" : "address"},
            {"data" : "identity"},
            {"data" : "board"},
            {"data" : "aksi"}
        ],
    })

    table3 = $('#tb_unifi').DataTable({
        pageLength: 5,
        responsive : true,
        bLengthChange : false,
        bInfo: false,
        dom: '<"top"f>rt<"bottom"p><"clear">',
        ajax : {
            "url" : "<?php echo site_url('devices/getUnifiDevices')?>",
            "type" : "POST"
            // "dataSrc" : ""
        },
        columns : [
            {"data" : "address"},
            {"data" : "identity"},
            {"data" : "model"},
            {"data" : "version"},
            {"data" : "aksi"}
        ],
    })

    $('body').on('click','a[data-aksi="add"]',function(){
        addDevice();
    })

    $('body').on('click','a[data-aksi="discovery"]',function(){
        var device = {
            identity : $(this).attr('data-identity'),
            address : $(this).attr('data-address'),
            version : $(this).attr('data-version'),
            uptime : $(this).attr('data-uptime'),
            platform : $(this).attr('data-platform'),
            board : $(this).attr('data-board'),
            status : $(this).attr('data-status')
        };
        addByDiscovery(device);
    })


    $('body').on('click','a[data-aksi="unifi"]',function(){
        var device = {
            identity : $(this).attr('data-identity'),
            address : $(this).attr('data-address'),
            version : $(this).attr('data-version'),
            uptime : $(this).attr('data-uptime'),
            platform : $(this).attr('data-platform'),
            board : $(this).attr('data-board'),
            status : $(this).attr('data-status')
        };
        addByDiscovery(device);
    })

    $('body').on('click','a[data-aksi="sync"]',function(){
        syncIdentity();
    });

    $('table#tb_devices').on('click','tbody tr',function(){
        var id = $(this).find('td:eq(0)').html();
        var url = '<?php echo site_url('devices/detaildevice')?>';
        var form = $('<form action="' + url + '" method="post">' +
        '<input type="hidden" name="id" value="'+id+'" />' +
        '</form>');
        $('body').append(form);
        form.submit();
    })

    function addDevice(){
        save_method= 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Add Device');
    }

    function addByDiscovery(device){
        var data = device;
        bootbox.confirm('Anda yakin ingin menambahkan device ini ke database ?', function(result){
            if(result){
                $.post('<?php echo site_url('devices/addDeviceByDiscovery/') ?>',data,function(respon){
                if(respon.status){
                    $('#modal_form').modal('hide');
                    reload_table();
                }
                else{ 
                    bootbox.alert('error add this device');
                }
            },'json').fail(function(){
                bootbox.alert('error delete this data');
            })
            }
        });
    }

    function save(){
        bootbox.confirm('Anda yakin ingin menambahkan device ini ke database ?', function(result){
            if(result){
                $('#btnSave').text('saving...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable 
                var url;
            
                if(save_method == 'add') {
                    url = "<?php echo site_url('devices/adddevice')?>";
                }

                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data)
                    {
                        if(data.status) 
                        {
                            $('#modal_form').modal('hide');
                            
                        }
                        reload_table();
                        $('#btnSave').text('save'); 
                        $('#btnSave').attr('disabled',false); 
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Gagal menyimpan data device');
                        $('#btnSave').text('save'); 
                        $('#btnSave').attr('disabled',false); 
                    }
                })
            }
        })
    }

    function reload_table(){
        table.ajax.reload(null,false);
    }
</script>


</body>
</html>