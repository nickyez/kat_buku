<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
<?php 
session_start();
include('../koneksi/koneksi.php');
if(isset($_GET['data'])){
	$id_tag = $_GET['data'];
	$_SESSION['id_tag']=$id_tag;
	
	//get data tag
	$sql_a = "select `tag` from `tag` where `id_tag` = '$id_tag'";
	$query_a = mysqli_query($koneksi,$sql_a);
	while($data_a = mysqli_fetch_row($query_a)){
		$tag = $data_a[0];
	}
}
?>
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
            <h3><i class="fas fa-edit"></i> Edit Tag</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="katgoribuku.php">Tag</a></li>
              <li class="breadcrumb-item active">Edit Tag</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Tag</h3>
        <div class="card-tools">
          <a href="tag.php" class="btn btn-sm btn-warning float-right"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br>
      <div class="col-sm-10">
		<?php if(!empty($_GET['notif'])){?>
			<?php if($_GET['notif']=="editkosong"){?>
			<div class="alert alert-danger" role="alert">Maaf data Tag wajib di isi</div>
			<?php }?>
		<?php }?>
      </div>
      <form class="form-horizontal" method="post" action="konfirmasiedittag.php">
        <div class="card-body">
          <div class="form-group row">
            <label for="Tag" class="col-sm-3 col-form-label">Tag</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="tag" Name="tag" value="<?php echo $tag;?>">
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="col-sm-10">
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
