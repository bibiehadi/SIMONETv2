<?php $this->load->view('templates/headersidebar_view'); ?>
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
                                <div class="panel-body">
                                    <img src="<?php echo base_url('assets/img/anu.png')?>" class="img-circle" style="width : 150px; border: solid">
                                    <div class="name"><?php echo $identity;?></div>
                                    <div class="info"><?php echo $platform;?></div>
                                </div>
                            </div><!-- panel -->
                            <div class="list-group list-group-alternate mb-n nav nav-tabs">
                                <a href="#tab-about" role="tab" data-toggle="tab" class="list-group-item active"><i class="ti ti-user"></i> Detail Device</a>
                                <?php if($status == 'Connected' && $platform == 'MikroTik'){?>
                                    <a href="#tab-interfaces" role="tab" data-toggle="tab" class="list-group-item"><i class="ti ti-pencil"></i> Interfaces</a>
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
                                                        <select name="id" id="device" class="custom-select custom-select-sm" style="width: 120px;color: #03a9f4; border: 0px; outline: 0px; background: #fafafa; margin-left :10px">
                                                            <?php foreach ($list_devices as $row) {
                                                                if($row['id'] == $id){?>
                                                                    <option selected value="<?php echo $row['id']; ?> "><?php echo $row['identity'];?></option>
                                                                <?} else { ?>
                                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['identity'];?></option>
                                                            <?php } 
                                                            } ?>
                                                        </select>
                                                    </form>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php if($status == 'Connected' && $platform == 'MikroTik'){?>
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
                                                            <td><?php echo $main_address4 ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Version</th>
                                                            <td><?php echo $version?><a class="btn" data-aksi="update" href="javascript:;"><i class="fa fa-chevron-circle-up"  style="color : blue"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Uptime</th>
                                                            <td><?php echo $uptime?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Location</th>
                                                            <td><?php echo $id_location?></td>
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
                                                            <label for="form-serial" class="col-sm-2 control-label">ID Device</label>
                                                            <div class="col-sm-8 tabular-border">
                                                                <input type="text" class="form-control" name="id" id="form-serial" value="<?php echo $id;?>" readonly>
                                                            </div>
                                                        </div>
                                                        <?php if($status == 'Connected' && $platform == 'MikroTik'){?>
                                                        <div class="form-group">
                                                            <label for="form-serial" class="col-sm-2 control-label">Identity</label>
                                                            <div class="col-sm-8 tabular-border">
                                                                <input type="text" class="form-control" name="identity" id="identity" value="<?php echo $identity;?>">
                                                            </div>
                                                        </div>
                                                        <?}?>
                                                        <div class="form-group">
                                                            <label for="form-serial" class="col-sm-2 control-label">Serial Number</label>
                                                            <div class="col-sm-8 tabular-border">
                                                                <input type="text" class="form-control" name="serial" id="form-serial" value="<?php echo $serial_number;?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="form-address" class="col-sm-2 control-label">Main IP Address</label>
                                                            <div class="col-sm-8 tabular-border">
                                                                <input type="text" class="form-control" name="address" id="form-address" value="<?php echo $main_address4; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Location</label>
                                                            <div class="col-sm-8">
                                                                <select name="location" id="location" class="form-control">
                                                                    <option value="">--- Select ---</option>
                                                                    <? foreach($location as $loc){ 
                                                                        if ($loc['id'] == $id_location) {?>
                                                                            <option selected value="<? echo $loc['id']; ?>"><? echo $loc['name'];?></option>
                                                                        <? }else{ ?>
                                                                            <option value="<? echo $loc['id']; ?>"><? echo $loc['name'];?></option>
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
                                                        <?php if($status == 'Connected'){?>
                                                        <a class="btn btn-info pull-right" data-aksi="sync" href="javascript:;" style="margin: 10px"><i class="fa fa-refresh"></i></a>
                                                        <? }?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body ">
                                            <table id="tb_interfaces" class="table table-striped table-bordered" cellspacing="0" width="100%" style="margin 5px">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Mac Address</th>
                                                        <th>IP Address v4</th>
                                                        <th>Tx</th>
                                                        <th>Rx</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <?php if($interfaces != null){
                                                        $i =1;
                                                            foreach($interfaces as $interface){
                                                    ?> 
                                                    <tr>
                                                    <td><? echo $i++.'.'; ?></td> 
                                                    <td><? echo $interface['name']; ?></td> 
                                                    <td><? echo $interface['mac_address']; ?></td> 
                                                    <td><? echo $interface['address']; ?></td> 
                                                    <td><? echo byte_format($interface['tx_byte']); ?></td> 
                                                    <td><? echo byte_format($interface['rx_byte']); ?></td> 
                                                    </tr>
                                                    <?}
                                                    } ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .tab-content -->
                        </div><!-- col-sm-8 -->
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



<?php $this->load->view('templates/footer_view'); ?>


<script type="text/javascript">
    $('#tb_interfaces').DataTable({
        responsive : true,
        oLanguage: {
        "sLengthMenu": " _MENU_ ",
        "sSearch": "Search..."
        }
    });

    $('body').on('click','a[data-aksi="reboot"]',function(){
        rebootDevice('<? echo $main_address4; ?>');
    });

    $('#device').change(function(){
        $.skylo('start');
        $('#deviceForm').submit();
        $.skylo('end');
    })

    $('body').on('click','a[data-aksi="update"]',function(){
        updateSystem();
    });

    $('body').on('click','a[data-aksi="remove"]',function(){
        removeDevice(<? echo $id; ?>);
    });
    
    $('body').on('click','a[data-aksi="sync"]',function(){
        syncInterfaces();
    });

    function syncInterfaces(){
            $.skylo('start');
            var data = {ip : '<? echo $main_address4; ?>',
                        id: <? echo $id; ?>};
            $.post('<?php echo site_url('devices/getInterfaces/') ?>',data,function(respon){
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
            var data = {ip : '<? echo $main_address4?>',
                        id: <? echo $id?>};
            $.post('<?php echo site_url('devices/getIP/') ?>',data,function(respon){
                if(respon.status){
                    // alert('sinkron data interfaces berhasil');
                    location.reload();
                }
                else{ alert('error delete this data');
                }
            },'json').fail(function(){
                alert('error sync devices data');
            })
    }

    function rebootDevice(ip){
        $.skylo('start');
        var data = {ip : ip,
                    identity : '<? echo $identity; ?>'};
        if(confirm('Anda yakin ingin mereboot device ini ?')){
            $.post('<?php echo site_url('devices/reboot/') ?>',data,function(respon){
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
        var data = {ip : '<?echo $main_address4?>'};
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

    function removeDevice(id){
        $.skylo('start');
        loading = bootbox.dialog({ 
            message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Loading...</div>', 
            closeButton: false 
        })
        var data = {id : id,
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

    // function formatBytes(bytes, decimals = 2) {
    //     if (bytes === 0) return '0 Bytes';

    //     const k = 1024;
    //     const dm = decimals < 0 ? 0 : decimals;
    //     const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    //     const i = Math.floor(Math.log(bytes) / Math.log(k));

    //     return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    // }
</script>


</body>
</html>