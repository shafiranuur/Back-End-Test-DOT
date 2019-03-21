
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
       <section class="content-header">
          <h1>
            Data Master
            <small></small>
        </h1>
        </section>

    <!-- Main content -->
<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="margin-left: 40px;margin-top:30px;margin-bottom:10px"">Insert Admin</a>
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
              <h3 class="box-title">Data Admin</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">No.</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Level</th>
                  <th>Action</th>
                </tr>
                <?php
                    $i=1;
                    foreach ($data as $u) {
                     echo '
                    <tr class="odd gradeX">
                        <td>'.$i.'</td>
                        <td>'.$u->username.'</td>
                        <td>'.$u->password.'</td>
                        <td class="center">'.$u->level.'</td>
                        <td>
                        <a href="#" onclick="prepare_update('.$u->id_admin.')" class="btn btn-warning" data-toggle="modal" data-target="#edit">Edit</a>
                        <a href="'.base_url().'index.php/home/delete_admin/'.$u->id_admin.'" class="btn btn-danger">Delete</a>
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
    <!-- /.content -->
</div>
<!-- Modal insert -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <form action="<?php echo base_url('index.php/home/insert_admin'); ?>" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Insert Admin</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="insert_admin_username">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="text" class="form-control" name="insert_admin_password">
                                            </div>
                                            <div class="form-group">
                                                <select value="level" name="insert_admin_level" class="form-control">
                                                    <option>Pilih Level</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="kasir">Kasir</option>
                                                </select>
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
                            <!-- /.modal -->

                            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <form action="<?php echo base_url('index.php/home/edit_admin'); ?>" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Admin</h4>
                                        </div>
                                        <div class="modal-body">
                                        <input type="hidden" name="edit_admin_id" id="edit_admin_id">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="edit_admin_username" id="edit_admin_username" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="text" class="form-control" name="edit_admin_password" id="edit_admin_password">
                                            </div>
                                            <div class="form-group">
                                                <select value="level" name="edit_admin_level" class="form-control" id="edit_admin_level">
                                                    <option value="admin">Admin</option>
                                                    <option value="kasir">Kasir</option>
                                                </select>
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
                            <!-- /.modal -->
                            <script type="text/javascript">
                                function prepare_update(id) {
                                    $('#edit_admin_id').val();
                                    $('#edit_admin_username').val();
                                    $('#edit_admin_password').val();
                                
                                    $.getJSON("<?php echo base_url('index.php/home/get_admin_by_id/')?>"+ id, function (data) {
                                        $('#edit_admin_id').val(data.id_admin);
                                        $('#edit_admin_username').val(data.username);
                                        $('#edit_admin_password').val(data.password);
                                    });
                                }
                            </script>