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
                                <a href="#tab-edit" role="tab" data-toggle="tab" class="list-group-item"><i class="ti ti-pencil"></i> Edit</a>
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
                            </div><!-- .tab-content -->
                        </div><!-- col-sm-8 -->
                    </div>
                    <div class="row">
                        <div class="panel panel-default" style="margin : 0px 20px 20px 20px">
                            <div class="panel-body no-padding">
                            <table id="tb_devices" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <tr>
                                    <th>Name</th>
                                    <th>Mac Address</th>
                                    <th>IP Address v4</th>
                                    <th>IP Address v6</th>
                                </tr>
                            </table>
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



<?php $this->load->view('templates/footer_view'); ?>


<script type="text/javascript">

    $('body').on('click','a[data-aksi="add"]',function(){
        addUser();
    })

    $('body').on('click','a[data-aksi="hapus"]',function(){
        var id= $(this).attr('data-id');
        deleteUser(id);
    })

    $('body').on('click','a[data-aksi="sync"]',function(){
        syncProfile();
    });

    $('table#tb_hotspot').on('click','tbody tr',function(){
      var username = $(this).find('td:eq(0)').html()
        location.href='<?php echo site_url()?>/'+username;
    })

    function editHotspot(id){
        save_method = 'update';
        var data = {id : id};
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty(); 


        $.post('<?php echo site_url('hotspot/getUserHotspotByID/') ?>',data,function(respon){
            if(respon){
                $('[name="id"]').val(respon.id);
                $('[name="username"]').val(respon.name);
                $('[name="profile"]').val(respon.profile);
                if(respon.add_mac_cookie){
                    $('[name="cookie"]').val('yes');
                }else{
                    $('[name="cookie"]').val('no');
                }
                $('[name="limit"]').val(respon.rate_limit);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit User Profile');
            }
            else{ alert('error delete this data');
            }
        },'json').fail(function(){
            alert('error get data form ajax');
        })
    }

    function save(){
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url;
    
        if(save_method == 'add') {
            url = "<?php echo site_url('hotspot/adduserhotspot')?>";
        } else {
            url = "<?php echo site_url('hotspot/setuserhotspot')?>";
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
                    syncProfile();
                }
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal menyimpan user profile');
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            }
        });
    }

    function deleteUser(id){
        var data = {id : id};
        if(confirm('Anda yakin ingin menghapus data ini ?')){
            $.post('<?php echo site_url('hotspot/delUserHotspot/') ?>',data,function(respon){
                if(respon.status){
                    reload_table();
                }
                else{ alert('error delete this data');
                }
            },'json').fail(function(){
                alert('error delete this data');
            })
        }
    }

    function reload_table(){
        table.ajax.reload(null,false);
    }
</script>


</body>
</html>