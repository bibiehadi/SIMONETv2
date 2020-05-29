<?php $this->load->view('templates/headersidebar_view'); ?>
</div>
    </div>
    <div class="static-content-wrapper">
        <div class="static-content">
            <div class="page-content">
                <ol class="breadcrumb">
                    <li><a href="index.html">Devices</a></li>
                    <li class="active"><a href="#">List Devices</a></li>
                </ol>
                <div class="container-fluid">
                    <!-- <div data-widget-group="group1"> -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h2>Devices</h2>
                                        <div class="panel-ctrls"></div>
                                        <div class="col-md-12" style="padding: 15px">
                                            <a class="btn btn-success pull-right" data-aksi="add" style="margin-left: 10px;"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="panel-body no-padding">
                                        <table id="tb_devices" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <!-- <th>ID</th> -->
                                                    <th>Serial Number</th>
                                                    <th>Identity</th>
                                                    <th>IP Address</th>
                                                    <th>Version</th>
                                                    <th>Uptime</th>
                                                    <th>Model</th>
                                                    <th>Platform</th>
                                                    <th>Location</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="panel-footer"></div>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div> 
                        <!-- </div>  -->
                    <!-- </div> -->
                <footer role="contentinfo">
                    <div class="clearfix">
                        <ul class="list-unstyled list-inline pull-left">
                            <li><h6 style="margin: 0;">&copy; 2015 Avenxo</h6></li>
                        </ul>
                        <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
                    </div>
                </footer>


<div class="modal fade" id="modal_form" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title">Add User Profile</h4>
            </div>
            <div class="modal-body form">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" id="btnSave" onClick="save()" class="btn btn-success">Save</button>
            </div>
            </div>
    </div>
</div>

<?php $this->load->view('templates/footer_view'); ?>


<script type="text/javascript">
    table = $('#tb_devices').DataTable({
        // "processing" : true,
        // "serverSide" : true,
        "responsive" : true,
        // "order" : [],
        "ajax" : {
            "url" : "<?php echo site_url('devices/devicesJSON')?>",
            "type" : "POST"
            // "dataSrc" : ""
        },
        "columns" : [
            // {"data" : "id"},
            {"data" : "serial_number"},
            {"data" : "identity"},
            {"data" : "main_address4"},
            {"data" : "version"},
            {"data" : "uptime"},
            {"data" : "model"},
            {"data" : "platform"},
            {"data" : "id_location"},
            {"data" : "status"}
        ],
    });

    $('body').on('click','a[data-aksi="add"]',function(){
        addDevice();
    })

    $('body').on('click','a[data-aksi="sync"]',function(){
        syncIdentity();
    });

    $('table#tb_devices').on('click','tbody tr',function(){
        var ip = $(this).find('td:eq(0)').html();
        var url = '<?php echo site_url('devices/detaildevice')?>';
        var form = $('<form action="' + url + '" method="post">' +
        '<input type="hidden" name="serial" value="'+ip+'" />' +
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

    function save(){
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url;
    
        if(save_method == 'add') {
            url = "<?php echo site_url('devices/adddevice')?>";
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
        });
    }

    function reload_table(){
        table.ajax.reload(null,false);
    }
</script>


</body>
</html>