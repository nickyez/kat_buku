<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include("includes/header.php") ?>

  <?php include("includes/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-book"></i> Buku</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Buku</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Buku</h3>
                <div class="card-tools">
                  <a href="tambahbuku.php" class="btn btn-sm btn-info float-right">
                  <i class="fas fa-plus"></i> Tambah  Buku</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="" action="">
                    <div class="row">
                        <div class="col-md-4 bottom-10">
                          <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                        </div>
                        <div class="col-md-5 bottom-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                    </div><!-- .row -->
                  </form>
                </div><br>
              <div class="col-sm-12">
                  <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
                  <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
              </div>
                  <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th width="5%">No</th>
                        <th width="30%">Kategori</th>
                        <th width="30%">Judul</th>
                        <th width="20%">Penerbit</th>
                        <th width="15%"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>Website</td>
<?php
  include('../koneksi/koneksi.php');
  if((isset($_GET['aksi']))&&(isset($_GET['data']))){
    if($_GET['aksi']=='hapus'){
      $id_buku = $_GET['data'];
      //hapus buku
      $sql_dh = "DELETE FROM `buku` WHERE `id_buku` = '$id_buku'";
      mysqli_query($koneksi,$sql_dh);
    }
  }
?>
<!DOCTYPE html>
  <html>
  <head>
    <?php include("includes/head.php") ?> 
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
    <?php include("includes/header.php") ?>

      <?php include("includes/sidebar.php") ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h3><i class="fas fa-book"></i> Buku</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active"> Buku</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Buku</h3>
                    <div class="card-tools">
                      <a href="tambahbuku.php" class="btn btn-sm btn-info float-right">
                      <i class="fas fa-plus"></i> Tambah  Buku</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="col-md-12">
                      <form method="GET" action="buku.php">
                        <div class="row">
                          <div class="col-md-4 bottom-10">
                            <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                          </div>
                          <div class="col-md-5 bottom-10">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                          </div>
                        </div><!-- .row -->
                      </form>
                    </div><br>
                    <div class="col-sm-12">
                      <?php if(!empty($_GET['notif'])){ ?>
                        <?php if($_GET['notif']=="tambahberhasil"){ ?>
                          <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan
                          </div>
                          <?php } else if($_GET['notif']=="editberhasil"){ ?>
                          <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                        <?php } ?>
                      <?php }?>
                    </div>
                      <table class="table table-bordered">
                        <thead>                  
                          <tr>
                            <th width="5%"><center>No</center></th>
                            <th width="20%"><center>Kategori</center></th>
                            <th width="40%"><center>Judul</center></th>
                            <th width="15%"><center>Penerbit</center></th>
                            <th width="20%"><center>Aksi</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $batas = 2;
                            if(!isset($_GET['halaman'])){
                              $posisi = 0;
                              $halaman = 1;
                            }else{
                              $halaman = $_GET['halaman'];
                              $posisi = ($halaman-1) * $batas;
                            }
                            $sql_u = "SELECT `b`.`id_buku`, `b`.`judul`,`k`.`kategori_buku`,`p`.`penerbit` 
                                      FROM `buku` `b`
                                      INNER JOIN `kategori_buku` `k` ON `b`.`id_kategori_buku` =`k`.`id_kategori_buku` 
                                      INNER JOIN `penerbit` `p` ON `b`.`id_penerbit` = `p`.`id_penerbit`";
                            if (isset($_GET["katakunci"])){
                              $katakunci_kategori = $_GET["katakunci"];
                              $sql_u .= " WHERE `b`.`judul` LIKE '%$katakunci_kategori%'";
                            }
                            $sql_u .= " ORDER BY `k`.`kategori_buku`, `b`.`judul` limit $posisi, $batas ";
                            $query_u = mysqli_query($koneksi,$sql_u);
                            $no=1;
                            while($data_u = mysqli_fetch_row($query_u)){
                              $id_buku = $data_u[0];
                              $judul = $data_u[1];
                              $kategori_buku = $data_u[2];
                              $penerbit = $data_u[3];
                          ?>
                          <tr>
                            <td align="center"><?php echo $no; ?></td>
                            <td><?php echo $kategori_buku; ?></td>
                            <td><?php echo $judul; ?></td>
                            <td align="center"><?php echo $penerbit; ?></td>
                            <td align="center">
                              <a href="detailbuku.php?data=<?php echo $id_buku;?>"
                              class="btn btn-xs btn-success" title="Detail"><i class="fas
                              fa-eye"></i>Detail</a>
                              <a href="editbuku.php?data=<?php echo $id_buku;?>"
                              class="btn btn-xs btn-warning" title="Edit"><i class="fas
                              fa-edit"></i>Edit</a>
                              <a href="javascript:if(confirm('Anda yakin ingin menghapus data
                              <?php echo $judul; ?>?')) window.location.href =
                              'buku.php?aksi=hapus&data=<?php echo $id_buku; ?>¬if=hapusberhasil'"
                              class="btn btn-xs btn-danger"><i class="fas fa-trash"
                              title="Hapus"></i>Hapus</a>
                            </td>
                          </tr>
                          <?php $no ++;} ?> 
                        </tbody>
                      </table>
                    </div>  
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <?php 
                      //hitung jumlah semua data
                      $sql_jum = "SELECT `b`.`id_buku`, `b`.`judul`,`k`.`kategori_buku`,`p`.`penerbit` 
                                  FROM `buku` `b`
                                  INNER JOIN `kategori_buku` `k` ON `b`.`id_kategori_buku` =`k`.`id_kategori_buku` 
                                  INNER JOIN `penerbit` `p` ON `b`.`id_penerbit` = `p`.`id_penerbit`";
                      if(isset($_GET["katakunci"])){
                        $katakunci_kategori = $_GET["katakunci"];
                        $sql_jum .= " WHERE `b`.`judul` LIKE '%$katakunci_kategori%'";
                      }
                      $sql_jum .= " ORDER BY `k`.`kategori_buku`, `b`.`judul`";
                      $query_jum = mysqli_query($koneksi,$sql_jum);
                      $jum_data = mysqli_num_rows($query_jum);
                      $jum_halaman = ceil($jum_data/$batas);
                    ?>
                    <ul class="pagination pagination-sm m-0 float-right">
                      <?php 
                      if($jum_halaman==0){
                        //tidak ada halaman 
                      }else if($jum_halaman==1){
                        echo "<li class='page-item'><a class='page-link'>1</a></li>";
                      }else{
                        $sebelum = $halaman-1;
                        $setelah = $halaman+1;
                        if (isset($_GET["katakunci"])){
                          $katakunci_kategori = $_GET["katakunci"];
                          if($halaman!=1){
                            echo "<li class='page-item'><a class='page-link' href='buku.php?katakunci=$katakunci_kategori&halaman=1'>First</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='buku.php?katakunci=$katakunci_kategori&halaman=$sebelum'>«</a></li>";
                          }
                          for($i=1; $i<=$jum_halaman; $i++){
                            if($i > $halaman - 5 and $i < $halaman + 5){
                              if($i!=$halaman){
                                echo "<li class='page-item'><a class='page-link' href='buku.php?katakunci=$katakunci_kategori&halaman=$i'>$i</a></li>";
                              }else{
                                echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                              }
                            }	
                          }
                          if($halaman!=$jum_halaman){
                            echo"<li class='page-item'><a class='page-link' href='buku.php?katakunci=$katakunci_kategori&halaman=$setelah'>»</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='buku.php?katakunci=$katakunci_kategori&halaman=$jum_halaman'>Last</a></li>";
                          }
                      }else{
                        if($halaman!=1){
                          echo "<li class='page-item'><a class='page-link' href='buku.php?halaman=1'>First</a></li>";
                          echo "<li class='page-item'><a class='page-link' href='buku.php?halaman=$sebelum'>«</a></li>";
                        }
                        for($i=1; $i<=$jum_halaman; $i++){
                          if($i > $halaman - 5 and $i < $halaman + 5){
                            if($i!=$halaman){
                              echo "<li class='page-item'><a class='page-link' href='buku.php?halaman=$i'>$i</a></li>";
                            }else{
                              echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                            }
                          }	
                        }
                        if($halaman!=$jum_halaman){
                          echo "<li class='page-item'><a class='page-link' href='buku.php?halaman=$setelah'>»</a></li>";
                          echo "<li class='page-item'><a class='page-link' href='buku.php?halaman=$jum_halaman'>Last</a></li>";
                          }
                        }
                      } ?>
                    </ul>
                  </div>
                </div>
                <!-- /.card -->

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <?php include("includes/footer.php") ?>

    </div>
    <!-- ./wrapper -->

    <?php include("includes/script.php") ?>
  </body>
</html>
