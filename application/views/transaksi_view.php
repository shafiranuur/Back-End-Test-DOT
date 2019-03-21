<div class="content-wrapper">
	<section class="content-header">
          <h1>
            Transaksi
            <small></small>
        </h1>
        </section><br>
        <div class="hua" style="margin-left: 20px">
<div class="row">
<div class="col-md-6">
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body"">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Tanggal Beli">
                </div>

               	<div class="form-group">
                  <input type="text" class="form-control" placeholder="Nama Pembeli">
                </div>

                <div class="form-group">
                <select class="form-control select2" style="width: 100%;" placeholder="Buku">
                 <?php
                    foreach ($data as $u) {
                        echo '
                        <option value="'.$u->id_buku.'">
                        '.$u->judul_buku.'
                        </option>
                        ';
                      }
                    ?>
                </select>
              </div>

              <div class="form-group">
                  <input type="text" class="form-control" placeholder="QTY">
                </div>


              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
</div></div>

<div class="row">
	<div class="col-md-6">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">TABEL PEMBELIAN</h3>
			</div>

			<table class="table table-bordered">
				<tr>
					<th>No.</th>
					<th>Nama Pembeli</th>
					<th>Nama Buku</th>
					<th>Jumlah</th>
					<th>Total</th>
				</tr>
				<tr></tr>
			</table>
		</div>
	</div>
</div>
</div>
</div>