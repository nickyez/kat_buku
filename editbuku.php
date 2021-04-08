<?php
  session_start();
  include('../koneksi/koneksi.php');
  if(isset($_GET['data'])){
    $id_buku = $_GET['data'];
    $_SESSION['id_buku']=$id_buku;
  //get data buku
    $sql_m = "SELECT `id_kategori_buku`,`judul`,`pengarang`,`id_penerbit`,`tahun_terbit`,`sinopsis` 
              FROM `buku`
              WHERE `id_buku`='$id_buku'";
    $query_m = mysqli_query($koneksi,$sql_m);
    while($data_m = mysqli_fetch_row($query_m)){
      $id_kategori_buku= $data_m[0];
      $judul = $data_m[1];
      $pengarang = $data_m[2];
      $id_penerbit = $data_m[3];
      $tahun_terbit = $data_m[4];
      $sinopsis = $data_m[5];
  }
  //get tag
  $sql_h = "SELECT `id_tag` 
            FROM `tag_buku`
            WHERE `id_buku`='$id_buku'";
  $query_h = mysqli_query($koneksi,$sql_h);
  $array_tag = array();
  while($data_h = mysqli_fetch_row($query_h)){
    $id_tag= $data_h[0];
    $array_tag[] = $id_tag;
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
                <h3><i class="fas fa-edit"></i> Edit Data Buku</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="buku.php">Data Buku</a></li>
                  <li class="breadcrumb-item active">Edit Data Buku</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Data Buku</h3>
            <div class="card-tools">
              <a href="buku.php" class="btn btn-sm btn-warning float-right">
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
          <form class="form-horizontal" action="konfirmasieditbuku.php" method="POST" enctype="multipart/form-data">
            <div class="card-body">  
              <div class="form-group row">
                <label for="foto" class="col-sm-3 col-form-label">Cover Buku </label>
                <div class="col-sm-7">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="cover" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>  
                </div>
              </div>
              <div class="form-group row">
                <label for="kategori" class="col-sm-3 col-form-label">Kategori Buku</label>
                <div class="col-sm-7">
                  <select class="form-control" id="kategori" name="kategori_buku">
                    <option value="0">- Pilih Kategori -</option>
                    <?php
                    $sql_k = "SELECT `id_kategori_buku`,`kategori_buku` 
                              FROM `kategori_buku` 
                              ORDER BY `kategori_buku`";
                    $query_k = mysqli_query($koneksi, $sql_k);
                    while($data_k = mysqli_fetch_row($query_k)){
                      $id_kategori_buku = $data_k[0];
                      $kategori_buku = $data_k[1];
                    ?>
                    <option value="<?php echo $id_kategori_buku;?>"
                      <?php 
                        if($id_kategori_buku==$id_kategori_buku){ 
                      ?>
                      selected <?php } ?>><?php echo $kategori_buku; ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="judul" id="judul" value="<?php echo $judul; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="pengarang" class="col-sm-3 col-form-label">Pengarang</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="pengarang" id="pengarang" value="<?php echo $pengarang; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                <div class="col-sm-7">
                  <select class="form-control" id="penerbit" name="penerbit">
                    <option value="0">- Pilih penerbit -</option>
                    <?php
                      $sql_t = "SELECT `id_penerbit`,`penerbit` 
                                FROM `penerbit`
                                ORDER BY `penerbit`";
                      $query_t = mysqli_query($koneksi, $sql_t);
                      while($data_t = mysqli_fetch_row($query_t)){
                        $id_penerbit = $data_t[0];
                        $penerbit = $data_t[1];
                      ?>
                      <option value="<?php echo $id_penerbit; ?>"
                        <?php if($id_penerbit==$id_penerbit){ ?> selected <?php } ?>><?php echo $penerbit; ?>
                      </option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="tahun_terbit" class="col-sm-3 col-form-label">Tahun Terbit</label>
                <div class="col-sm-7">
                  <input type="number" class="form-control" name="tahun_terbit" id="tahun_terbit" value="<?php echo $tahun_terbit; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="sinopsis" class="col-sm-3 col-form-label">Sinopsis</label>
                <div class="col-sm-7">
                  <textarea class="form-control" name="sinopsis" id="editor1" rows="12"><?php echo $sinopsis; ?></textarea>
                </div>
              </div>          
              <div class="form-group row">
                <label for="hobi" class="col-sm-3 col-form-label">Tag</label>
                <div class="col-sm-7">
                  <?php
                    $sql_g = "SELECT `id_tag`,`tag` 
                              FROM `tag`
                              ORDER BY `tag`";
                    $query_g = mysqli_query($koneksi, $sql_g);
                    while($data_g = mysqli_fetch_row($query_g)){
                      $id_tag = $data_g[0];
                      $tag = $data_g[1];
                    ?>
                    <input type="checkbox" name="tag[]" value="<?php echo $id_tag;?>"
                    <?php 
                      if(in_array($id_tag, $array_tag)){
                    ?>checked="checked" 
                    <?php } ?>>
                    <?php echo $tag; ?> </br>
                  <?php } ?>
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
