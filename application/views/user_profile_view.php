<?php $this->load->view('templates/headersidebar_view'); ?>
</div>
    </div>
    <div class="static-content-wrapper">
        <div class="static-content">
            <div class="page-content">
                <ol class="breadcrumb">
                    <li><a href="#">Hotspot</a></li>
                    <li class="active"><a href="#">User Profile</a></li>
                </ol>
                <div class="container-fluid">
                    <div data-widget-group="group1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h2>Data User Profile</h2>
                                        <div class="panel-ctrls"></div>
                                        
                                    </div>
                                    <div class="panel-body no-padding">
                                        <div class="col-md-12" style="padding: 15px">
                                            <a class="btn btn-success pull-right" data-aksi="add" style="margin-left: 10px;"><i class="glyphicon glyphicon-plus"></i>Add</a>
                                            <a class="btn btn-success pull-right" data-aksi="sync" href="javascript:;"><i class="glyphicon glyphicon-plus"></i>Resync</a>
                                        </div>
                                        <table id="tb_profile" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <!-- <th>ID</th> -->
                                                    <th>Name</th>
                                                    <th>Session-Timeout</th>
                                                    <th>Status-AutoRefresh</th>
                                                    <th>Shared-Users</th>
                                                    <th>Add-Mac-Cookie</th>
                                                    <th>Rate-Limit</th>
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
                        </div> <!-- #page-content -->
                    </div>
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
            <form id="form" action="＃" method="post">
                <input type="hidden" value="" name="id"/> 
                <div class="form-group">
                    <label class="control-label">Name</label>
                    <input type="input" name="name" class="form-control" placeholder='User Profile Name' require>
                </div>
                <div class="form-group">
                    <label class="control-label">Session-Timeout</label>
                    <input type="input" name="session" class="form-control" placeholder='example : 1d 1h12m12s'>
                </div>
                <div class="form-group">
                    <label class="control-label">Status-AutoRefresh</label>
                    <input type="input" name="autorefresh" class="form-control" placeholder='example : 1d 1h12m12s'>
                </div>
                <div class="form-group">
                    <label class="control-label">Shared-Users</label>
                    <input type="input" name="shared" class="form-control" placeholder=''>
                </div>
                <div class="form-group">
                    <label class="control-label">Add-Mac-Cookie</label>
                    <select name="pasar" id="selector2" class="form-control">
                        <option value="">--- Select ---</option>
                        <option value="true">True</option>
                        <option value="false">False</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Rate-Limit</label>
                    <input type="input" name="limit" class="form-control" placeholder='5M/5M'>
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
    table = $('#tb_profile').DataTable({
        // "processing" : true,
        // "serverSide" : true,
        // "order" : [],
        "ajax" : {
            "url" : "<?php echo site_url('hotspot/userprofileJSON')?>",
            "type" : "POST"
            // "dataSrc" : ""
        },
        "columns" : [
            // {"data" : "id"},
            {"data" : "name"},
            {"data" : "session_timeout"},
            {"data" : "status_autorefresh"},
            {"data" : "shared_users"},
            {"data" : "add_mac_cookie"},
            {"data" : "rate_limit"},
            {"data" : "aksi"}
        ],
    });

    $('body').on('click','a[data-aksi="add"]',function(){
        addProfile();
    })
    
    $('body').on('click','a[data-aksi="sync"]',function(){
        syncProfile();
    })

    $('body').on('click','a[data-aksi="hapus"]',function(){
        var id= $(this).attr('data-id');
        deleteUser(id);
    });

    function addProfile(){
        // save_method= 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        // $('.modal-title').text('Add Data Pasar');
    }

    function syncProfile(){
            $.ajax({
                url: "<?php echo site_url('hotspot/syncUserProfile/') ?>",
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert('Error!!');
                }
            })
    }

    function deleteUser(id){
        var data = {id : id};
        if(confirm('Anda yakin ingin menghapus data ini ?')){
            $.post('<?php echo site_url('hotspot/delUserProfile/') ?>',data,function(respon){
                if(respon.status){
                    reload_table();
                }
                else{ alert('error delete this data');
                }
            },'json').fail(function(){
                alert('error delete this data');
            })
            // $.ajax({
            //     url: "<?php echo site_url('hotspot/delUserProfile/') ?>"+id,
            //     type: "POST",
            //     dataType: "JSON",
            //     success: function(data){
            //         alert(id);
            //         reload_table();
            //     },
            //     error: function (jqXHR, textStatus, errorThrown){
            //         alert('Error menghapus data');
            //     }
            // })
        }
    }

    function reload_table(){
        table.ajax.reload(null,false);
    }
</script>


</body>
</html>