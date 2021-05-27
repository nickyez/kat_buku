<?php
  session_start();
  include('../koneksi/koneksi.php');
  if(isset($_GET['data'])){
    $id_buku = $_GET['data'];
    //gat data buku
    $sql = "SELECT `b`.`cover`,`k`.`kategori_buku`,`b`.`judul`,`b`.`pengarang`,`b`.`tahun_terbit`,
                  `p`.`penerbit`, `b`.`sinopsis` 
            FROM `buku` `b`
            INNER JOIN `kategori_buku` `k` ON `b`.`id_kategori_buku`=`k`.`id_kategori_buku`
            INNER JOIN `penerbit` `p` ON `b`.`id_penerbit`= `p`.`id_penerbit`
            WHERE `b`.`id_buku`='$id_buku'";
    $query = mysqli_query($koneksi,$sql);
    while($data = mysqli_fetch_row($query)){
      $cover = $data[0];
      $kategori_buku = $data[1];
      $judul = $data[2];
      $pengarang = $data[3];
      $tahun_terbit = $data[4];
      $penerbit = $data[5];
      $sinopsis = $data[6];
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
                <h3><i class="fas fa-user-tie"></i> Detail Data Buku</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="buku.php">Data Buku</a></li>
                  <li class="breadcrumb-item active">Detail Data Buku</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
                <div class="card">
                  <div class="card-header">
                    <div class="card-tools">
                      <a href="buku.php" class="btn btn-sm btn-warning float-right">
                      <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>                      
                          <tr>
                            <td><strong>Cover Buku<strong></td>
                            <td><img src="cover/<?php echo $cover; ?>" class="img-fluid" width="200px;"></td>
                          </tr>               
                          <tr>
                            <td width="20%"><strong>Kategori Buku<strong></td>
                            <td width="80%"><?php echo $kategori_buku; ?></td>
                          </tr>                 
                          <tr>
                            <td width="20%"><strong>Judul<strong></td>
                            <td width="80%"><?php echo $judul; ?></td>
                          </tr>                 
                          <tr>
                            <td width="20%"><strong>Pengarang<strong></td>
                            <td width="80%"><?php echo $pengarang; ?></td>
                          </tr>
                          <tr>
                            <td width="20%"><strong>Tahun Terbit<strong></td>
                            <td width="80%"><?php echo $tahun_terbit; ?></td>
                          </tr>
                          <tr>
                            <td><strong>Tag<strong></td>
                            <td>
                              <ul>
                                <?php
                                  //get tag
                                  $sql_h = "SELECT `t`.`tag` 
                                            FROM `tag_buku` `tb`
                                            INNER JOIN `tag` `t` 
                                            ON `tb`.`id_tag` = `t`.`id_tag`
                                            WHERE `tb`.`id_buku`='$id_buku'";
                                  $query_h = mysqli_query($koneksi,$sql_h);
                                  while($data_h = mysqli_fetch_row($query_h)){
                                    $tag= $data_h[0];
                                ?>
                                <li><?php echo $tag; ?></li>
                                <?php } ?>
                              </ul>
                            </td>
                          </tr>
                          <tr>
                            <td width="20%"><strong>Sinopsis<strong></td>
                            <td align="left" valign="top" width="80%"><?php echo $sinopsis; ?></td>
                          </tr> 
                        </tbody>
                      </table>  
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">&nbsp;</div>
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
