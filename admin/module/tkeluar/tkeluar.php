<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=tkeluar"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Data Transaksi Pembelian
                                        </li>
                                        <li>
											<a href="adminpanel.php?page=home">Dashboard</a>
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->
						
<?php
$aksi = "module/tkeluar/tkeluarpro.php";
$pp = isset($_GET['pp'])? filcar($_GET['pp']):"";

switch ($pp){
	default:
	try {
		$sql = "SELECT * FROM tbl_pembelian ORDER BY id_pembelian DESC";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Data Transaksi Pembelian</b></h4>
                                    
									<button type="button" class="btn btn-info waves-effect waves-light w-xs btn-sm" onclick="window.location.href='?page=tkeluar&pp=add';">
										<span class="btn-label"><i class="fa  fa-plus"></i></span>Tambah
									</button><br><br>


                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th style="width:5%"><center>No</center></th>
                                                <th><center>Tanggal Transaksi</center></th>
                                                <th><center>Total Transaksi</center></th>
                                                <th><center>User</center></th>
                                                <th><center>Tools</center></th>
                                            </tr>
                                        </thead>

                                        <tbody>
											<?php
												if($row>0) {
													$no=0;
													foreach($stmt->fetchAll() as $k=>$r){
														$no++;
											?>	
                                            <tr>										
                                                <td><center><?php echo $no;?></center></td>
                                                <td><?php echo tgl_indo($r['tgl_pembelian']);?></td>
                                                <td style="text-align:end"><?php echo rupiah($r['total_transaksi']);?></td>
												<?php
													$sql 	= " SELECT * FROM tbl_users";
													$a		= $conn->prepare($sql); 
													$a->execute();
													$b 		= $a->Fetch(PDO::FETCH_ASSOC);
												?>
												<td><?php echo $b['nama_lengkap'];?></td>
                                                <td style="text-align:center">
												
												<button class="btn waves-effect waves-light btn-success"  onclick="window.location.href='?page=tkeluar&pp=view&id=<?php echo $r['id_pembelian'];?>';"><i class="icon-eye"></i></button>
												
												<button class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=delete&id='. $r['id_pembelian'];?>';"><i class="icon-trash"></i></button>
												</td>
												
                                            </tr>
											<?php												
													}
												}
												?>	
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end row -->

<?php
	} 
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	break;
	
	case "add":
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b>Input Data Transaksi Pembelian</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=save';?>" enctype="multipart/form-data">
												
												<?php 

													$sql = $conn->prepare("SELECT max(id_pembelian) as id FROM tbl_pembelian");
													$sql->execute();
													$hasil = $sql->fetch();
													
													$kode = $hasil['id'];
													$noUrut = (int) substr($kode, 4);
													$noUrut++;
													$char = "TK-";
													$newID = $char . sprintf("%010s", $noUrut);
												?>
												
												<fieldset class="form-group">
												<div class="row">
													<div class="col-sm-3">
														<label>No Transaksi</label>
														<input type="text" class="form-control" name="id" value="<?php echo $newID; ?>" readonly>
													</div>
													<div class="col-sm-3">
														<label>Tanggal Transaksi</label>
														<input type="text" class="form-control" name="tanggal" value="<?php echo tgl_indo($tanggal); ?>" readonly>
													</div>
												</div>
                                                </fieldset>
											</form>
											
											
											<form method="post" action="<?php echo $aksi .'?act=simpan';?>" enctype="multipart/form-data">
												<input hidden type="text" class="form-control" name="id" value="<?php echo $newID; ?>" readonly>
											
												<fieldset class="form-group">
                                                    <label>Nama Barang</label>
                                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Barang" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Jumlah</label>
                                                    <input type="number" onkeyup="hitung2();"  class="a2 form-control" name="jumlah" placeholder="Masukkan Jumlah" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Harga</label>
                                                    <input type="number" onkeyup="hitung2();" class="b2 form-control" name="harga" placeholder="Masukkan Harga" required>
                                                </fieldset>
												
												<script>
													function hitung2() {
													  var a = $(".a2").val();
													  var b = $(".b2").val();
													  c = a * b;
													  $(".c2").val(c);
													  }
												</script>
												
												<fieldset class="form-group">
                                                    <label>Total</label>
                                                    <input readonly type="number" class="c2 form-control" name="total" placeholder="Total" required>
                                                </fieldset>
												
												<button type="submit" class="btn btn-primary">Tambah</button>
                                                <button type="reset" class="btn btn-warning">Reset</button>
												<br><br>                                          
                                            </form>
											
												<?php			
												try {
													$sql = "SELECT * FROM tbl_detail_pembelian WHERE id_pembelian='$newID'";
													$stmt = $conn->prepare($sql); 
													$stmt->execute();
													$stmt->setFetchMode(PDO::FETCH_ASSOC);
													$row = $stmt->rowCount();			
												?>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th><center>No</center></th>
															<th><center>Nama Barang</center></th>
															<th><center>Jumlah</center></th>
															<th><center>Harga</center></th>
															<th><center>Total</center></th>
															<th><center>Aksi</center></th>
														</tr>
													</thead>

													<tbody>
														<?php
															if($row>0) {
																$no=0;
																foreach($stmt->fetchAll() as $k=>$r){
																	$no++;
														?>	
														<tr>										
															<td><center><?php echo $no;?></center></td>
															<td><?php echo $r['nama_barang'];?></td>
															<td><?php echo $r['jumlah'];?></td>
															<td><?php echo rupiah($r['harga']);?></td>
															<td><?php echo rupiah($r['total']);?></td>
															<td style="text-align:center">
															
															<button class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=hapus&id='. $r['id_detail_pembelian'];?>';"><i class="icon-trash"></i></button>
															</td>
															
														</tr>
														<?php												
																}
															}
															?>	
														<tr>
															<td colspan="4"><b>Total Harga Transaksi</b></td> 
															<?php
																$sql 				= " SELECT SUM(total) as total FROM tbl_detail_pembelian
																						WHERE id_pembelian='$newID'";
																$a	= $conn->prepare($sql); 
																$a->execute();
																$b = $a->Fetch(PDO::FETCH_ASSOC);
															?>
															<td colspan="2"><b>Rp. <?php echo rupiah($b['total']);?> </b></td> 
														</tr>
													</tbody>
												</table>
												
												<?php
													} 
													catch(PDOException $e) {
														echo "Error: " . $e->getMessage();
													}
												?>
												<br>
												
											<form method="post" action="<?php echo $aksi .'?act=save';?>" enctype="multipart/form-data">
												<input hidden type="text" class="form-control" name="id" value="<?php echo $newID; ?>" required>
												<input hidden type="text" class="form-control" name="tanggal" value="<?php echo $tgl_sekarang; ?>" required>
												<input hidden type="text" class="form-control" name="total" value="<?php echo $b['total'];?>" required>
												
												<button type="button" onclick="self.history.back()" class="btn btn-danger">Batal</button>
												<button type="submit" class="btn btn-success">Proses Transaksi</button>                                   
                                            </form>
                        				</div><!-- end col -->
                        			</div><!-- end row -->
                        		</div>
                        	</div><!-- end col -->
                        </div>
                        <!-- end row -->
						
<?php
	break;
	
	case "view":
	try{
		$id = $_GET['id'];
		$sql = "SELECT * FROM tbl_pembelian JOIN tbl_detail_pembelian ON tbl_pembelian.id_pembelian=tbl_detail_pembelian.id_pembelian
				WHERE tbl_pembelian.id_pembelian='$id'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$v = $stmt->fetch(PDO::FETCH_ASSOC);
		
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b>Lihat Detail Data Transaksi Pembelian</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form>
												
												<fieldset class="form-group">
												<div class="row">
													<div class="col-sm-3">
														<label>No Transaksi</label>
														<input type="text" class="form-control" name="id" value="<?php echo $v['id_pembelian']; ?>" readonly>
													</div>
													<div class="col-sm-3">
														<label>Tanggal Transaksi</label>
														<input type="text" class="form-control" name="tanggal" value="<?php echo tgl_indo($v['tgl_pembelian']); ?>" readonly>
													</div>
												</div>
                                                </fieldset>
											</form>
											
												<?php
												try {
													$sql = "SELECT * FROM tbl_pembelian JOIN tbl_detail_pembelian ON tbl_pembelian.id_pembelian=tbl_detail_pembelian.id_pembelian
															WHERE tbl_pembelian.id_pembelian='$id'";
													$stmt = $conn->prepare($sql); 
													$stmt->execute();
													$stmt->setFetchMode(PDO::FETCH_ASSOC);
													$row = $stmt->rowCount();
												?>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th><center>No</center></th>
															<th><center>Nama Barang</center></th>
															<th><center>Jumlah</center></th>
															<th><center>Harga</center></th>
															<th><center>Total</center></th>
														</tr>
													</thead>

													<tbody>
														<?php
															if($row>0) {
																$no=0;
																foreach($stmt->fetchAll() as $k=>$r){
																	$no++;
														?>	
														<tr>										
															<td><center><?php echo $no;?></center></td>
															<td><?php echo $r['nama_barang'];?></td>
															<td><center><?php echo $r['jumlah'];?></center></td>
															<td style="text-align:end"><?php echo rupiah($r['harga']);?></td>
															<td style="text-align:end"><?php echo rupiah($r['total']);?></td>
														</tr>
												<?php												
																}
															}
												} catch(PDOException $e) {
													echo "Error: " . $e->getMessage();
												}
												?>	
														<tr>
															<td colspan="4"><b>Total Harga Transaksi</b></td> 
															<td colspan="2" style="text-align:end"><b>Rp. <?php echo rupiah($v['total_transaksi']);?> </b></td> 
														</tr>
													</tbody>
												</table>
												<br>
												<button type="button" onclick="self.history.back()" class="btn btn-danger">Kembali</button>
                        				</div><!-- end col -->
                        			</div><!-- end row -->
                        		</div>
                        	</div><!-- end col -->
                        </div>
                        <!-- end row -->

<?php
} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	break;
}
?>
