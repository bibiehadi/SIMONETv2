<?php $this->load->view('templates/headersidebar_view'); ?>
</div>
    </div>
    <div class="static-content-wrapper">
        <div class="static-content">
            <div class="page-content">
                <ol class="breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li class="active"><a href="#">Pasar</a></li>
                </ol>
                <div class="container-fluid">
                    <div data-widget-group="group1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h2>Data Tables</h2>
                                        <div class="panel-ctrls"></div>
                                    </div>
                                    <div class="panel-body no-padding">
                                        <div class="col-md-12" style="padding: 15px">
                                            <a class="btn btn-success pull-right" data-aksi="reload" href="javascript:;"><i class="glyphicon glyphicon-plus"></i>Reload</a>
                                        </div>
                                        <table id="tb_aktif" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <!-- <th>ID</th> -->
                                                    <th>Server</th>
                                                    <th>User</th>
                                                    <th>Address</th>
                                                    <th>Mac-Address</th>
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

<?php $this->load->view('templates/footer_view'); ?>
<script type="text/javascript">
    table = $('#tb_aktif').DataTable({
        // "processing" : true,
        // "serverSide" : true,
        // "order" : [],
        "ajax" : {
            "url" : "<?php echo site_url('hotspot/useractiveJSON')?>",
            "type" : "POST"
            // "dataSrc" : ""
        },
        "columns" : [
            // {"data" : "id"},
            {"data" : "server"},
            {"data" : "user"},
            {"data" : "address"},
            {"data" : "mac-address"},
            {"data" : "uptime"},
            {"data" : "bytes-in"},
            {"data" : "bytes-out"},
            {"data" : "aksi"}
        ],
    });
    $('body').on('click','a[data-aksi="reload"]',function(){
        reload_table();
    });
    $('body').on('click','a[data-aksi="hapus"]',function(){
        var id= $(this).attr('data-id');
        deleteUser(id);
    });
    

    function deleteUser(id){
        var data = {id : id};
        if(confirm('Anda yakin ingin menghapus data ini ?')){
            $.post('<?php echo site_url('hotspot/delUserActive/') ?>',data,function(respon){
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