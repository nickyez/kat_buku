<!DOCTYPE html>
<html>

<head>
    <?php include("includes/head.php") ?>
    <?php 
    include("../koneksi/koneksi.php");
    if((isset($_GET['aksi'])) && (isset($_GET['data']))){
      if($_GET['aksi']=='hapus'){
          $id_user = $_GET['data'];
          $sql_dh = "DELETE FROM `user` WHERE `id_user`=$id_user";
          mysqli_query($koneksi, $sql_dh);
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
                            <h3><i class="fas fa-user-tie"></i> Data User</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Data User</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Data User</h3>
                        <div class="card-tools">
                            <a href="tambahuser.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i>
                                Tambah User</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-12">
                            <form method="post" action="#">
                                <div class="row">
                                    <div class="col-md-4 bottom-10">
                                        <input type="text" class="form-control" id="kata_kunci" name="kunci2">
                                    </div>
                                    <div class="col-md-5 bottom-10">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fas fa-search"></i>&nbsp; Search</button>
                                    </div>
                                </div><!-- .row -->
                            </form>
                        </div><br>
                        <div class="col-sm-12">
                            <?php if(!empty($_GET['notif'])){?>
                            <?php if($_GET['notif']=="tambahberhasil"){ ?>
                            <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
                            <?php } ?>
                            <?php if($_GET['notif']=="editberhasil"){ ?>
                            <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                            <?php } ?>
                            <?php if($_GET['notif']=="hapusberhasil"){ ?>
                            <div class="alert alert-success" role="alert">Data Berhasil Dihapus</div>
                            <?php } ?>
                            <?php } ?>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="30%">Nama</th>
                                    <th width="30%">Email</th>
                                    <th width="20%">Level</th>
                                    <th width="15%">
                                        <center>Aksi</center>
                                    </th>
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
                                    $sql_u = "SELECT `nama`, `email`, `level`, `id_user` FROM `user`";
                                    if(isset($_GET['katakunci'])){
                                      $katakunci_kategori = $_GET['katakunci'];
                                      $sql_u .=" WHERE `nama` LIKE '%$katakunci_kategori%'";
                                    }
                                    $sql_u .= " ORDER BY `level` DESC LIMIT $posisi, $batas";
                                    $query_u = mysqli_query($koneksi, $sql_u);
                                    $jum_data = mysqli_num_rows($query_u);
                                    $jum_halaman = ceil($jum_data/$batas);
                                    $no = $posisi+1;
                                    while($data_u = mysqli_fetch_row($query_u)){
                                        $nama = $data_u[0];
                                        $email = $data_u[1];
                                        $level = $data_u[2];
                                        $id_user = $data_u[3];
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $nama; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $level; ?></td>
                                    <td align="center">
                                        <a href="edituser.php?data=<?php echo $id_user; ?>" class="btn btn-xs btn-info"
                                            title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="detailuser.php?id=<?php echo $id_user; ?>" class="btn btn-xs btn-info"
                                            title="Detail"><i class="fas fa-eye"></i></a>
                                        <a href="javascript:if(confirm('Anda yakin ingin menghapus data user <?php echo $nama; ?>?'))window.location.href='user.php?aksi=hapus&data=<?php echo $id_user;?>&notif=hapusberhasil'"
                                            class="btn btn-xs btn-warning"><i class="fas fa-trash"
                                                title="Hapus"></i></a>
                                    </td>
                                </tr>
                                <?php
                      $no++;  
                      }
                    ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <?php 
                            $sql_jum = "SELECT `nama`, `email`, `level`, `id_user` FROM `user`";
                            if(isset($_GET['katakunci'])){
                                $katakunci_kategori = $_GET['katakunci'];
                                $sql_jum .=" WHERE `nama` LIKE '%$katakunci_kategori%'";
                            }
                            $sql_jum .= "ORDER BY `nama`";
                            $query_jum = mysqli_query($koneksi, $sql_jum);
                            $jum_data = mysqli_num_rows($query_jum);
                            $jum_halaman = ceil($jum_data/$batas);
                        ?>
                        <ul class="pagination pagination-sm m-0 float-right">
                            <?php
                                if($jum_halaman==0){
                                    // tidak ada halaman
                                }else if($jum_halaman==1){
                                    echo "<li class='page-item'><a class='page-link'>1</a></li>";
                                }else{
                                    $sebelum = $halaman - 1;
                                    $setelah = $halaman + 1;
                                    if(isset($_GET['katakunci'])){
                                        $katakunci_kategori = $_GET['katakunci'];
                                        if($halaman!=1){
                                            echo "
                                                <li class='page-item'>
                                                    <a class='page-link'href='user.php?katakunci=$katakunci_kategori&halaman=1'>First</a>
                                                </li>
                                            ";
                                            echo "
                                                <li class='page-item'>
                                                    <a class='page-link'href='user.php?katakunci=$katakunci_kategori&halaman=$sebelum'>«</a>
                                                 </li>
                                            ";
                                        }
                                        for($i=1; $i<=$jum_halaman; $i++){
                                            if($i > $halaman - 5 and $i < $halaman + 5){
                                                if($i!=$halaman){
                                                    echo "
                                                        <li class='page-item'>
                                                            <a class='page-link' href='user.php?katakunci=$katakunci_kategori&halaman=$i'>$i</a>
                                                        </li>
                                                    ";
                                                }else{
                                                    echo "
                                                        <li class='page-item'>
                                                            <a class='page-link'>$i</a>
                                                        </li>
                                                    ";
                                                }
                                            }
                                        }
                                        if($halaman!=$jum_halaman){
                                            echo "
                                            <li class='page-item'>
                                            <a class='page-link' href='user.php?katakunci=$katakunci_kategori&halaman=$setelah'>
                                            »</a></li>
                                            ";
                                            echo "
                                            <li class='page-item'><a class='page-link' href='user.php?katakunci=$katakunci_kategori&halaman=$jum_halaman'>Last</a></li>
                                            ";
                                        }
                                    }else{
                                        if($halaman!=1){
                                            echo "
                                                <li class='page-item'>
                                                    <a class='page-link'href='user.php?halaman=1'>First</a>
                                                </li>
                                            ";
                                            echo "
                                                <li class='page-item'>
                                                    <a class='page-link'href='user.php?halaman=$sebelum'>«</a>
                                                 </li>
                                            ";
                                        }
                                        for($i=1; $i<=$jum_halaman; $i++){
                                            if($i > $halaman - 5 and $i < $halaman + 5){
                                                if($i!=$halaman){
                                                    echo "
                                                        <li class='page-item'>
                                                            <a class='page-link' href='user.php?halaman=$i'>$i</a>
                                                        </li>
                                                    ";
                                                }else{
                                                    echo "
                                                        <li class='page-item'>
                                                            <a class='page-link'>$i</a>
                                                        </li>
                                                    ";
                                                }
                                            }
                                        }
                                        if($halaman!=$jum_halaman){
                                            echo "
                                            <li class='page-item'>
                                            <a class='page-link' href='user.php?halaman=$setelah'>
                                            »</a></li>
                                            ";
                                            echo "
                                            <li class='page-item'><a class='page-link' href='user.php?halaman=$jum_halaman'>Last</a></li>
                                            ";
                                        }
                                    }
                                }
                            ?>
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