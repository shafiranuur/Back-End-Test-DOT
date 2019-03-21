<div class="content-wrapper">
        <!-- Content Header (Page header) -->
       <section class="content-header">
          <h1>
            Data Master
            <small></small>
        </h1>
        </section>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#insert" style="margin-left: 40px;margin-top:30px;margin-bottom:10px"">Insert Buku</a>
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
              <h3 class="box-title">Data Buku</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">No.</th>
                  <th>Judul</th>
                  <th>Tahun Terbit</th>
                  <th>Kategori</th>
                  <th>Harga</th>
                  <th>Foto Cover</th>
                  <th>Penerbit</th>
                  <th>Penulis</th>
                  <th>Stok</th>
                </tr>
                <?php
                    $i=1;
                    foreach ($data as $u) {
                     echo '
                    <tr class="odd gradeX">
                        <td>'.$i.'</td>
                        <td>'.$u->judul_buku.'</td>
                        <td>'.$u->tahun.'</td>
                        <td>'.$u->nama_kategori.'</td>
                        <td>'.$u->harga.'</td>
                        <td>'.$u->foto_cover.'</td>
                        <td>'.$u->penerbit.'</td>
                        <td>'.$u->penulis.'</td>
                        <td>'.$u->stok.'</td>
                        <td>
                        <a href="#" onclick="prepare_update('.$u->id_buku.')" class="btn btn-warning" data-toggle="modal" data-target="#edit" >Edit</a>
                        <a href="'.base_url().'index.php/home/delete_buku/'.$u->id_buku.'" class="btn btn-danger">Delete</a>
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
                                    <form action="<?php echo base_url('index.php/home/insert_buku'); ?>" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Insert Buku</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Judul</label>
                                                <input type="text" class="form-control" name="judul_buku" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun Terbit</label>
                                                <input type="text" class="form-control" name="tahun" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select class="form-control" name="kategori" required>
                                                	<?php
                                                		foreach ($kategori as $u) {
                                                			echo '
                                                			<option value="'.$u->id_kategori.'">
                                                				'.$u->nama_kategori.'
                                                			</option>
                                                			';
                                                		}
                                                	  ?>
                                                	
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="text" class="form-control" name="harga" required>
                                            </div>
                                             <div class="form-group">
                							  	<label for="exampleInputFile">Foto Cover</label>
                  								<input type="file" id="exampleInputImage" class="form-control" name="foto_cover" required>
               								</div>
                                            <div class="form-group">
                                                <label>Penerbit</label>
                                                <input type="text" class="form-control" name="penerbit" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Penulis</label>
                                                <input type="text" class="form-control" name="penulis" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Stok</label>
                                                <input type="text" class="form-control" name="stok" required>
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
                                   	<form action="<?php echo base_url('index.php/home/edit_buku'); ?>" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Buku</h4>
                                        </div>
                                        <div class="modal-body">
                                        <input type="hidden" name="edit_id_buku" id="edit_id_buku">
                                            <div class="form-group">
                                                <label>Judul</label>
                                                <input type="text" class="form-control" name="edit_judul" required id="edit_judul">
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun Terbit</label>
                                                <input type="text" class="form-control" required name="edit_tahun" id="edit_tahun">
                                            </div>
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select class="form-control" required name="edit_kategori" id="edit_kategori">
                                                	<?php
                                                		foreach ($kategori as $u) {
                                                			echo '
                                                			<option value="'.$u->id_kategori.'">
                                                				'.$u->nama_kategori.'
                                                			</option>
                                                			';
                                                		}
                                                	  ?>
                                                	
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="text" class="form-control" required name="edit_harga" id="edit_harga">
                                            </div>
                                             <div class="form-group">
                							  	<label for="exampleInputFile">Foto Cover</label>
                  								<input type="file" id="exampleInputImage" class="form-control" name="foto_cover" required id="edit_foto_cover">
               								</div>
                                            <div class="form-group">
                                                <label>Penerbit</label>
                                                <input type="text" class="form-control" required name="edit_penerbit" id="edit_penerbit">
                                            </div>
                                            <div class="form-group">
                                                <label>Penulis</label>
                                                <input type="text" class="form-control" name="edit_penulis" required id="edit_penulis">
                                            </div>
                                            <div class="form-group">
                                                <label>Stok</label>
                                                <input type="text" class="form-control" name="edit_stok" required name id="edit_stok">
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
                                	$('#edit_id_buku').val();
                                    $('#edit_judul').val();
                                    $('#edit_tahun').val();
                                    $('#edit_kategori').val();
                                    $('#edit_harga').val();
                                    $('#edit_foto_cover').val();
                                    $('#edit_penerbit').val();
                                    $('#edit_penulis').val();
                                    $('#edit_stok').val();
                                
                                    $.getJSON("<?php echo base_url('index.php/home/get_buku_by_id/')?>"+ id, function (data) {
                                        $('#edit_id_buku').val(data.id_buku);
                                        $('#edit_judul').val(data.judul_buku);
                                        $('#edit_tahun').val(data.tahun);
                                        $('#edit_kategori').val(data.id_kategori);
                                        $('#edit_harga').val(data.harga);
                                        $('#edit_foto_cover').val(data.foto_cover);
                                        $('#edit_penerbit').val(data.penerbit);
                                        $('#edit_penulis').val(data.penulis);
                                        $('#edit_stok').val(data.stok);
                                    });
                                }
                            </script>