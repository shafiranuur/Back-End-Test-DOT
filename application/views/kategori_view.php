<div class="content-wrapper">
	<section class="content-header">
          <h1>
            Data Master
            <small></small>
        </h1>
        </section>

    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#insert" style="margin-left: 40px;margin-top:30px;margin-bottom:10px"">Insert Kategori</a>

   <div class="notif" style="margin-left: 30px;margin-right: 30px">
            <?php
                $notif1 = $this->session->flashdata('notif1');
                $notif2 = $this->session->flashdata('notif2');
                if ($notif1!=NULL) {
                    echo '
                        <div class="alert alert-success">'.$notif1.'</div>
                    ';                                                                                                                                              
                } else if ($notif2!=NULL) {
                    echo '
                        <div class="alert alert-danger">'.$notif2.'</div>
                    ';   
                }
              ?>        
</div>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Data Kategori</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">No.</th>
                  <th style="width: 200px">Kategori</th>
                  
                </tr>
                <?php
                    $i=1;
                    foreach ($data as $u) {
                     echo '
                    <tr class="odd gradeX">
                        <td>'.$i.'</td>
                        <td>'.$u->nama_kategori.'</td>
                        
                        <td>
                        <a href="#" onclick="prepare_update('.$u->id_kategori.')" class="btn btn-warning" data-toggle="modal" data-target="#edit">Edit</a>
                        <a href="'.base_url().'index.php/home/delete_kategori/'.$u->id_kategori.'" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                ';
                     $i++;   
                    }
                ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div> 
    </section>
</div>

<div class="modal fade" id="insert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <form action="<?php echo base_url('index.php/home/insert_kategori'); ?>" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Insert Kategori</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <input type="text" class="form-control" name="insert_kategori">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" name="submit" class="btn btn-primary">INSERT</button>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <form action="<?php echo base_url('index.php/home/edit_kategori'); ?>" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Kategori</h4>
                                        </div>
                                        <div class="modal-body">
                                        <input type="hidden" name="edit_id_kategori" id="edit_id_kategori">
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <input type="text" class="form-control" name="edit_kategori" id="edit_kategori" required>
                                            </div>                                           
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" name="submit" class="btn btn-primary">SAVE</button>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <script type="text/javascript">
                                function prepare_update(id) {
                                    $('#edit_id_kategori').val();
                                    $('#edit_kategori').val();
                                
                                    $.getJSON("<?php echo base_url('index.php/home/get_kategori_by_id/')?>"+ id, function (data) {
                                        $('#edit_id_kategori').val(data.id_kategori);
                                        $('#edit_kategori').val(data.nama_kategori);
                                    });
                                }
                            </script>