<?php $this->load->view('templates/headersidebar_view'); ?>
</div>
    </div>
    <div class="static-content-wrapper">
        <div class="static-content">
            <div class="page-content">
                <ol class="breadcrumb">
                    <li><a href="index.html">Device</a></li>
                    <li class="active"><a href="#"></a></li>
                </ol>
                <div class="container-fluid">
                <div data-widget-group="group1">
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
                                <a href="#tab-interfaces" role="tab" data-toggle="tab" class="list-group-item"><i class="ti ti-pencil"></i> Interfaces</a>
                            </div>
                        </div><!-- col-sm-3 -->
                        <div class="col-sm-9">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-about">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h2>Device Detail</h2>
                                        </div>
                                        <div class="panel-body">
                                            <div class="about-area">
                                                <div class="table-responsive">
                                                    <table class="table about-table">
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
                                                            <td><?php echo $version?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Location</th>
                                                            <td><?php echo $id_location?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status</th>
                                                            <td><?php echo $status ?></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab-edit">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h2>Edit</h2>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form class="form-horizontal tabular-form">
                                                        <div class="form-group">
                                                            <label for="form-name" class="col-sm-2 control-label">Serial Number</label>
                                                            <div class="col-sm-8 tabular-border">
                                                                <input type="text" class="form-control" id="form-name" value="<?php echo $serial_number;?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="form-name" class="col-sm-2 control-label">Main IP Address</label>
                                                            <div class="col-sm-8 tabular-border">
                                                                <input type="text" class="form-control" id="form-name" value="<?php echo $main_address4; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Location</label>
                                                            <div class="col-sm-8">
                                                                <select name="profile" id="selector2" class="form-control">
                                                                    <option value="">--- Select ---</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </form>	
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <button class="btn-primary btn">Save</button>
                                                    <button class="btn-default btn">Reset</button>
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
                                            <div class="panel-body no-padding">
                                            <table id="tb_devices" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Mac Address</th>
                                                    <th>IP Address v4</th>
                                                    <th>Tx</th>
                                                    <th>Rx</th>
                                                </tr>
                                                <?php if($interfaces != null){
                                                    $i =1;
                                                        foreach($interfaces as $interface){
                                                   ?> 
                                                   <tr>
                                                   <td><? echo $i++.'.'; ?></td> 
                                                   <td><? echo $interface['name']; ?></td> 
                                                   <td><? echo $interface['mac_address']; ?></td> 
                                                   <td><? echo $interface['address']; ?></td> 
                                                   <td><? echo $interface['tx_byte']; ?></td> 
                                                   <td><? echo $interface['rx_byte']; ?></td> 
                                                   </tr>
                                                   <?}
                                                } ?>
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

    $('body').on('click','a[data-aksi="sync"]',function(){
        syncInterfaces();
        syncIP();
        location.reload();
    });

    function syncInterfaces(){
            $.skylo('start');
            var data = {ip : '<? echo $main_address4?>',
                        serial: <? echo $serial_number?>};
            $.post('<?php echo site_url('devices/getInterfaces/') ?>',data,function(respon){
                if(respon.status){
                }
                else{ alert('error delete this data');
                }
            },'json').fail(function(){
                alert('error sync devices data');
            })
            $.skylo('end');
    }

    function syncIP(){
            $.skylo('start');
            var data = {ip : '<? echo $main_address4?>',
                        serial: <? echo $serial_number?>};
            $.post('<?php echo site_url('devices/getIP/') ?>',data,function(respon){
                if(respon.status){
                    // alert('sinkron data interfaces berhasil');
                }
                else{ alert('error delete this data');
                }
            },'json').fail(function(){
                alert('error sync devices data');
            })
            $.skylo('end');
    }

    function reload_table(){
        table.ajax.reload(null,false);
    }
</script>


</body>
</html>