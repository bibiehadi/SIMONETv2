<?php $this->load->view('Templates/headersidebar_view'); ?>
</div>
    </div>
    <div class="static-content-wrapper">
        <div class="static-content">
            <div class="page-content" style="margin-top : 20px">
                <div class="container-fluid">
                <div data-widget-group="group1">
                <?php echo $this->session->flashdata('detail_device') ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="panel panel-profile">
                                <div class="panel-body" style="margin-bottom : 0px">
                                    <? if($platform == "UniFi"){?> 
                                        <img src="<?php echo base_url('assets/img/unifi.png')?>" class="img-circle" style="width : 150px; ">
                                    <?}elseif($platform == "MikroTik" || $platform == "MikroTik Switch") {?>
                                        <img src="<?php echo base_url('assets/img/rb.png')?>" class="img-circle" style="width : 150px; ">
                                    <?}else{?>
                                        <!-- <img src="<?php echo base_url('assets/img/unifi.png')?>" class="img-circle" style="width : 150px; "> -->
                                    <?}?> 
                                        <div class="name"><?php echo $identity;?></div>
                                        <div class="info"><?php echo $platform." ".$model;?></div>
                                    <? if($platform == "MikroTik" && $status == 'Connected'){?> 
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
                                                <div class="info">Voltage : </div> 
                                                <p id="volt"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info">Temperature : </div> 
                                                <p id="temp"></p>
                                            </div>
                                        </div>
                                    <? } ?>
                                </div>
                            </div><!-- panel -->
                            <div class="list-group list-group-alternate mb-n nav nav-tabs">
                                <a href="#tab-about" role="tab" data-toggle="tab" class="list-group-item active"><i class="fa fa-user"></i> Detail Device</a>
                                <?php if($status == 'Connected' && ($platform == 'MikroTik' || $platform == 'UniFi')){?>
                                    <a href="#tab-interfaces" role="tab" data-toggle="tab" class="list-group-item"><i class="fa fa-pencil"></i> Interfaces</a>
                                <?}?>
                            </div>
                        </div><!-- col-sm-3 -->
                        <div class="col-sm-9">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-about">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-md-6" >
                                                    <h2>Detail Device</h2>
                                                    <form class="form-inline" action="<?php echo site_url('devices/detaildevice');?>" method="post" id="deviceForm" style="">
                                                        <select name="serial" id="device" class="custom-select custom-select-sm" style="width: 120px;color: #03a9f4; border: 0px; outline: 0px; background: #fafafa; margin-left :10px">
                                                            <?php foreach ($list_devices as $row) {
                                                                if($row['serial_number'] == $serial_number){?>
                                                                    <option selected value="<?php echo $row['serial_number']; ?> "><?php echo $row['identity'];?></option>
                                                                <?} else { ?>
                                                                    <option value="<?php echo $row['serial_number']; ?>"><?php echo $row['identity'];?></option>
                                                            <?php } 
                                                            } ?>
                                                        </select>
                                                    </form>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php if($status == 'Connected' && ($platform == 'MikroTik' || $platform == 'UniFi')){?>
                                                        <a class="btn btn-warning pull-right" data-aksi="reboot" href="javascript:;" style="margin: 10px 20px 10px 0px">Reboot</a>
                                                    <? }?>
                                                    <a href="#tab-edit" role="tab" data-toggle="tab" class="btn btn-primary pull-right" style="margin: 10px 10px 10px 0px"><i class="fa fa-pencil-square-o"></i></a>
                                                    <a class="btn btn-danger pull-right" data-aksi="remove" href="javascript:;" style="margin: 10px"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="about-area">
                                                <!-- <div class="table-responsive"> -->
                                                    <table class="table table-striped table-responsive nowrap" cellspacing="0" width="100%">
                                                        <tbody>
                                                        <tr>
                                                            <th>Serial Number</th>
                                                            <td><?php echo $serial_number;?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Identity</th>
                                                            <td><?php echo $identity?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Main IP Address</th>
                                                            <td><?php echo $address ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mac-Address</th>
                                                            <td><?php echo $mac_address ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Version</th>
                                                            <td><?php echo $version?>
                                                            <? $_version = explode(' ',$version); 
                                                                $_last_ros = explode(' ',$last_ros); 
                                                             if(($_last_ros[0] > $_version[0]) && ($status == 'Connected') && ($platform == 'MikroTik')) {
                                                                ?>
                                                                <a class="btn" data-aksi="updateROS" href="javascript:;">
                                                                <i class="fa fa-chevron-circle-up"  style="color : #03a9f4"></i>
                                                                </a>
                                                             <?}?>
                                                             </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Uptime</th>
                                                            <td><?php echo $uptime?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Location</th>
                                                            <? foreach($location as $loc){ 
                                                                if ($loc['id'] == $id_location) {?>
                                                                    <td><? echo $loc['nama'];?></td>
                                                                <? }
                                                                } ?>
                                                        </tr>
                                                        <tr>
                                                            <th>Status</th>
                                                            <? if($status == 'Connected'){ ?>
                                                                <td> <span class="label label-primary">Connected</span> </td>
                                                            <? }elseif ($status == 'Disconnected') { ?>
                                                                <td> <span class="label label-danger">Disconnected </span> </td>
                                                            <? }elseif ($status == 'Reboot') { ?>
                                                                <td> <span class="label label-warning">Reboot </span> </td>
                                                            <? } ?>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab-edit">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h2><a href="#tab-about" role="tab" data-toggle="tab" style="color : #9e9e9e"><i class="fa fa-chevron-left" aria-hidden="true" ></i>Back</a> <h2>
                                            <!-- <h2>Edit</h2> -->
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form class="form-horizontal tabular-form" id="editDevice">
                                                        <div class="form-group">
                                                            <label for="form-serial" class="col-sm-2 control-label">Serial Number</label>
                                                            <div class="col-sm-8 tabular-border">
                                                                <input type="text" class="form-control" name="serial" id="form-serial" value="<?php echo $serial_number;?>" readonly>
                                                            </div>
                                                        </div>
                                                        <?php if($status == 'Connected' && $platform == 'MikroTik'){?>
                                                        <div class="form-group">
                                                            <label for="form-identity" class="col-sm-2 control-label">Identity</label>
                                                            <div class="col-sm-8 tabular-border">
                                                                <input type="text" class="form-control" name="identity" id="identity" value="<?php echo $identity;?>">
                                                            </div>
                                                        </div>
                                                        <?}?>
                                                        <div class="form-group">
                                                            <label for="form-address" class="col-sm-2 control-label">Main IP Address</label>
                                                            <div class="col-sm-8 tabular-border">
                                                                <input type="text" class="form-control" name="address" id="form-address" value="<?php echo $address; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Master Devices</label>
                                                            <div class="col-sm-8">
                                                                <select name="masterdevice" id="masterdevice" class="form-control">
                                                                    <option value="">--- Select ---</option>
                                                                    <? foreach($list_devices as $device){ 
                                                                        if ($device['serial_number'] == $id_device) {?>
                                                                            <option selected value="<? echo $device['serial_number']; ?>"><? echo $device['identity'];?></option>
                                                                        <? }else{ ?>
                                                                            <option value="<? echo $device['serial_number']; ?>"><? echo $device['identity'];?></option>
                                                                    <? } 
                                                                    }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Location</label>
                                                            <div class="col-sm-8">
                                                                <select name="location" id="location" class="form-control">
                                                                    <option value="">--- Select ---</option>
                                                                    <? foreach($location as $loc){ 
                                                                        if ($loc['id'] == $id_location) {?>
                                                                            <option selected value="<? echo $loc['id']; ?>"><? echo $loc['nama'];?></option>
                                                                        <? }else{ ?>
                                                                            <option value="<? echo $loc['id']; ?>"><? echo $loc['nama'];?></option>
                                                                    <? } 
                                                                    }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </form>	
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-offset-2 pull-right" style="margin: 20px 20px 0px 0px">
                                                       <button id="btnSave" class="btn-primary btn" onclick="save()">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-interfaces">
                                    <div class="row">
                                        <div class="panel panel-default" style="margin : 0px 20px 20px 20px">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-md-4" >
                                                        <h2>Interfaces</h2>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <?php if($status == 'Connected' && $platform == 'MikroTik'){?>
                                                        <a class="btn btn-info pull-right" data-aksi="sync" href="javascript:;" style="margin: 10px"><i class="fa fa-refresh"></i></a>
                                                        <? }?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body ">
                                            <table id="tb_interfaces" class="table table-hover" cellspacing="0" width="100%" style="margin 5px">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Name</th>
                                                        <th>Mac Address</th>
                                                        <th>IP Address v4</th>
                                                        <th>Tx</th>
                                                        <th>Rx</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .tab-content -->
                        </div><!-- col-sm-8 -->
                    </div>
                    <div class="row">
                        <div class="panel panel-default" style="margin : 0px 20px 20px 20px">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-4" >
                                        <h2>Device Dibawahnya</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body ">
                            <table id="tb_subdevices" class="table table-hover table-responsive" cellspacing="0" width="100%" style="margin 5px">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>IP Address</th>
                                        <th>Serial Number</th>
                                        <th>Model</th>
                                        <th>Platform</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($subdevices as $device){ ?> 
                                        <tr>
                                        <td><?echo $device['identity']?></td>
                                        <td><?echo $device['address']?></td>
                                        <td><?echo $device['serial_number']?></td>
                                        <td><?echo $device['model']?></td>
                                        <td><?echo $device['platform']?></td>
                                        <td><?echo $device['status']?></td>
                                        </tr>
                                    <? }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <footer role="contentinfo">
                    <div class="clearfix">
                        <ul class="list-unstyled list-inline pull-left">
                            <li><h6 style="margin: 0;">&copy; 2015 Avenxo</h6></li>
                        </ul>
                        <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
                    </div>
                </footer>

<div class="modal fade" id="modal_interface" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title">Add Device</h4>
            </div>
            <div class="modal-body form">
                <div class="tab-container tab-default">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#Statistic" data-toggle="tab">Interface Statistic</a>
                        </li>
                        <li>
                            <a href="#SetInterface" data-toggle="tab">Set Intreface Name</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="Statistic">
                        <div class="panel panel-bluegray" data-widget='{"id" : "wiget9", "draggable": "false"}'>
                            <div class="panel-body">
                                <div class="mychart" id="chart" style="height: 272px;" class="mt-sm mb-sm"></div>
                            </div>
                        </div>
                        </div>
                        <div class="tab-pane" id="SetInterface">
                            <form id="setInterface" action="＃" method="post" class="form-horizontal row-border">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">SerialNumber</label>
                                    <div class="col-sm-8">
                                        <input type="input" name="serial" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ID</label>
                                    <div class="col-sm-8">
                                        <input type="input" name="id" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-8">
                                        <input type="input" name="name" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Mac-Address</label>
                                    <div class="col-sm-8">
                                        <input type="input" name="mac" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">IP Address</label>
                                    <div class="col-sm-8">
                                        <input type="input" name="address" class="form-control" readonly>
                                    </div>
                                </div>
                            </form>
                            <button type="submit" id="btnSave" onClick="saveInterface()" class="btn btn-success pull-right" style="margin: 10px 0px 0px 0px">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('Templates/footer_view'); ?>


<script type="text/javascript">
    if('<? echo $platform?>' == 'MikroTik'){
        getResource();
    }

    var table = $('#tb_interfaces').DataTable({
        responsive : true,
        oLanguage: {
        "sLengthMenu": " _MENU_ ",
        "sSearch": "<span>Search..</span> _INPUT_"
        },
        ajax : {
            "url" : "<?php echo site_url('devices/getinterfacesJSON/').$serial_number?>",
            "type" : "POST"
            // "dataSrc" : ""
        },
        columns : [
            {"data" : "id_interface"},
            {"data" : "name"},
            {"data" : "mac_address"},
            {"data" : "address"},
            {"data" : "tx_byte"},
            {"data" : "rx_byte"}
        ],
    });

    $('body').on('click','a[data-aksi="reboot"]',function(){
        rebootDevice();
    });

    $('#device').change(function(){
        $.skylo('start');
        $('#deviceForm').submit();
        $.skylo('end');
    })

    $('body').on('click','a[data-aksi="updateROS"]',function(){
        updateSystem();
    });

    $('body').on('click','a[data-aksi="remove"]',function(){
        removeDevice();
    });
    
    $('body').on('click','a[data-aksi="sync"]',function(){
        syncInterfaces();
    });

    $('table#tb_subdevices').on('click','tbody tr',function(){
        var serial = $(this).find('td:eq(2)').html();
        var url = '<?php echo site_url('devices/detaildevice')?>';
        var form = $('<form action="' + url + '" method="post">' +
        '<input type="hidden" name="serial" value="'+serial+'" />' +
        '</form>');
        $('body').append(form);
        form.submit();
    })

    $('table#tb_interfaces').on('click','tbody tr',function(){
        var platform = '<? echo $platform ?>';
        if(platform == 'MikroTik'){
            var data = {
                id : $(this).find('td:eq(0)').html(),
                name : $(this).find('td:eq(1)').html(),
                mac : $(this).find('td:eq(2)').html(),
                address : $(this).find('td:eq(3)').html(),
            };
            // chartData.abort();
            clearInterval(interval);
            tx=[], rx=[], point=[];
            editInterface(data);
        }
    })

    // getInterfaceName();
    function getInterfaceName(){
        $('table#tb_interfaces tbody').each(function(data,a){
            console.log(a);
            console.log($(this).find('td:eq(1)').html());
        })
    }

    function editInterface(data){
        var data = data;
        $('#setInterface')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty(); 
        //tab-edit
        $('[name="serial"]').val('<? echo $serial_number; ?>');
        $('[name="id"]').val(data.id);
        $('[name="name"]').val(data.name);
        $('[name="mac"]').val(data.mac);
        $('[name="address"]').val(data.address);
        interfaceChart(data.name);
        $('#modal_interface').modal('show');
        $('.modal-title').text(data.name);
    }

    function getResource(ether){
        var url = "<?php echo site_url('devices/getResource')?>";

        $.ajax({
            url : url,
            type: "POST",
            data: {ip : '<?php echo $address?>'},
            dataType: "JSON",
            success: function(data)
            {
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

    function syncInterfaces(){
            $.skylo('start');
            var data = {ip : '<? echo $address; ?>',
                        serial: '<? echo $serial_number; ?>'};
            $.post('<?php echo site_url('devices/getinterfacesAPI/') ?>',data,function(respon){
                if(respon.status){
                    syncIP();
                    $.skylo('end');
                }
                else{ 
                    alert('error delete this data');
                    $.skylo('end');
                }
            },'json').fail(function(){
                alert('error sync devices data');
            })
    }

    function syncIP(){
            var data = {ip : '<? echo $address?>',
                        serial: '<? echo $serial_number?>'};
            $.post('<?php echo site_url('devices/getIP/') ?>',data,function(respon){
                if(respon.status){
                    // alert('sinkron data interfaces berhasil');
                    reload_table();
                }
                else{ alert('error delete this data');
                }
            },'json').fail(function(){
                alert('error sync devices data');
            })
    }

    function rebootDevice(){
        $.skylo('start');
        if('<? echo $platform ?>' == 'MikroTik'){
            var data = { ip : '<? echo $address ?>',
                        identity : '<? echo $identity; ?>'};
            var url = '<?php echo site_url('devices/reboot/') ?>';
        }else if('<? echo $platform ?>' == 'UniFi'){
            var data = {mac : '<? echo $mac_address?>',
                    identity : '<? echo $identity; ?>'};
            var url = '<?php echo site_url('devices/rebootUniFi/') ?>';
        }
        if(confirm('Anda yakin ingin mereboot device ini ?')){
            $.post(url,data,function(respon){
                if(respon.status){
                    location.href='<?php echo site_url('devices')?>/';
                    $.skylo('end');
                }
                else{ 
                    alert('error reboot this device');
                    $.skylo('end');
                }
            },'json').fail(function(){
                alert('error reboot this device');
            })
        }
    }

    function updateSystem(){
        var data = {ip : '<?echo $address?>'};
        bootbox.confirm('Anda yakin ingin mengupdate RouterOS device ini ?', function(result){
            if(result){
                var dialog = bootbox.dialog({
                    title: 'Check Router OS',
                    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
                });
                            
                var xhr = $.post('<?php echo site_url('devices/downloadMikroTikOS/') ?>',data,function(respon){
                    if(respon.status){
                        dialog.find('.bootbox-body').html('<pre>'+ respon.message);
                        console.log(respon.message);
                        // $.skylo('end');
                    }
                    else{ alert('error delete this data');
                        dialog.find('.bootbox-body').html('Gagal Melakukan Update RouterOS');
                    }
                },'json').fail(function(){
                    alert('error delete this data');
                })
                setTimeout(() => {
                    xhr.abort();
                }, 60000);
            }
        })
    }

    function removeDevice(){
        $.skylo('start');
        loading = bootbox.dialog({ 
            message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Loading...</div>', 
            closeButton: false 
        })
        var data = {serial : '<? echo $serial_number; ?>',
                    identity : '<? echo $identity; ?>'};
        if(confirm('Anda yakin ingin menghapus data ini ?')){
            $.post('<?php echo site_url('devices/delDevice/') ?>',data,function(respon){
                if(respon.status){
                    loading.modal('hide');
                    location.href='<?php echo site_url('devices')?>/';
                    $.skylo('end');
                }
                else{ alert('error delete this data');
                }
            },'json').fail(function(){
                alert('error delete this data');
            })
        }
    }

    function save(){
        $.skylo('start');
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url = "<?php echo site_url('devices/setDevice')?>";

        $.ajax({
            url : url,
            type: "POST",
            data: $('#editDevice').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) 
                {
                    location.reload();
                }
                $.skylo('end');
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal menyimpan data device');
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            }
        });
    }

    function saveInterface(){
        var ip = '<? echo $address?>';
        $.skylo('start');
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url = "<?php echo site_url('devices/setInterface/')?>"+ip;

        $.ajax({
            url : url,
            type: "POST",
            data: $('#setInterface').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) 
                {
                    alert('success');
                    reload_table();
                }
                $.skylo('end');
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
                $('#modal_interface').modal('hide');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal menyimpan data device');
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
                $('#modal_interface').modal('hide');
            }
        });
    }

    function reload_table(){
        table.ajax.reload(null,false);
    }
    var charts = {};
	var chart;
    var tx = [], rx = [], point = [];
    var chartData;
    var interval;
    function requestData(iface){
		chartData = $.ajax({
			url: '<?php echo site_url("devices/getinterfacechart");?>',     						
			type: "POST",
			dataType: "JSON",
            data: {iface:iface,
            ip : '<? echo $address ?>'} ,
			success: function(data) {	
                if (tx.length == 10) {
					tx.shift();
					rx.shift();
					point.shift();
				}
				tx.push(parseInt(data.data['tx']));	
				rx.push(parseInt(data.data['rx']));
				point.push(data.data['point']);

				charts[0].xAxis[0].setCategories(point);
				charts[0].series[0].setData(tx);
				charts[0].series[1].setData(rx);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
			  console.error("Status: " + textStatus + " request: " + XMLHttpRequest); console.error("Error: " + errorThrown); 
			}       
		});
		
	}

	function interfaceChart(interface) { 
			charts[0] = new Highcharts.Chart({
			chart: {
				renderTo: 'chart',
		  		animation: Highcharts.svg,
				type: 'areaspline',
				// zoomType: 'x',
				events: {
					load: function () {
					interval = setInterval(function () {
						requestData(interface);
					}, 10000);
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
</script>


</body>
</html>