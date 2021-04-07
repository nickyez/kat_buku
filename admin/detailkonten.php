<!DOCTYPE html> 
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
            <h3><i class="fas fa-user-tie"></i> Detail Data Konten</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="konten.php">Data Konten</a></li>
              <li class="breadcrumb-item active">Detail Data Konten</li>
<?php
  session_start();
  include('../koneksi/koneksi.php');
    if(isset($_GET['data'])){
      $id_konten = $_GET['data'];
      $_SESSION['id_konten']=$id_konten;
        
      //get data konten
      $sql_d = "SELECT  `tanggal`, `judul`, `isi` 
                FROM `konten` 
                WHERE `id_konten` = '$id_konten'";
      $query_d = mysqli_query($koneksi,$sql_d);
      while($data_d = mysqli_fetch_row($query_d)){
        $id_konten= $data_d[0];
        $tanggal= $data_d[1];
        $judul= $data_d[2];
        $isi= $data_d[3];
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
                <h3><i class="fas fa-user-tie"></i> Detail Data Konten</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="konten.php">Data Konten</a></li>
                  <li class="breadcrumb-item active">Detail Data Konten</li>
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
                      <a href="konten.php" class="btn btn-sm btn-warning float-right">
                      <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <tbody>
                        <?php
                          $sql_k = "SELECT `id_konten`, `tanggal`, `judul`, `isi` FROM `konten`";
                          $query_k = mysqli_query($koneksi,$sql_k);
                          while ($data_k = mysqli_fetch_row($query_k)) {
                            $id_konten = $data_k[0];
                            $tanggal = $data_k[1];
                            $judul = $data_k[2];
                            $isi = $data_k[3];
                        ?>                
                        <tr>
                          <td width="20%"><strong>Tanggal<strong></td>
                          <td width="80%"><?php echo $tanggal; ?></td>
                        </tr>
                        <tr>
                          <td width="20%"><strong>Judul<strong></td>
                          <td width="80%"><?php echo $judul; ?></td>
                        </tr> 
                        <tr>
                          <td width="20%"><strong>Sinopsis<strong></td>
                          <td width="80%"><?php echo $isi; ?></td>
                        </tr> 
                      <?php } ?>
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
