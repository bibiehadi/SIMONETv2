<?php $this->load->view('Templates/headersidebar_view'); ?>
</div>
    </div>
    <div class="static-content-wrapper">
        <div class="static-content">
            <div class="page-content">
                <ol class="breadcrumb">
                    <li><a href="index.html">Hotspot</a></li>
                    <li class="active"><a href="#">User Hotspot</a></li>
                </ol>
                <div class="container-fluid">
                    <div data-widget-group="group1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h2>Data User Hotspot</h2>
                                        <a class="btn btn-success pull-right" data-aksi="add" style="margin : 10px 10px 0px 10px"><i class="fa fa-plus"></i></a>
                                        <a class="btn btn-info pull-right" data-aksi="sync" href="javascript:;" style="margin : 10px 10px"><i class="fa fa-refresh"></i> Refresh</a>
                                    </div>
                                    <div class="panel-body">
                                        <table id="tb_hotspot" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <!-- <th>ID</th> -->
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                    <th>Profile</th>
                                                    <th>Uptime</th>
                                                    <th>Bytes-In</th>
                                                    <th>Bytes-Out</th>
                                                    <th>Action</th>
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
                    </div>
                </div> <!-- .container-fluid -->
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
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        <input type="input" name="name" class="form-control" placeholder='User Hotspot Name' required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" name="password" class="form-control" placeholder='Enter the password' required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        <select name="profile" id="selector2" class="form-control">
                            <option value="">--- Select ---</option>
                            <?php foreach ($profile as $row) : ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name'];?></option>
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

<?php $this->load->view('Templates/footer_view'); ?>


<script type="text/javascript">
    table = $('#tb_hotspot').DataTable({
        responsive : true,
        oLanguage: {
        "sLengthMenu": " _MENU_ ",
        "sSearch": "Search..."
        },
        ajax : {
            "url" : "<?php echo site_url('hotspot/userhotspotJSON')?>",
            "type" : "POST"
            // "dataSrc" : ""
        },
        columns : [
            // {"data" : "id"},
            {"data" : "name"},
            {"data" : "password"},
            {"data" : "profile"},
            {"data" : "uptime"},
            {"data" : "bytes_in"},
            {"data" : "bytes_out"},
            {"data" : "aksi"}
        ],
    });

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
        var username = $(this).find('td:eq(0)').html();
        var res = username.split("@",1);
        // location.href='<?php echo site_url('hotspot/userhotspotdetail')?>/'+res;
        
        // var id= $(this).attr('data-id');
        var url = '<?php echo site_url('hotspot/userhotspotdetail')?>';
        var form = $('<form action="' + url + '" method="post">' +
        '<input type="hidden" name="name" value="'+username+'" />' +
        '</form>');
        $('body').append(form);
        form.submit();
    })

    function addUser(){
        save_method= 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Add User Profile');
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

    function syncProfile(){
        $.skylo('start');
        $.ajax({
            url: "<?php echo site_url('hotspot/syncUserHotspot/') ?>",
            type: "POST",
            dataType: "JSON",
            success: function(data){
                reload_table();
                $.skylo('end');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error!!');
            }
        })
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