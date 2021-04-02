<?php 
    session_start();
    include('koneksi/koneksi.php');
    if(isset($_SESSION['id_kategori_blog'])){
        $id_kategori_blog = $_SESSION['id_kategori_blog'];
        $kategori_blog = $_POST['kategori_blog'];
        if(empty($kategori_blog)){
            header("Location:editkategoriblog.php?data=".$id_kategori_blog."&notif=editkosong");
        }else{
            $sql = "UPDATE `kategori_blog` SET `kategori_blog`='$kategori_blog' WHERE `id_kategori_blog`='$id_kategori_blog'";
            mysqli_query($koneksi, $sql);
            header("Location:kategoriblog.php?notif=editberhasil");
        }
    }
?>