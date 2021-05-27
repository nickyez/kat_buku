<?php
  session_start();
  include('../koneksi/koneksi.php');
    if(isset($_GET['data'])){
      $id_konten = $_GET['data'];
      $_SESSION['id_konten']=$id_konten;
        
      //get data konten
      $sql_d = "SELECT `id_konten`, `judul`, `isi`, `tanggal` 
                FROM `konten` 
                WHERE `id_konten` = '$id_konten'";
      $query_d = mysqli_query($koneksi,$sql_d);
      while($data_d = mysqli_fetch_row($query_d)){
        $id_konten= $data_d[0];
        $judul= $data_d[1];
        $isi= $data_d[2];
        $tanggal= $data_d[3];
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
                <h3><i class="fas fa-edit"></i> Edit Data Konten</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="konten.php">Data Konten</a></li>
                  <li class="breadcrumb-item active">Edit Data Konten</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Data Konten</h3>
            <div class="card-tools">
              <a href="konten.php" class="btn btn-sm btn-warning float-right">
              <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
            </div>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          </br></br>
          <div class="col-sm-10">
            <?php if((!empty($_GET['notif']))&&(!empty($_GET['jenis']))){ ?>
              <?php if($_GET['notif']=="editkosong"){ ?>
                <div class="alert alert-danger" role="alert">Maaf data
              <?php echo $_GET['jenis'];?> wajib di isi</div>
              <?php } ?>
            <?php } ?>
          </div>
          <form class="form-horizontal" method="POST" action="konfirmasieditkonten.php">
            <div class="card-body">
              <div class="form-group row">
                <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="judul" Name="judul" value="<?php echo $judul; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="isi" class="col-sm-3 col-form-label">Isi</label>
                <div class="col-sm-7">
                  <textarea class="form-control" Name="isi" id="editor1" rows="12" ><?php echo $isi; ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="tanggal" Name="tanggal" value="<?php echo $tanggal; ?>">
                </div>
              </div>     

              </div>
            </div>

          </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Simpan</button>
              </div>  
            </div>
            <!-- /.card-footer -->
          </form>
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
